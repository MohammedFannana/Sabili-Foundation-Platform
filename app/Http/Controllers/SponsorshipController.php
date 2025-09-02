<?php

namespace App\Http\Controllers;

use App\Models\Orphan;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function index(Request $request){


        $orphan = Orphan::query()
        ->when($request->filled('orphan_code'), function ($query) use ($request) {
            $query->where('orphan_code', $request->orphan_code);
        })
        ->with(['activeSponsorship' , 'image'])
        ->first();

        return view('pages.orphans.sponsorship' , compact('orphan'));
    }

    public function deliverySponsorship(Request $request){

        $ids = explode(',', $request->input('sponsorship_ids'));

        $request->merge(['ids' => $ids]);

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:sponsorships,id',
            'payment_receipt' => ['image' ,'required' , 'dimensions:min_width=100,min_height=100','max:1048576'],
        ]);


        if ($request->hasFile('payment_receipt')) {
            $file = $request->file('payment_receipt');
            $path = $file->store("images/orphans/Payment receipt", 'public');
            $validated['payment_receipt'] = $path;
        }


        foreach ($validated['ids'] as $id) {
            $sponsorship = Sponsorship::findOrFail($id);
            if ($sponsorship) {
                $sponsorship->update([
                    'status' => 'تم التسليم',
                    'payment_receipt' => $validated['payment_receipt'],
                ]);
            }
        }

        return back()->with('success', 'تم تسليم  الكفالة لليتيم بنجاح');
    }
}
