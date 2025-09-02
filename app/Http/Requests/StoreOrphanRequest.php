<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreOrphanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            // البيانات الاساسية
            'name' => ['required' , 'string'],
            'id_number' => ['required' , 'unique:orphans,id_number','digits:9', 'regex:/^[4-9]\d{8}$/'],
            'birth_date' => ['required' , 'date'],
            'orphan_code' => ['required' , 'unique:orphans,orphan_code'],
            'address' => ['required' , 'string'],
            'gender' => ['required' , 'in:ذكر,أنثى'],
            'health_status' => ['required' , 'in:سليم,مريض'],
            'medical_report' => ['nullable' , 'image' , 'required_if:health_status,مريض' , 'dimensions:min_width=100,min_height=100','max:1048576'],

            // // بيانات الأب
            'deceased_name' => ['required' , 'string'],
            'deceased_id_number' => ['required' , 'digits:9', 'regex:/^[4-9]\d{8}$/'],
            'death_deceased_date' => ['required' , 'date'],
            'cause_deceased_death' => ['nullable' , 'in:شهيد,وفاة طبيعية'],
            'father_work' => ['nullable' , 'in:يعمل,لا يعمل'],
            'nature_father_work' => ['nullable' , 'in:موظف حكومي,موظف وكالة,عمل خاص'],
            'nature_work' => ['nullable' , 'string'],

            // // بيانات الأم
            'mother_name' => ['required','string'],
            'mother_id_number' => ['required' , 'digits:9', 'regex:/^[4-9]\d{8}$/'],
            'mother_birth_date' => ['nullable' , 'date'],
            'mother_status' => ['required' , 'in:على قيد الحياة- أرملة,على قيد الحياة- متزوجة زوج آخر,على قيد الحياة- مطلقة,شهيدة/ متوفية'],
            'mother_work' => ['nullable' , 'in:تعمل,لا تعمل'],
            'nature_mother_work' => ['nullable' , 'in:موظف حكومي,موظف وكالة,عمل خاص'],


            // // // بيانات الوكيل
            'guardian_name' => ['required' , 'string'],
            'guardian_id_number' => ['required' , 'digits:9', 'regex:/^[4-9]\d{8}$/'],
            'guardian_relation' => ['required' , 'in:أم,أخ/ت,جد/ة,عم/ة,خال/ة,غير ذلك'],
            'guardian_anthor_relation' => ['nullable' , 'string' , 'required_if:guardian_relation,غير ذلك'],

            // // //بيانات التواصل
            'phone' => ['required' , 'string'],
            'phone1' => ['required' , 'string'],
            'email' => ['nullable' , 'email'],

            // // بيانات استلام الكفالة
            // // بيانات البنك
            'bank_name' => ['nullable', 'string', 'required_without:wallet_owner'],
            'bank_account_owner' => ['nullable','required_with:bank_name', 'string'],
            'bank_owner_id_number' => ['nullable','required_with:bank_name', 'digits:9', 'regex:/^[4-9]\d{8}$/'],
            'phone_number_linked_bank' => ['nullable', 'required_with:bank_name', 'string'],
            'bank_account_number' => ['nullable','required_with:bank_name', 'digits_between:4,24'],
        
            // // // بيانات المحفظة
            'wallet_owner' => ['nullable', 'string', 'required_without:bank_name'],
            'wallet_owner_id_number' => ['nullable' , 'required_with:wallet_owner', 'digits:9', 'regex:/^[4-9]\d{8}$/'],
            'owner_phone_linked_wallet' => ['nullable' , 'required_with:wallet_owner', 'string'],

            // // // // brother table
            'brother_name' => ['nullable', 'array'],
            'brother_name.*' => ['string', 'nullable'],

            'brother_id_number' => ['nullable', 'array'],
            'brother_id_number.*' => ['nullable', 'digits:9' , 'regex:/^[4-9]\d{8}$/'],

            'brother_gender' => ['nullable', 'array'],
            'brother_gender.*' => ['nullable', 'in:ذكر,أنثى'],

            'brother_birth_date' => ['nullable', 'array'],
            'brother_birth_date.*' => ['date', 'nullable'],

            'brother_health_status' => ['nullable', 'array'],
            'brother_health_status.*' => ['nullable' , 'in:مريض,سليم'],

            'brother_medical_report' => ['nullable', 'array'],
            // // 'required_if:brother_health_status,مريض'
            'brother_medical_report.*' => ['image', 'nullable'  , 'dimensions:min_width=100,min_height=100','max:1048576'],

            // // // images table
            'father_death_certificate' => ['required' , 'image' , 'dimensions:min_width=100,min_height=100','max:1048576'],
            'wife_ID' => ['required' , 'image' , 'dimensions:min_width=100,min_height=100','max:1048576'],
            'sponsor_ID' => ['required' , 'image' , 'dimensions:min_width=100,min_height=100','max:1048576'],
            'birth_certificate' => ['required' , 'image' , 'dimensions:min_width=100,min_height=100','max:1048576'],
            'personl_image' => ['required' , 'image' , 'dimensions:min_width=100,min_height=100','max:1048576'],


        ];
    }
}
