<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Orphan;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreOrphanRequest;
use App\Http\Requests\UpdateOrphanRequest;

class OrphanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.orphans.create');

    }

    public function create_group(){
        return view('pages.orphans.create-group');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrphanRequest $request)
    {

        $validated = $request->validated();

        $validated['role'] = 'registered';

        // dd($validated);

        try {
            DB::beginTransaction();

            // الحقول المستثناة
            $excludedFields = [
                'medical_report',
                'father_death_certificate',
                'wife_ID',
                'sponsor_ID',
                'birth_certificate',
                'personl_image',

                // بيانات الإخوة
                'brother_name',
                'brother_name.*',
                'brother_id_number',
                'brother_id_number.*',
                'brother_gender',
                'brother_gender.*',
                'brother_birth_date',
                'brother_birth_date.*',
                'brother_health_status',
                'brother_health_status.*',
                'brother_medical_report',
                'brother_medical_report.*',
            ];

            $validatedData = Arr::except($validated, $excludedFields);

            // إنشاء سجل اليتيم
            $orphan = Orphan::create($validatedData);

            $fields = [
                'medical_report',
                'father_death_certificate',
                'wife_ID',
                'sponsor_ID',
                'birth_certificate',
                'personl_image',
            ];

            $imageData = [];

            foreach ($fields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $path = $file->store("images/orphans/{$request->name}", 'public');
                    $imageData[$field] = $path;
                } else {
                    $imageData[$field] = null;  
                }
            }

            $orphan->image()->create($imageData);

            // إنشاء بيانات الإخوة
            // $brotherCount = count($request->brother_name ?? []);

            $brotherNames = $request->brother_name ?? [];

            foreach ($brotherNames as $i => $brotherName) {
                // تجاهل القيم null أو الفراغات
                if (is_null($brotherName) || trim($brotherName) === '') {
                    continue;
                }

                $medicalReportPath = null;
                if ($request->hasFile("brother_medical_report.$i")) {
                    $file = $request->file("brother_medical_report")[$i];
                    $medicalReportPath = $file->store("images/orphans/{$orphan->name}/brothers", 'public');
                }

                $orphan->brothers()->create([
                    'brother_name'          => $brotherName,
                    'brother_id_number'     => $request->brother_id_number[$i] ?? null,
                    'brother_gender'        => $request->brother_gender[$i] ?? null,
                    'brother_birth_date'    => $request->brother_birth_date[$i] ?? null,
                    'brother_health_status' => $request->brother_health_status[$i] ?? null,
                    'brother_medical_report'=> $medicalReportPath,
                ]);
            }


            DB::commit();
            return redirect()->back()->with('success', __('تمت إضافة اليتيم بنجاح'));

        }catch(Exception $e){
            DB::rollBack();
            // dd($e);

            logger()->error('فشل في تسجيل اليتيم: ' . $e->getMessage());
            logger()->error($e->getTraceAsString()); // لتسجيل السطر والمصدر

            return redirect()->back()->withInput()->with('danger', 'فشل في تسجيل اليتيم. يرجى المحاولة مرة أخرى.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Orphan $orphan)
    {
        $orphan = $orphan->load('image' , 'brothers');
        return view('pages.orphans.view' , compact('orphan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orphan $orphan)
    {
        $orphan = $orphan->load('image' , 'brothers');
        return view('pages.orphans.edit' ,compact('orphan'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrphanRequest $request, Orphan $orphan)
    {
        $validated = $request->validated();

        // dd($validated);


        $fields = [
            'medical_report',
            'father_death_certificate',
            'wife_ID',
            'sponsor_ID',
            'birth_certificate',
            'personl_image',
        ];

        DB::beginTransaction();

        try {
            // معالجة صور اليتيم
            foreach ($fields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $newPath = $file->store("images/orphans/{$orphan->name}", 'public');

                    // احذف القديم إذا موجود
                    if ($orphan->images && $orphan->images->$field) {
                        Storage::disk('public')->delete($orphan->images->$field);
                    }

                    // حدث المسار الجديد
                    $orphan->image()->update([
                        $field => $newPath
                    ]);
                }
            }


            // الحقول التي لا نريد تعديلها مباشرة (نستثنيها)
            $excludedFields = [
                'medical_report',
                'father_death_certificate',
                'wife_ID',
                'sponsor_ID',
                'birth_certificate',
                'personl_image',

                // بيانات الإخوة
                'brother_name',
                'brother_name.*',
                'brother_id_number',
                'brother_id_number.*',
                'brother_gender',
                'brother_gender.*',
                'brother_birth_date',
                'brother_birth_date.*',
                'brother_health_status',
                'brother_health_status.*',
                'brother_medical_report',
                'brother_medical_report.*',
            ];

            $validatedData = Arr::except($validated, $excludedFields);

            // تحديث بيانات اليتيم
            $orphan->update($validatedData);

            // تحديث بيانات الإخوة:

            // لجلب الإخوة الأصليين لكي نتمكن من حذف صورهم القديمة عند الحاجة
            $originalBrothers = $orphan->brothers()->get();

            $brotherCount = count($request->brother_name ?? []);



            $orphan->brothers()->delete();

            // إعادة إضافة بيانات الإخوة مع حذف الصور القديمة عند رفع ملفات جديدة
            for ($i = 0; $i < $brotherCount; $i++) {

                if (empty($request->brother_name[$i])) {
                    continue;
                }

                $medicalReportPath = null;

                if ($request->hasFile("brother_medical_report.$i")) {
                    // حذف ملف التقرير الطبي القديم (إن وجد)

                    if (isset($originalBrothers[$i]) && $originalBrothers[$i]->brother_medical_report) {
                        Storage::disk('public')->delete($originalBrothers[$i]->brother_medical_report);
                    }

                    $file = $request->file("brother_medical_report")[$i];
                    $medicalReportPath = $file->store("images/orphans/{$orphan->name}/brothers", 'public');
                } else {
                    // لم يتم رفع ملف جديد لهذا الأخ، احتفظ بالملف القديم إذا موجود
                    if (isset($originalBrothers[$i])) {
                        $medicalReportPath = $originalBrothers[$i]->brother_medical_report;
                    }
                }

                $orphan->brothers()->create([
                    'brother_name'          => $request->brother_name[$i],
                    'brother_id_number'     => $request->brother_id_number[$i],
                    'brother_gender'        => $request->brother_gender[$i],
                    'brother_birth_date'    => $request->brother_birth_date[$i],
                    'brother_health_status' => $request->brother_health_status[$i],
                    'brother_medical_report'=> $medicalReportPath,
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', __('تم تحديث بيانات اليتيم بنجاح'));

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('danger', __('فشل في تحديث بيانات اليتيم. يرجى المحاولة مرة أخرى.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ids = explode(',', $request->input('ids'));

        foreach ($ids as $id) {
            $orphan = Orphan::findOrFail($id);
            $orphan->delete();
        }

        return back()->with('success', 'تم حذف الأيتام بنجاح');

    }

    public function showImage(Request $request){
         try {
            $filePath = Crypt::decrypt($request->file);
            return view('pages.show_image' , compact('filePath'));

        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
