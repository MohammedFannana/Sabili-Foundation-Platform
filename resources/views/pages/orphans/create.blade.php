<x-main-layout title="مؤسسة سبيلي الخيرية">

    <section class="mt-1">

        <x-alert name="success" />
        <x-alert name="danger" />



        {{-- section header component --}}
        <h3 class="mb-5"> إضافة يتيم </h3>

        <div class="mb-4 rounded p-2 pt-2 pb-2 row ms-1 me-1" style="background-color:#f8fafa;">
            <a href="{{route('orphan.create')}}" class="col-12 col-sm-6 text-center fw-semibold text-decoration-none p-2 rounded" style="color: var(--primary-color); background-color:var(--third-color)"> الإضافة يدويًا بشكل فردي </a>
            <a href="{{route('orphan.group.create')}}" class="col-12 col-sm-6 text-center fw-semibold text-decoration-none p-2 rounded" style="color: rgba(36, 36, 36, 0.6)"> استيراد جماعي </a>
        </div>

        <div class="rounded mt-3" style="border-top-color:#f0fff4 !important">

            <div class="mt-4 mb-4 row">


                <form action="{{route('orphan.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        {{-- basic information section --}}
                        <section class="basic-information">

                            {{-- section header component --}}
                            <x-header title=" بيانات اليتيم " />

                            <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                                <div class="mt-4 mb-4 ms-3 me-3">

                                    <div class="row mb-3">

                                        {{-- orphan-name --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="name"  type="text" id="name" label=" الاسم الرباعي لليتيم " required="required" placeholder=" ادخل الاسم الرباعي " />
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="id_number"  class="starts-with-4" type="text" id="id_number" label=" رقم هوية اليتيم " required="required" placeholder=" ادخل رقم الهوية " />
                                        </div>

                                        {{-- birth-date --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="birth_date"  type="date" id="birth-date" label=" تاريخ ميلاد اليتيم " required="required" />
                                        </div>

                                        {{-- birth-place --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="orphan_code"  type="text" id="orphan_code" required="required" label=" رقم كود اليتيم " placeholder="ادخل رقم كود اليتيم"/>
                                        </div>

                                        {{-- address --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="address"  type="text" id="address" required="required" label=" العنوان / المدينة " placeholder="ادخل العنوان / المدينة" />
                                        </div>

                                        {{-- gender --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <label class="mb-2 fw-bold"> الجنس
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="d-flex align-items-center gap-5">
                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="gender" type="radio" id="male"  value="ذكر"/>
                                                    <label class="form-check-label" for="male" style="color: rgba(36, 36, 36, 0.6)"> ذكر </label>
                                                </div>

                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="gender" type="radio" id="female"  value="أنثى"/>
                                                    <label class="form-check-label" for="female" style="color: rgba(36, 36, 36, 0.6)"> أنثى </label>
                                                </div>

                                                @error('gender')
                                                    <div class="text-danger">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>

                                        {{-- health-status --}}
                                        <div class="col-12 mb-4">
                                            <label class="mb-2 fw-bold"> الحالة الصحية
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="d-flex align-items-center gap-5">
                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="health_status" type="radio" id="health-good"  value="سليم"/>
                                                    <label class="form-check-label" for="health-good" style="color: rgba(36, 36, 36, 0.6)"> سليم </label>
                                                </div>

                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="health_status" type="radio" id="health-sick"  value="مريض"/>
                                                    <label class="form-check-label" for="health-sick" style="color: rgba(36, 36, 36, 0.6)"> مريض </label>
                                                </div>

                                                @error('health_status')
                                                    <div class="text-danger">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>

                                        {{-- medical_report --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4" id="medical_report_health" style="display: none;">
                                                <label class="mb-2 fw-bold">   التقرير الطبي في حال كان مريض
                                                    <span class="text-danger">*</span>
                                                </label> <br>
                                                <label for="medical_report" class="custom-file-upload text-center" style="color:#777a78;">
                                                    <img src="{{asset('assets/images/file.png')}}" alt="" width="50px" height="50px"> <br>
                                                    اسحب الملف هنا أو اضغط لاختياره
                                                </label>
                                                <x-form.input name="medical_report" class="hidden-file-style" type="file" id="medical_report" style="display: none;"/>
                                        </div>

                                    </div>


                                </div>

                            </div>

                        </section>

                        {{-- deceased information section --}}
                        <section class="deceased-information mt-5">

                            {{-- section header component --}}
                            <x-header title=" بيانات الشهيد/ المتوفى " />

                            <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                                <div class="m-4">

                                    <div class="row mb-3">

                                        {{-- mother-name --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="deceased_name"  type="text" id="name" required="required" label=" اسم (الشهيد/ المتوفى) رباعي " placeholder=" ادخل الاسم الرباعي " />
                                        </div>

                                        {{-- deceased_id_number --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="deceased_id_number"  class="starts-with-4"  type="text" id="deceased_id_number" label=" رقم هوية (الشهيد/ المتوفى)  " required="required" placeholder=" ادخل رقم الهوية " />
                                        </div>

                                        {{-- death_deceased_date --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="death_deceased_date"  type="date" id="death_deceased_date" label=" تاريخ (الإستشهاد/ الوفاة) " required="required"/>
                                        </div>

                                        {{-- cause_deceased_death --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <label class="mb-2 fw-bold"> سبب الوفاة
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <div class="d-flex align-items-center gap-5">
                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="cause_deceased_death" type="radio" id="martyr"  value="شهيد"/>
                                                    <label class="form-check-label" for="martyr" style="color: rgba(36, 36, 36, 0.6)"> شهيد </label>
                                                </div>

                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="cause_deceased_death" type="radio" id="death"  value="وفاة طبيعية"/>
                                                    <label class="form-check-label" for="death" style="color: rgba(36, 36, 36, 0.6)"> وفاة طبيعية </label>
                                                </div>

                                                @error('cause_deceased_death')
                                                    <div class="text-danger">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>

                                        {{-- father_work --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <label class="mb-2 fw-bold"> هل كان الأب يعمل
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <div class="d-flex align-items-center gap-5">
                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="father_work" type="radio" id="yes"  value="يعمل"/>
                                                    <label class="form-check-label" for="yes" style="color: rgba(36, 36, 36, 0.6)"> نعم </label>
                                                </div>

                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="father_work" type="radio" id="no"  value="لا يعمل"/>
                                                    <label class="form-check-label" for="no" style="color: rgba(36, 36, 36, 0.6)"> لا </label>
                                                </div>

                                                @error('father_work')
                                                    <div class="text-danger">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>

                                        {{-- nature_father_work --}}
                                        <div class="col-12 col-md-6  mb-4" id="nature_father_work" style="display: none;">
                                            <label class="mb-2 fw-bold"> طبيعة عمل الأب
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <div class="d-flex align-items-center gap-5">
                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="nature_father_work" type="radio" id="government_employee"  value="موظف حكومي"/>
                                                    <label class="form-check-label" for="government_employee" style="color: rgba(36, 36, 36, 0.6)"> موظف حكومي </label>
                                                </div>

                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="nature_father_work" type="radio" id="agency_employee"  value="موظف وكالة"/>
                                                    <label class="form-check-label" for="agency_employee" style="color: rgba(36, 36, 36, 0.6)"> موظف وكالة </label>
                                                </div>

                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="nature_father_work" type="radio" id="private_work"  value="عمل خاص"/>
                                                    <label class="form-check-label" for="private_work" style="color: rgba(36, 36, 36, 0.6)"> عمل خاص </label>
                                                </div>

                                                @error('nature_father_work')
                                                    <div class="text-danger">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>

                                        {{-- nature_work --}}
                                        <div class="col-12 mb-4" id="nature_work" style="display: none;">
                                            <x-form.input name="nature_work"  type="text"  label=" طبيعة العمل " placeholder="ادخل طبيعة العمل"/>
                                        </div>



                                    </div>

                                </div>

                            </div>


                        </section>

                        {{-- mother information section --}}
                        <section class="mother-information mt-5">

                            {{-- section header component --}}
                            <x-header title=" بيانات الأم " />

                            <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                                <div class="m-4">

                                    <div class="row mb-3">

                                        {{-- mother-name --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="mother_name"  type="text" id="mother_name" required="required" label=" اسم زوجة (الشهيد/ المتوفى) رباعي " placeholder=" ادخل الاسم الرباعي " />
                                        </div>

                                        {{-- mother_id_number --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="mother_id_number"  class="starts-with-4"  type="text" id="mother_id_number" label=" رقم هوية زوجة (الشهيد/ المتوفى) " placeholder=" ادخل رقم الهوية " />
                                        </div>

                                        {{-- mother_birth_date --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="mother_birth_date"  type="date" id="mother_birth_date" label=" تاريخ ميلاد الأم "  />
                                        </div>


                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            {{-- :selected="$orphan->case_type" --}}
                                            <x-form.select id="mother_status" label="حالة الأم"  required="required"  name="mother_status"
                                                :options="['' =>  __('اختر'), 'على قيد الحياة- أرملة' => __('على قيد الحياة- أرملة'), 'على قيد الحياة- متزوجة زوج آخر' => __('على قيد الحياة- متزوجة زوج آخر')
                                                , 'على قيد الحياة- مطلقة' => __('على قيد الحياة- مطلقة') , 'شهيدة/ متوفية' => __('شهيدة/ متوفية')]"/>
                                        </div>

                                        {{-- mother_work --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <label class="mb-2 fw-bold"> هل الأم تعمل؟
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <div class="d-flex align-items-center gap-5">
                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="mother_work" type="radio" id="yes1"  value="تعمل"/>
                                                    <label class="form-check-label" for="yes1" style="color: rgba(36, 36, 36, 0.6)"> نعم </label>
                                                </div>

                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="mother_work" type="radio" id="no1"  value="لا تعمل"/>
                                                    <label class="form-check-label" for="no1" style="color: rgba(36, 36, 36, 0.6)"> لا </label>
                                                </div>

                                                @error('mother_work')
                                                    <div class="text-danger">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>

                                        {{-- nature_mother_work --}}
                                        <div class="col-12 col-md-6  mb-4" id="nature_mother_work" style="display: none;">
                                            <label class="mb-2 fw-bold"> طبيعة عمل الأم
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <div class="d-flex align-items-center gap-5">
                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="nature_mother_work" type="radio" id="government_employee1"  value="موظف حكومي"/>
                                                    <label class="form-check-label" for="government_employee1" style="color: rgba(36, 36, 36, 0.6)"> موظفة حكومة </label>
                                                </div>

                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="nature_mother_work" type="radio" id="agency_employee1"  value="موظف وكالة"/>
                                                    <label class="form-check-label" for="agency_employee1" style="color: rgba(36, 36, 36, 0.6)"> موظفة وكالة </label>
                                                </div>

                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="nature_mother_work" type="radio" id="private_work1"  value="عمل خاص"/>
                                                    <label class="form-check-label" for="private_work1" style="color: rgba(36, 36, 36, 0.6)"> عمل خاص </label>
                                                </div>

                                                @error('nature_mother_work')
                                                    <div class="text-danger">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>


                        </section>


                        {{-- Guardian's data --}}
                        <section class="guardian-information mt-5">

                            {{-- section header component --}}
                            <x-header title=" بيانات الوكيل" />

                            <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                                <div class="m-4">

                                    <div class="row mb-3">

                                        {{-- guardian_name --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="guardian_name"  type="text" required="required" id="guardian_name" label=" اسم الوكيل رباعي " placeholder=" ادخل الاسم الرباعي " />
                                        </div>

                                        {{-- guardian_id_number --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="guardian_id_number"  class="starts-with-4" required="required" type="text" id="guardian_id_number" label=" رقم هوية الوكيل " placeholder=" ادخل رقم الهوية " />
                                        </div>

                                        {{-- guardian_relation --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            {{-- :selected="$orphan->case_type" --}}
                                            <x-form.select id="guardian_relation" label=" صلة القرابة  "  required="required"  name="guardian_relation"
                                                :options="['' =>  __('اختر'), 'أم' => __('أم'), 'أخ/ت' => __('أخ/ت') , 'جد/ة' => __('جد/ة') , 'عم/ة' => __('عم/ة')
                                                , 'خال/ة' => __('خال/ة') , 'غير ذلك' => __('غير ذلك')]"/>
                                        </div>

                                        {{-- guardian_anthor_relation --}}
                                        <div class="col-12  mb-4">
                                            <x-form.input name="guardian_anthor_relation"  required="required"  type="text" id="guardian_anthor_relation" label=" إذا كان غير ذلك, يرجى توضيح صلة القرابة " placeholder=" ادخل صلة القرابة " />
                                        </div>


                                    </div>

                                </div>
                            </div>

                        </section>


                        {{-- بيانات إخوة اليتيم --}}
                        <section class="family-information mt-5">

                            {{-- section header component --}}
                            <x-header title=" بيانات الأخوة (غير أساسي) " />

                            <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                                <div class="m-4">

                                    <div class="table-responsive">
                                        <table id="siblingsTable" class=" border-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" style="width: 15%">الاسم رباعي</th>
                                                    <th scope="col">رقم الهوية</th>
                                                    <th scope="col">الجنس</th>
                                                    <th scope="col">تاريخ الميلاد</th>
                                                    <th scope="col">الحالة الصحية</th>
                                                    <th scope="col">التقرير الطبي</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td scope="row">1</td>

                                                    <td>
                                                        <input name="brother_name[]" type="text" placeholder="أدخل اسم الأخ/الأخت" class="rounded form-control" />
                                                    </td>

                                                     <td>
                                                        <input name="brother_id_number[]"  class="starts-with-4" type="text" placeholder=" رقم الهوية " class="rounded form-control" />
                                                    </td>

                                                    <td>
                                                        <select name="brother_gender[]"  class="form-control rounded form-select">
                                                            <option value="" selected> أدخل الجنس </option>
                                                            <option value="ذكر">ذكر</option>
                                                            <option value="أنثى">أنثى</option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <input name="brother_birth_date[]" type="date"  class="rounded form-control" />
                                                    </td>

                                                    <td>
                                                        
                                                        <select name="brother_health_status[]" class="form-control rounded form-select">
                                                            <option value="" selected>اختر</option>
                                                            <option value="سليم">سليم</option>
                                                            <option value="مريض">مريض</option>
                                                        </select>

                                                    </td>

                                                    <td>

                                                        <label for="brother_medical_report" class="custom-file-upload text-center p-1"  style="font-size:14px;color:#777a78; border:1px solid #777a78 ">
                                                            <img src="{{asset('assets/images/file.png')}}"  width="15px" height="15px">
                                                            اختر الملفات
                                                        </label>
                                                        <x-form.input name="brother_medical_report[]" class="hidden-file-style" type="file" id="brother_medical_report" style="display: none;"/>

                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button class="submit-btn mt-4" type="button" onclick="addRow()">إضافة أخ / أخت آخر +</button>
                                    </div>

                                </div>
                            </div>

                        </section>


                        {{-- Contact information--}}
                        <section class="contact-information mt-5">

                            {{-- section header component --}}
                            <x-header title=" بيانات التواصل " />

                            <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                                <div class="m-4">

                                    <div class="row mb-3">


                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                            <div class="w-100">
                                                <x-form.input name="phone" type="text" required="required" id="phone" label=" رقم جوال أساسي " placeholder=" ادخل رقم جوال أساسي " />
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                            <div class="w-100">
                                                <x-form.input name="phone1" type="text" required="required" id="phone1" label=" رقم جوال ثانوي " placeholder=" ادخل رقم جوال ثانوي " />
                                            </div>
                                        </div>


                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                            <div class="w-100">
                                                <x-form.input name="email" type="email"  id="email" label=" البريد الالكتروني" placeholder=" ادخل البريد الالكتروني " />
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </section>


                        {{-- How to receive sponsorship--}}
                        <section class="receive-sponsorship-information mt-5">

                            {{-- section header component --}}
                            <x-header title=" استلام الكفالة " />

                            <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                                <div class="m-4">

                                    {{-- --}}
                                    <div class="row mb-3">

                                        {{-- استلام الكفالة عن طريق حساب البنك: --}}

                                        <div id="receive-bank">
                                            <label class="mb-2 fw-bold" style="color: var(--primary-color)">  استلام الكفالة عن طريق حساب البنك:  </label>
                                            <div class="d-flex row align-items-center mb-3">

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    {{-- :selected="$orphan->case_type" --}}
                                                    <x-form.select id="bank_name" label=" اسم البنك  "  required="required"  name="bank_name"
                                                        :options="['' =>  __('اختر'), 'فلسطين' => __('فلسطين'), 'الاسلامي الفلسطيني' => __('الاسلامي الفلسطيني') ,'الاسلامي العربي' => __('الاسلامي العربي'), 'القدس' => __('القدس'), 'الاردن' => __('الاردن'), 'القاهرة عمان' => __('القاهرة عمان') ]"/>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="bank_account_owner"  type="text" id="bank_account_owner" required="required" label=" اسم صاحب الحساب رباعي " placeholder="ادخل اسم صاحب الحساب رباعي" />
                                                </div>

                                                 <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="bank_owner_id_number" class="starts-with-4" type="text" id="bank_owner_id_number" required="required" label=" رقم هوية صاحب الحساب " placeholder="ادخل رقم هوية صاحب الحساب" />
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="phone_number_linked_bank" required="required"  type="text" id="phone_number_linked_bank" label=" رقم الجوال المرتبط بالحساب البنكي " placeholder="ادخل رقم الجوال المرتبط بالحساب البنكي" />
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="bank_account_number" required="required"  type="text" id="bank_account_number" label=" رقم الحساب البنكي " placeholder="ادخل رقم الحساب البنكي" />
                                                </div>

                                            </div>
                                        </div>

                                        {{-- استلام الكفالة عن طريق محفظة بال باي: --}}

                                        <div id="receive-wallet">
                                            <label class="mb-2 fw-bold" style="color: var(--primary-color)">  استلام الكفالة عن طريق المحفظة  :  </label>
                                            <div class="d-flex align-items-center row mb-3">

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="wallet_owner"  type="text" id="wallet_owner" label=" اسم صاحب المحفظة " placeholder="ادخل اسم صاحب المحفظة  " />
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="wallet_owner_id_number"  class="starts-with-4" type="text" id="wallet_owner_id_number" label=" رقم هوية صاحب المحفظة " placeholder="ادخل رقم هوية صاحب المحفظة" />
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="owner_phone_linked_wallet" class="" type="text" id="owner_phone_linked_wallet" label=" رقم الجوال المرتبط بالمحفظة " placeholder="ادخل رقم الجوال المرتبط بالمحفظة " />
                                                </div>

                                            </div>

                                        </div>

                                    </div>



                                </div>
                            </div>

                        </section>


                        {{-- Attachments --}}
                        <section class="attachments mt-5">

                            {{-- Attachments --}}
                            <x-header title="  المرفقات " />

                            <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                                <div class="m-4">

                                    <div class="row mb-3">

                                        {{-- father_death_certificate --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                <label class="mb-2 fw-bold">  أرفق صورة شهادة وفاة الأب
                                                    <span class="text-danger">*</span>
                                                </label> <br>
                                                <label for="father_death_certificate" class="custom-file-upload text-center" style="color:#777a78;">
                                                    <img src="{{asset('assets/images/file.png')}}" alt="" width="50px" height="50px"> <br>
                                                    اسحب الملف هنا أو اضغط لاختياره
                                                </label>
                                                <x-form.input name="father_death_certificate" class="hidden-file-style" type="file" id="father_death_certificate" style="display: none;"/>
                                        </div>

                                        {{-- wife_ID --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                <label class="mb-2 fw-bold">  أرفق صورة هوية الزوجة كاملة مع السليب
                                                    <span class="text-danger">*</span>
                                                </label> <br>
                                                <label for="wife_ID" class="custom-file-upload text-center" style="color:#777a78;">
                                                    <img src="{{asset('assets/images/file.png')}}" alt="" width="50px" height="50px"> <br>
                                                    اسحب الملف هنا أو اضغط لاختياره
                                                </label>
                                                <x-form.input name="wife_ID" class="hidden-file-style" type="file" id="wife_ID" style="display: none;"/>
                                        </div>

                                        {{-- sponsor_ID --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                <label class="mb-2 fw-bold">  أرفق صورة هوية الكفيل
                                                    <span class="text-danger">*</span>
                                                </label> <br>
                                                <label for="sponsor_ID" class="custom-file-upload text-center" style="color:#777a78;">
                                                    <img src="{{asset('assets/images/file.png')}}" alt="" width="50px" height="50px"> <br>
                                                    اسحب الملف هنا أو اضغط لاختياره
                                                </label>
                                                <x-form.input name="sponsor_ID" class="hidden-file-style" type="file" id="sponsor_ID" style="display: none;"/>
                                        </div>


                                        {{-- birth_certificate --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                <label class="mb-2 fw-bold">  أرفق صورة شهادة الميلاد
                                                    <span class="text-danger">*</span>
                                                </label> <br>
                                                <label for="birth_certificate" class="custom-file-upload text-center" style="color:#777a78;">
                                                    <img src="{{asset('assets/images/file.png')}}" alt="" width="50px" height="50px"> <br>
                                                    اسحب الملف هنا أو اضغط لاختياره
                                                </label>
                                                <x-form.input name="birth_certificate" class="hidden-file-style" type="file" id="birth_certificate" style="display: none;"/>
                                        </div>

                                        {{-- personl_image --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                <label class="mb-2 fw-bold">  أرفق صورة شخصية حديثة للطفل
                                                    <span class="text-danger">*</span>
                                                </label> <br>
                                                <label for="personl_image" class="custom-file-upload text-center" style="color:#777a78;">
                                                    <img src="{{asset('assets/images/file.png')}}" alt="" width="50px" height="50px"> <br>
                                                    اسحب الملف هنا أو اضغط لاختياره
                                                </label>
                                                <x-form.input name="personl_image" class="hidden-file-style" type="file" id="personl_image" style="display: none;"/>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </section>

                        <div class="d-flex justify-content-center gap-4 mt-4">
                            <button class="submit-btn mb-4"  type="submit"> إرسال الطلب </button>
                        </div>

                    </div>


                </form>

            </div>

        </div>

    </section>

    @push('scripts')



        <script>

            function addRow() {
                const table = document.getElementById("siblingsTable").getElementsByTagName('tbody')[0];
                const newRow = table.insertRow();
                const uniqueId = `medical_report_${Date.now()}`; // إنشاء id فريد باستخدام الطابع الزمني

                newRow.innerHTML = `
                    <td>${table.rows.length}</td>
                    <td>
                        <input name="brother_name[]" type="text" placeholder="اسم الأخ/الأخت" class="form-control" />
                    </td>
                    <td>
                        <input name="brother_id_number[]" type="text" placeholder="رقم الهوية" class="form-control starts-with-X" />
                    </td>
                    <td>
                        <select name="brother_gender[]" class="form-control">
                            <option value="" selected> أدخل الجنس </option>
                            <option value="ذكر">ذكر</option>
                            <option value="أنثى">أنثى</option>
                        </select>
                    </td>
                    <td>
                        <input name="brother_birth_date[]" type="date" class="form-control" />
                    </td>
                    <td>
                        <select name="brother_health_status[]" class="form-control rounded form-select">
                            <option value="" selected>اختر</option>
                            <option value="سليم">سليم</option>
                            <option value="مريض">مريض</option>
                        </select>

                    </td>
                    <td>
                        <label for="${uniqueId}" class="btn btn-sm btn-outline-secondary">
                            <img src="{{asset('assets/images/file.png')}}"  width="15px" height="15px">
                            اختر الملف
                            <input type="file" name="brother_medical_report[]" id="${uniqueId}" class="d-none">
                        </label>
                    </td>
                `;
            }

        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // إظهار التقرير الطبي إذا كان "مريض"
                function toggleMedicalReport() {
                    const isSick = document.querySelector('input[name="health_status"]:checked')?.value === 'مريض';
                    document.getElementById("medical_report_health").style.display = isSick ? "block" : "none";
                }

                // إظهار طبيعة عمل الأب إذا "يعمل"
                function toggleFatherWork() {
                    const isWorking = document.querySelector('input[name="father_work"]:checked')?.value === 'يعمل';
                    document.getElementById("nature_father_work").style.display = isWorking ? "block" : "none";
                    document.getElementById("nature_work").style.display = isWorking ? "block" : "none";
                }

                // إظهار طبيعة عمل الأم إذا "تعمل"
                function toggleMotherWork() {
                    const isWorking = document.querySelector('input[name="mother_work"]:checked')?.value === 'تعمل';
                    document.getElementById("nature_mother_work").style.display = isWorking ? "block" : "none";
                }

                // استدعاء أولي لتطبيق الحالة حسب القيم المحفوظة (في حال التعديل)
                toggleMedicalReport();
                toggleFatherWork();
                toggleMotherWork();

                // إضافة مستمعي الأحداث
                document.querySelectorAll('input[name="health_status"]').forEach(el => {
                    el.addEventListener('change', toggleMedicalReport);
                });

                document.querySelectorAll('input[name="father_work"]').forEach(el => {
                    el.addEventListener('change', toggleFatherWork);
                });

                document.querySelectorAll('input[name="mother_work"]').forEach(el => {
                    el.addEventListener('change', toggleMotherWork);
                });
            });
        </script>


        <script>
            document.getElementById('id_number').addEventListener('input', function() {
                let idNumber = this.value.trim();
                if (idNumber.length > 0) {
                    // توليد 3 حروف عشوائية
                    let randomLetters = '';
                    let chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    for (let i = 0; i < 3; i++) {
                        randomLetters += chars.charAt(Math.floor(Math.random() * chars.length));
                    }

                    // دمج رقم الهوية مع الحروف العشوائية
                    let orphanCode = idNumber + randomLetters;

                    // وضع القيمة في حقل الكود وتعطيله
                    let codeInput = document.getElementById('orphan_code');
                    codeInput.value = orphanCode;
                    codeInput.setAttribute('readonly', 'readonly');
                } else {
                    document.getElementById('orphan_code').value = '';
                    document.getElementById('orphan_code').removeAttribute('readonly');
                }
            });
        </script>

        <script>
            document.querySelectorAll('.starts-with-4').forEach(function(input) {
                input.addEventListener('input', function() {
                    // إزالة أي أحرف غير الأرقام
                    this.value = this.value.replace(/\D/g, '');
            
                    // الحد الأقصى 9 أرقام
                    if (this.value.length > 9) {
                        this.value = this.value.slice(0, 9);
                    }
            
                    // تحقق أن أول رقم >= 4
                    if (this.value.length > 0 && parseInt(this.value[0]) < 4) {
                        alert("الرقم يجب أن يبدأ بـ 4 أو أكبر");
                        this.value = ''; // نفرغ الحقل
                    }
                });
            });
        </script>




    @endpush


</x-main-layout>
