<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Orphan;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Models\FinancialDocument;
use Illuminate\Support\Facades\Storage;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class FinaceController extends Controller
{
    public function index(Request $request){


        $orphan = Orphan::query()
        ->when($request->filled('orphan_code'), function ($query) use ($request) {
            $query->where('orphan_code', $request->orphan_code);
        })
        ->with(['activeSponsorship' , 'image'])
        ->first();

        $total_amounts_paid = Sponsorship::where('status', 'تم التسليم')
            ->get(['duration', 'amount'])
            ->sum(function ($item) {
                return (float) $item->duration * (float) $item->amount;
            });

        $total_overdue_amounts =  Sponsorship::where('status', 'لم يتم التسليم')
            ->get(['duration', 'amount'])
            ->sum(function ($item) {
                return (float) $item->duration * (float) $item->amount;
            });

        $orphan_amount_paid = $orphan->sponsorships()->where('status', 'تم التسليم')
            ->get(['duration', 'amount'])
            ->sum(function ($item) {
                return (float) $item->duration * (float) $item->amount;
            });

        $orphan_overdue_paid = $orphan->sponsorships()->where('status', 'لم يتم التسليم')
            ->get(['duration', 'amount'])
            ->sum(function ($item) {
                return (float) $item->duration * (float) $item->amount;
            });

        $orphan_months_covered = $orphan->sponsorships()->where('status', 'تم التسليم')
         ->get(['duration', 'amount'])
            ->sum(function ($item) {
                return (float) $item->duration;
            });

        $orphan_months_late = $orphan->sponsorships()->where('status',  'لم يتم التسليم')
         ->get(['duration'])
            ->sum(function ($item) {
                return (float) $item->duration ;
            });

        return view('pages.finance.finace' , compact(['orphan' , 'total_amounts_paid' , 'total_overdue_amounts',
            'orphan_amount_paid' , 'orphan_overdue_paid' , 'orphan_months_covered' ,'orphan_months_late']));
    }

    public function deliverySponsorship(Request $request){

        $ids = explode(',', $request->input('sponsorship_ids'));

        $request->merge(['ids' => $ids]);


        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:sponsorships,id',
        ]);



        $alreadyDelivered = [];
        foreach ($validated['ids'] as $id) {
            $sponsorship = Sponsorship::findOrFail($id);
            if ($sponsorship) {
                if ($sponsorship->status === 'تم التسليم') {
                    $alreadyDelivered[] = $id;
                    continue;
                }
                $sponsorship->update([
                    'status' => 'تم التسليم',
                ]);
            }
        }

        if (count($alreadyDelivered) > 0) {
            return back()->with('danger', 'بعض الكفالات تم تسليمها مسبقًا:');
        }

        return back()->with('success', 'تم تسليم  الكفالة لليتيم بنجاح');
    }


    public function financialDocuments(Request $request){

         $files = FinancialDocument::when($request->filled('date'), function ($query) use ($request) {
            $date = Carbon::parse($request->date);

            $query->whereYear('date', $date->year)
                ->whereMonth('date', $date->month);
        })->paginate(10);

        return view('pages.finance.financial-document', compact('files'));

    }

    public function financialDocumentsStore(Request $request){
        $validated = $request->validate([
            'file' => ['required','file' , 'mimes:pdf,xlsx'],
            'date' => ['required' , 'date'],
        ]);

        $storeDate = Carbon::createFromFormat('Y-m', $request->date)->startOfMonth();
        $validated['date'] = $storeDate;


        $date = Carbon::parse($request->date);
        $folder = $date->format('m-Y');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store("Financial Documents/{$folder}", 'public');
            $validated['file'] = $path;
        }

        FinancialDocument::create($validated);
        return redirect()->back()->with('success' , 'تم حفط المستند المالي بنجاح');



    }

    public function financialDocumentsDownload(string $id){
         $file = FinancialDocument::findOrFail($id);
        // تحويل التاريخ للشهر والسنة
        $dateFormatted = Carbon::parse($file->date)->format('m-Y');

        // إنشاء اسم الملف للتحميل
        $filename = "مستند مالي - {$dateFormatted}.pdf"; // أو استخدم $file->original_name إذا بدك الاسم الأصلي

        // تحميل الملف المخزن في storage/app/public
        return Storage::disk('public')->download($file->file, $filename);

    }
}
