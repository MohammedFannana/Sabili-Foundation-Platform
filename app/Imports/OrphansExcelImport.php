<?php

namespace App\Imports;

use Exception;
use App\Models\Orphan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;




class OrphansExcelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $errors = [];

    public function model(array $row)
    {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '1024M');


           // تجاهل الصفوف الفارغة تمامًا
        if (collect($row)->filter()->isEmpty()) {
            return null;
        }

        // تجاهل الصف إذا لم يحتوي على اسم يتيم
        if (empty($row['asm_alshhyd_almtof_rbaaay'])) {
            return null;
        }

        try {
            DB::beginTransaction();

            $birthDate = null;



            $birthDate = $this->parseExcelDate($row['tarykh_almylad'] ?? null);
            $death_deceased_date = $this->parseExcelDate($row['tarykh_alastshhad_alofa'] ?? null);
            $mother_birth_date = $this->parseExcelDate($row['tarykh_mylad_zog_alshhyd_almtof'] ?? null);

            $idNumber = $row['rkm_hoy_alytym'];

            $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomLetters = '';
            for ($i = 0; $i < 3; $i++) {
                $randomLetters .= $letters[rand(0, strlen($letters) - 1)];
            }

            $orphanCode = $idNumber . $randomLetters;


            Orphan::create([
                'role' => 'registered',
                'name' => $row['asm_alytym_rbaaay'],
                'id_number' => $row['rkm_hoy_alytym'],
                'birth_date' =>$birthDate ? $birthDate->format('Y-m-d') : null,
                'orphan_code' => $orphanCode,
                'address' => $row['mkan_alskn'],
                'gender' => $row['algns'],
                'health_status' => $row['alhal_alshy'],
                'deceased_name' => $row['asm_alshhyd_almtof_rbaaay'],
                'deceased_id_number' => $row['rkm_hoy_alshhyd_almtof'],
                'death_deceased_date' => $death_deceased_date ? $death_deceased_date->format('Y-m-d') : null,
                'cause_deceased_death' => $row['sbb_alofa'],
                'father_work' => $row['hl_kan_alab_yaaml'],
                'nature_father_work' => $row['tbyaa_aaml_alab'],
                'nature_work' => $row['tbyaa_alaaml'],
                'mother_name' => $row['asm_zog_alshhyd_almtof_rbaaay'],
                'mother_id_number' => $row['rkm_hoy_zog_alshhyd_almtof'],
                'mother_birth_date' => $mother_birth_date ? $mother_birth_date->format('Y-m-d') : null,
                'mother_status' => $row['hal_alam'],
                'mother_work' => $row['hl_alam_taaml'],
                'nature_mother_work' => $row['tbyaa_aaml_alam'],
                'guardian_name' => $row['asm_alokyl_rbaaay'],
                'guardian_id_number' => $row['rkm_hoy_alokyl'],
                'guardian_relation' => $row['sl_alkrab'],
                'guardian_anthor_relation' => $row['sl_alkrab_akhr'],
                'phone' => $row['rkm_goal_asasy'],
                'phone1' => $row['rkm_goal_thanoy'],
                'email' => $row['albryd_alalktrony'],
                'bank_name' => $row['asm_albnk'],
                'bank_account_owner' => $row['asm_sahb_alhsab_rbaaay'],
                'bank_owner_id_number' => $row['rkm_hoy_sahb_alhsab'],
                'phone_number_linked_bank' => $row['rkm_algoal_almrtbt_balhsab_albnky'],
                'bank_account_number' => $row['rkm_alhsab_albnky'],
                'wallet_owner' => $row['asm_sahb_almhfth'],
                'wallet_owner_id_number' => $row['rkm_hoy_sahb_almhfth'],
                'owner_phone_linked_wallet' => $row['rkm_algoal_almrtbt_balmhfth'],
            ]);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            $this->errors[] = "خطأ في الصف رقم {$row['rkm_hoy_alytym']}: " . $e->getMessage();

        }
    }

    private function parseExcelDate(?string $dateString): ?Carbon
    {
        if (empty($dateString)) {
            return null;
        }

        // إذا كان رقم (تاريخ Excel)
        if (is_numeric($dateString)) {
            try {
                return Carbon::instance(Date::excelToDateTimeObject($dateString));
            } catch (\Exception $e) {
                return null;
            }
        }

        $dateString = trim($dateString);

        // جرب فورمات 'd/m/Y'
        try {
            return Carbon::createFromFormat('d/m/Y', $dateString);
        } catch (\Exception $e) {}

        // جرب فورمات 'Y-m-d'
        try {
            return Carbon::createFromFormat('Y-m-d', $dateString);
        } catch (\Exception $e) {}

        // جرب parse عام
        try {
            return Carbon::parse($dateString);
        } catch (\Exception $e) {}

        return null;
    }

}
