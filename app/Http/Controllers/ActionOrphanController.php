<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Orphan;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\OrphanEmailNotification;


class ActionOrphanController extends Controller
{
    public function approveOrphans(Request $request)
    {


        $ids = explode(',', $request->input('ids'));
        $request->merge(['ids' => $ids]);

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:orphans,id',
        ]);


        foreach ($validated['ids'] as $id) {
            $orphan = Orphan::findOrFail($id);
            if ($orphan) {
                $orphan->update(['role' => 'certified']);
            }
        }

        return back()->with('success', 'تم اعتماد الأيتام بنجاح');
    }

    public function waitingOrphans(Request $request)
    {

        $ids = explode(',', $request->input('waiting_ids'));

        $request->merge(['ids' => $ids]);

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:orphans,id',
            'waiting_reason' => ['required' , 'string'],
        ]);


        foreach ($validated['ids'] as $id) {
            $orphan = Orphan::findOrFail($id);
            if ($orphan) {

                $orphan->update([
                    'role' => 'waiting',
                    'waiting_reason' => $request->waiting_reason,
                ]);
            }
        }

        return back()->with('success', 'تم تحويل الأيتام الى قائمة الانتظار بنجاح');
    }

    public function sponsorOrphans(Request $request)
    {

        $ids = explode(',', $request->input('ids'));
        $request->merge(['ids' => $ids]);

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:orphans,id',
            // 'amount' => 'required|string',
            // 'duration'=> 'required|numeric|min:1'
        ]);



        foreach ($validated['ids'] as $id) {
            $orphan = Orphan::findOrFail($id);
            if ($orphan) {

                try{
                    DB::beginTransaction();

                    $orphan->update(['role' => 'sponsored']);

                    // $orphan->sponsorships()->create([
                    //     'duration' => $validated['duration'],
                    //     'amount' => $validated['amount'],
                    //     // 'start_date' => now(),
                    //     'role' => 'active',
                    //     'status' => 'لم يتم التسليم'
                    // ]);


                    DB::commit();

                }catch(Exception $e){
                    DB::rollBack();
                    return redirect()->back()->with('error' , 'فشل تحويل اليتيم الى قائمة الأيتام المكفولين');
                }




            }
        }

        return back()->with('success', 'تم تحويل اليتيم الى قائمة الأيتام المكفولين بنجاح');
    }

    public function addSponsorship(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|string',
            'duration' => 'required|array',
            'duration.*'=> 'required|numeric|min:1'
        ]);

        $orphans = Orphan::where('role', 'sponsored')->get();

        $currentYear = now()->year;

        foreach ($orphans as $orphan) {
            foreach ($validated['duration'] as $monthNumber) {
                // تحديد تاريخ بداية الكفالة
                $startDate = Carbon::create($currentYear, $monthNumber, 1);

                Sponsorship::create([
                    'orphan_id' => $orphan->id,
                    'amount'    => $validated['amount'],
                    'duration'  => 1, // كل سجل يمثل شهر واحد
                    'role'      => 'active',
                    'status'    => 'لم يتم التسليم',
                    'start_date'=> $startDate,
                ]);
            }
        }

        return back()->with('success', 'تم إضافة الكفالة بنجاح');
    }


    public function destroyOrphans(Request $request)
    {

        $ids = explode(',', $request->input('delete_ids'));
        $request->merge(['ids' => $ids]);

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:orphans,id',
        ]);



        foreach ($validated['ids'] as $id) {
            $orphan = Orphan::findOrFail($id);
            dd($orphan);
            $orphan->delete();
        }

        return back()->with('success', 'تم حذف الأيتام بنجاح');
    }

    public function search(Request $request)
    {
        $query = Orphan::query();

        $searchBys = $request->input('search_by', []);
        $conditions = $request->input('condition', []);
        $values = $request->input('search_value', []);
        $from = $request->input('from');



        $isSearch = collect($values)->filter(function ($value) {
            return $value !== null && $value !== '';
        })->isNotEmpty();

        if ($isSearch) {

            if ($from === 'adopted_page') {
                $query->where('role', 'certified');
            } elseif ($from === 'auditing_addition_page') {
                $query->where('role', 'registered');
            }elseif ($from === 'waiting_page') {
                $query->where('role', 'waiting');
            }elseif ($from === 'sponsorship_page') {

                $query->where('role', 'sponsored');
            }

            foreach ($searchBys as $index => $field) {
                $condition = $conditions[$index] ?? '==';
                $value = $values[$index] ?? null;

                if ($value !== null && $value !== '') {
                    // فقط شرط تطابق دقيق (==)
                    if ($condition == '==') {
                        $query->where($field, $value);
                    }
                    // يمكن إضافة شروط أخرى هنا لو تحتاج (مثل like, >, < ...)
                }
            }

            $orphans = $query->paginate(15)->appends($request->query());


        } else {
            // بدون بحث نمرر paginator فارغ
            $orphans = null;
        }

        // dd($orphans);

        return view('pages.orphans.create-query', compact('orphans', 'searchBys', 'conditions', 'values' , 'from'));
    }

    public function sendEmail(Request $request)
    {

        $ids = explode(',', $request->orphan_ids);
        $request->merge(['ids' => $ids]);

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:orphans,id',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $orphans = Orphan::whereIn('id', $validated['ids'])->get();

        foreach ($orphans as $orphan) {
            if ($orphan->email) {
                $orphan->notify(new OrphanEmailNotification($request->subject, $request->message));
            }
        }

        return back()->with('success', 'تم إرسال البريد الإلكتروني بنجاح .');
    }

    public function archivedOrphan($id)
    {
        $orphan = Orphan::findOrFail($id);

        if ($orphan->role !== 'sponsored') {
            return redirect()->back()->with('error', 'لا يمكن أرشفة هذا اليتيم لأنه ليس مكفولاً.');
        }

        $orphan->update(['role' => 'archive']);

        return redirect()->back()->with('success', 'تم أرشفة اليتيم بنجاح.');
    }









}
