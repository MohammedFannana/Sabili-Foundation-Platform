<?php

namespace App\Http\Controllers;

use PDO;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\OrphansExcelImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;


class UplodeOrphanController extends Controller
{
    public function uplodeExcel(Request $request)
    {


        $request->validate([
            'orphan_excel_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $import = new OrphansExcelImport();

        Excel::import($import, $request->file('orphan_excel_file'));

        if (!empty($import->errors)) {
            // عرض الأخطاء في الجلسة بعد الانتهاء
            return back()->with('danger', implode("<br>", $import->errors));
        }

        return back()->with('success', 'تم رفع واستيراد ملف Excel بنجاح.');


    }

    // public function uplodeAccess(Request $request){

    //     $request->validate([
    //         'orphan_access_file' => 'required|file|mimes:accdb,mdb',
    //     ]);


    //     $file = $request->file('orphan_access_file');
    //     $path = $file->storeAs('temp', $file->getClientOriginalName());



    //         $table = 'orphans';
    //         $csvPath = storage_path('app/temp/orphans.csv');

    //         shell_exec("mdb-export " . escapeshellarg(storage_path("app/{$path}")) . " {$table} > " . escapeshellarg($csvPath));

    //         // قراءة CSV
    //         if (!file_exists($csvPath)) {
    //             return back()->with('error', 'فشل في تحويل ملف Access إلى CSV.');
    //         }

    //         $rows = array_map('str_getcsv', file($csvPath));
    //         dd($rows);

    //     try {

    //         foreach ($rows as $row) {
    //             dd($row);

    //             function parseAccessDate(?string $dateString): ?Carbon
    //             {
    //                 if (empty($dateString)) {
    //                     return null;
    //                 }

    //                 // إذا كان رقم (تاريخ Excel)
    //                 if (is_numeric($dateString)) {
    //                     try {
    //                         return Carbon::instance(Date::excelToDateTimeObject($dateString));
    //                     } catch (\Exception $e) {
    //                         return null;
    //                     }
    //                 }

    //                 $dateString = trim($dateString);

    //                 // جرب فورمات 'd/m/Y'
    //                 try {
    //                     return Carbon::createFromFormat('d/m/Y', $dateString);
    //                 } catch (\Exception $e) {}

    //                 // جرب فورمات 'Y-m-d'
    //                 try {
    //                     return Carbon::createFromFormat('Y-m-d', $dateString);
    //                 } catch (\Exception $e) {}

    //                 // جرب parse عام
    //                 try {
    //                     return Carbon::parse($dateString);
    //                 } catch (\Exception $e) {}

    //                 return null;
    //             }

    //             $birthDate = parseAccessDate($row['tarykh_almylad'] ?? null);
    //             $death_deceased_date = parseAccessDate($row['tarykh_alastshhad_alofa'] ?? null);
    //             $mother_birth_date = parseAccessDate($row['tarykh_mylad_zog_alshhyd_almtof'] ?? null);

    //             DB::table('orphans')->insert([
    //                 'role' => 'registered',
    //                 'name' => $row['asm_alytym_rbaaay'],
    //                 'id_number' => $row['rkm_hoy_alytym'],
    //                 'birth_date' =>$birthDate ? $birthDate->format('Y-m-d') : null,
    //                 'orphan_code' => $row['rkm_kod_alytym'],
    //                 'address' => $row['mkan_alskn'],
    //                 'gender' => $row['algns'],
    //                 'health_status' => $row['alhal_alshy'],
    //                 'deceased_name' => $row['asm_alshhyd_almtof_rbaaay'],
    //                 'deceased_id_number' => $row['rkm_hoy_alshhyd_almtof'],
    //                 'death_deceased_date' => $death_deceased_date ? $death_deceased_date->format('Y-m-d') : null,
    //                 'cause_deceased_death' => $row['sbb_alofa'],
    //                 'father_work' => $row['hl_kan_alab_yaaml'],
    //                 'nature_father_work' => $row['tbyaa_aaml_alab'],
    //                 'nature_work' => $row['tbyaa_alaaml'],
    //                 'mother_name' => $row['asm_zog_alshhyd_almtof_rbaaay'],
    //                 'mother_id_number' => $row['rkm_hoy_zog_alshhyd_almtof'],
    //                 'mother_birth_date' => $mother_birth_date ? $mother_birth_date->format('Y-m-d') : null,
    //                 'mother_status' => $row['hal_alam'],
    //                 'mother_work' => $row['hl_alam_taaml'],
    //                 'nature_mother_work' => $row['tbyaa_aaml_alam'],
    //                 'guardian_name' => $row['asm_alokyl_rbaaay'],
    //                 'guardian_id_number' => $row['rkm_hoy_alokyl'],
    //                 'guardian_relation' => $row['sl_alkrab'],
    //                 'guardian_anthor_relation' => $row['sl_alkrab_akhr'],
    //                 'phone' => $row['rkm_goal_asasy'],
    //                 'phone1' => $row['rkm_goal_thanoy'],
    //                 'email' => $row['albryd_alalktrony'],
    //                 'bank_name' => $row['asm_albnk'],
    //                 'bank_account_owner' => $row['asm_sahb_alhsab_rbaaay'],
    //                 'bank_owner_id_number' => $row['rkm_hoy_sahb_alhsab'],
    //                 'phone_number_linked_bank' => $row['rkm_algoal_almrtbt_balhsab_albnky'],
    //                 'bank_account_number' => $row['rkm_alhsab_albnky'],
    //                 'wallet_owner' => $row['asm_sahb_almhfth'],
    //                 'wallet_owner_id_number' => $row['rkm_hoy_sahb_almhfth'],
    //                 'owner_phone_linked_wallet' => $row['rkm_algoal_almrtbt_balmhfth'],
    //             ]);
    //         }

    //         return back()->with('success', 'تم استيراد ملف Access بنجاح.');
    //     } catch (\Exception $e) {
    //         dd($e);
    //         return back()->with('error', '❌ فشل في قراءة ملف Access. تأكد من تنسيقه ومسار الاتصال.');
    //     }

    // }
}
