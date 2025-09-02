<x-main-layout title="مؤسسة سبيلي الخيرية">

    <section class="mt-1">

        <x-alert name="success" />
        <x-alert name="danger" />



        {{-- section header component --}}
        <h3 class="mb-5"> تعديل بيانات اليتيم </h3>

        <div class="rounded mt-3" style="border-top-color:#f0fff4 !important">

            <div class="mt-4 mb-4 row">


                <form action="{{route('orphan.update' , $orphan->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

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
                                            <x-form.input name="name"  type="text" id="name" label=" الاسم الرباعي لليتيم " value="{{$orphan->name}}" required="required" placeholder=" ادخل الاسم الرباعي " />
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="id_number" value="{{$orphan->id_number}}"  type="text" id="id_number" label=" رقم هوية اليتيم " required="required" placeholder=" ادخل رقم الهوية " />
                                        </div>

                                        {{-- birth-date --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="birth_date" value="{{$orphan->birth_date}}" type="date" id="birth-date" label=" تاريخ ميلاد اليتيم " required="required" />
                                        </div>

                                        {{-- birth-place --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="orphan_code" value="{{$orphan->orphan_code}}" type="text" id="orphan_code" required="required" label=" رقم كود اليتيم " placeholder="ادخل رقم كود اليتيم"/>
                                        </div>

                                        {{-- address --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="address" value="{{$orphan->address}}" type="text" id="address" required="required" label=" العنوان / المدينة " placeholder="ادخل العنوان / المدينة" />
                                        </div>

                                        {{-- gender --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <label class="mb-2 fw-bold"> الجنس
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="d-flex align-items-center gap-5">
                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="gender" type="radio" id="male"  value="ذكر" @checked($orphan->gender =="ذكر" || old('gender')=='ذكر')/>
                                                    <label class="form-check-label" for="male" style="color: rgba(36, 36, 36, 0.6)"> ذكر </label>
                                                </div>

                                                <div class="d-flex  gap-1">
                                                    <input class="radio-input p-0" name="gender" type="radio" id="female"  value="أنثى" @checked($orphan->gender =="أنثى" || old('gender')=='أنثى')/>
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

                                            <x-form.radio name="health_status" label="الحالة الصحية" :options="['سليم' => 'سليم' , 'مريض' => 'مريض']" :selected="$orphan->health_status" required/>

                                        </div>

                                        {{-- medical_report --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                <label class="mb-2 fw-bold">   التقرير الطبي في حال كان مريض
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <br>
                                                @if($orphan->image && $orphan->image->medical_report)
                                                <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->medical_report)])}}" type="button" class="text-decoration-none file-image p-2">
                                                    <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                    التقرير الطبي
                                                </a>
                                                @endif
                                                <br>
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
                                            <x-form.input name="deceased_name" value="{{$orphan->deceased_name}}"  type="text" id="name" required="required" label=" اسم (الشهيد/ المتوفى) رباعي " placeholder=" ادخل الاسم الرباعي " />
                                        </div>

                                        {{-- deceased_id_number --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="deceased_id_number" value="{{$orphan->deceased_id_number}}"  type="text" id="deceased_id_number" label=" رقم هوية (الشهيد/ المتوفى)  " required="required" placeholder=" ادخل رقم الهوية " />
                                        </div>

                                        {{-- death_deceased_date --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="death_deceased_date" value="{{$orphan->death_deceased_date}}" type="date" id="death_deceased_date" label=" تاريخ (الإستشهاد/ الوفاة) " required="required"/>
                                        </div>

                                        {{-- cause_deceased_death --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">

                                            <x-form.radio name="cause_deceased_death" label=" سبب الوفاة " :options="['وفاة طبيعية' => 'وفاة طبيعية', 'شهيد' => 'شهيد']" :selected="$orphan->cause_deceased_death" />

                                        </div>

                                        {{-- father_work --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">

                                            <x-form.radio name="father_work" label=" هل كان الأب يعمل " :options="['نعم' => 'يعمل' , 'لا' => 'لا يعمل']" :selected="$orphan->father_work"/>

                                        </div>

                                        {{-- nature_father_work --}}
                                        @if($orphan->nature_father_work)
                                        <div class="col-12 col-md-6  mb-4">

                                            <x-form.radio name="nature_father_work" label=" طبيعة عمل الأب " :options="['موظف حكومي' => 'موظف حكومي' , 'موظف وكالة' => 'موظف وكالة' , 'عمل خاص' => 'عمل خاص']" :selected="$orphan->nature_father_work"/>

                                        </div>
                                        @endif

                                        {{-- nature_work --}}
                                        @if($orphan->nature_work)
                                        <div class="col-12 mb-4">
                                            <x-form.input name="nature_work" value="{{$orphan->nature_work}}" type="text" id="nature_work" label=" طبيعة العمل " placeholder="ادخل طبيعة العمل"/>
                                        </div>
                                        @endif



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
                                            <x-form.input name="mother_name" value="{{$orphan->mother_name}}" type="text" id="mother_name" required="required" label=" اسم زوجة (الشهيد/ المتوفى) رباعي " placeholder=" ادخل الاسم الرباعي " />
                                        </div>

                                        {{-- mother_id_number --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="mother_id_number" value="{{$orphan->mother_id_number}}" type="text" id="mother_id_number" label=" رقم هوية زوجة (الشهيد/ المتوفى) " placeholder=" ادخل رقم الهوية " />
                                        </div>

                                        {{-- mother_birth_date --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="mother_birth_date" value="{{$orphan->mother_birth_date}}" type="date" id="mother_birth_date" label=" تاريخ ميلاد الأم "  />
                                        </div>


                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            {{-- :selected="$orphan->case_type" --}}
                                            <x-form.select id="mother_status" label="حالة الأم"  required="required"  name="mother_status"
                                                :options="['' =>  __('اختر'), 'على قيد الحياة- أرملة' => __('على قيد الحياة- أرملة'), 'على قيد الحياة- متزوجة زوج آخر' => __('على قيد الحياة- متزوجة زوج آخر')
                                                , 'على قيد الحياة- مطلقة' => __('على قيد الحياة- مطلقة') , 'شهيدة/ متوفية' => __('شهيدة/ متوفية')]"  :selected="$orphan->mother_status"/>
                                        </div>

                                        {{-- mother_work --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.radio name="mother_work" label=" هل الأم تعمل؟ " :options="['نعم' => 'تعمل' , 'لا' => 'لا تعمل']" :selected="$orphan->mother_work"/>
                                        </div>

                                        {{-- nature_mother_work --}}
                                        @if($orphan->nature_mother)
                                        <div class="col-12 col-md-6  mb-4">
        
                                            <x-form.radio name="nature_mother_work" label=" طبيعة عمل الأم " :options="['موظفة حكومة' => 'موظف حكومي' , 'موظفة وكالة' => 'موظف وكالة' , 'عمل خاص' => 'عمل خاص']" :selected="$orphan->nature_mother_work"/>
                                        </div>
                                        @endif

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
                                            <x-form.input name="guardian_name" value="{{$orphan->guardian_name}}"  type="text" required="required" id="guardian_name" label=" اسم الوكيل رباعي " placeholder=" ادخل الاسم الرباعي " />
                                        </div>

                                        {{-- guardian_id_number --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="guardian_id_number" value="{{$orphan->guardian_id_number}}" required="required" type="text" id="guardian_id_number" label=" رقم هوية الوكيل " placeholder=" ادخل رقم الهوية " />
                                        </div>

                                        {{-- guardian_relation --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            {{-- :selected="$orphan->case_type" --}}
                                            <x-form.select id="guardian_relation" label=" صلة القرابة  "  required="required"  name="guardian_relation" :selected="$orphan->guardian_relation"
                                                :options="['' =>  __('اختر'), 'أم' => __('أم'), 'أخ/ت' => __('أخ/ت') , 'جد/ة' => __('جد/ة') , 'عم/ة' => __('عم/ة')
                                                , 'خال/ة' => __('خال/ة') , 'غير ذلك' => __('غير ذلك')]"/>
                                        </div>

                                        {{-- guardian_anthor_relation --}}
                                        @if($orphan->guardian_anthor_relation)
                                        <div class="col-12  mb-4">
                                            <x-form.input name="guardian_anthor_relation" value="{{$orphan->guardian_anthor_relation}}"  required="required"  type="text" id="guardian_anthor_relation" label=" إذا كان غير ذلك, يرجى توضيح صلة القرابة " placeholder=" ادخل صلة القرابة " />
                                        </div>
                                        @endif


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
                                        <table id="siblingsTable" class="border-0 w-100">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">الاسم رباعي</th>
                                                    <th scope="col">رقم الهوية</th>
                                                    <th scope="col">الجنس</th>
                                                    <th scope="col">تاريخ الميلاد</th>
                                                    <th scope="col">الحالة الصحية</th>
                                                    <th scope="col">التقرير الطبي</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($orphan?->brothers && $orphan->brothers->isNotEmpty())

                                                    @foreach($orphan->brothers as $brother)

                                                        <tr>
                                                            <td scope="row">{{ $loop->iteration }}</td>

                                                            <td>
                                                                <span  class="value">  {{$brother->brother_name}} </span>
                                                            </td>

                                                            <td><span  class="value">   {{$brother->brother_id_number}}  </span></td>

                                                            <td><span  class="value">   {{$brother->brother_gender}}   </span> </td>

                                                            <td> <span  class="value">  {{$brother->brother_birth_date}}   </span> </td>

                                                            <td> <span  class="value">   {{$brother->brother_health_status}} </span> </td>

                                                            @if($brother->brother_medical_report)
                                                                <td>

                                                                    <a href="{{route('orphan.show.image' , ['file' => encrypt($brother->brother_medical_report)])}}" type="button" class="text-decoration-none file-image p-2">
                                                                        <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                                        التقرير الطبي
                                                                    </a>

                                                                </td>
                                                            @else
                                                                <td></td>
                                                            @endif
                                                        </tr>

                                                    @endforeach

                                                @else

                                                    <tr>
                                                        <td scope="row">1</td>

                                                        <td>
                                                            <input name="brother_name[]" type="text" placeholder="أدخل اسم الأخ/الأخت" class="rounded form-control" />
                                                        </td>

                                                        <td>
                                                            <input name="brother_id_number[]" type="text" placeholder=" رقم الهوية " class="rounded form-control" />
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
                                                                <option selected value="" >اختر</option>
                                                                <option value="سليم">سليم</option>
                                                                <option value="مريض">مريض</option>

                                                            </select>
                                                        </td>

                                                        <td>

                                                            <label for="brother_medical_report" class="custom-file-upload text-center p-1"  style="font-size:14px;color:#777a78; border:1px solid #777a78 ">
                                                                {{-- <img src=""  width="30px" height="30px"> --}}
                                                                اختر الملفات
                                                            </label>
                                                            <x-form.input name="brother_medical_report[]" class="hidden-file-style" type="file" id="brother_medical_report" style="display: none;"/>

                                                        </td>

                                                    </tr>
                                                @endif

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
                                                <x-form.input name="phone" value="{{$orphan->phone}}" type="text" required="required" id="phone" label=" رقم جوال أساسي " placeholder=" ادخل رقم جوال أساسي " />
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                            <div class="w-100">
                                                <x-form.input name="phone1" value="{{$orphan->phone1}}" type="text" required="required" id="phone1" label=" رقم جوال ثانوي " placeholder=" ادخل رقم جوال ثانوي " />
                                            </div>
                                        </div>


                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                            <div class="w-100">
                                                <x-form.input name="email" value="{{$orphan->email}}" type="email"  id="email" label=" البريد الالكتروني" placeholder=" ادخل البريد الالكتروني " />
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
                                                    <x-form.select id="bank_name" label=" اسم البنك  "  name="bank_name" :selected="$orphan->bank_name"
                                                        :options="['' =>  __('اختر'), 'فلسطين' => __('فلسطين'), 'الاسلامي الفلسطيني' => __('الاسلامي الفلسطيني') ,'الاسلامي العربي' => __('الاسلامي العربي'), 'القدس' => __('القدس'), 'الاردن' => __('الاردن'), 'القاهرة عمان' => __('القاهرة عمان') ]"/>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="bank_account_owner" value="{{$orphan->bank_account_owner}}"  type="text" id="bank_account_owner" required="required" label=" اسم صاحب الحساب رباعي " placeholder="ادخل اسم صاحب الحساب رباعي" />
                                                </div>

                                                 <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="bank_owner_id_number" value="{{$orphan->bank_owner_id_number}}" type="text" id="bank_owner_id_number" required="required" label=" رقم هوية صاحب الحساب " placeholder="ادخل رقم هوية صاحب الحساب" />
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="phone_number_linked_bank" value="{{$orphan->phone_number_linked_bank}}" required="required"  type="text" id="phone_number_linked_bank" label=" رقم الجوال المرتبط بالحساب البنكي " placeholder="ادخل رقم الجوال المرتبط بالحساب البنكي" />
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="bank_account_number" value="{{$orphan->bank_account_number}}" required="required"  type="text" id="bank_account_number" label=" رقم الحساب البنكي " placeholder="ادخل رقم الحساب البنكي" />
                                                </div>

                                            </div>
                                        </div>

                                        {{-- استلام الكفالة عن طريق محفظة بال باي: --}}

                                        <div id="receive-wallet">
                                            <label class="mb-2 fw-bold" style="color: var(--primary-color)">  استلام الكفالة عن طريق المحفظة  :  </label>
                                            <div class="d-flex align-items-center row mb-3">

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="wallet_owner" value="{{$orphan->wallet_owner}}"  type="text" id="wallet_owner" label=" اسم صاحب المحفظة " placeholder="ادخل اسم صاحب المحفظة  " />
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="wallet_owner_id_number" value="{{$orphan->wallet_owner_id_number}}" class="" type="text" id="wallet_owner_id_number" label=" رقم هوية صاحب المحفظة " placeholder="ادخل رقم هوية صاحب المحفظة" />
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <x-form.input name="owner_phone_linked_wallet" value="{{$orphan->owner_phone_linked_wallet}}" class="" type="text" id="owner_phone_linked_wallet" label=" رقم الجوال المرتبط بالمحفظة " placeholder="ادخل رقم الجوال المرتبط بالمحفظة " />
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
                                                </label>
                                                 @if($orphan->image && $orphan->image->father_death_certificate)
                                                 <br>
                                                <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->father_death_certificate)])}}" type="button" class="text-decoration-none file-image p-2">
                                                    <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                    شهادة وفاة الأب
                                                </a>
                                                @endif
                                                 <br>
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
                                                </label>
                                                @if($orphan->image && $orphan->image->wife_ID)
                                                 <br>
                                                 <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->wife_ID)])}}" type="button" class="text-decoration-none file-image p-2">
                                                    <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                    صورة هوية الزوجة كاملة
                                                </a>
                                                @endif
                                                <br>
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
                                                </label> 
                                                 @if($orphan->image && $orphan->image->sponsor_ID)<br>
                                                <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->sponsor_ID)])}}" type="button" class="text-decoration-none file-image p-2">
                                                    <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                    صورة هوية الوكيل
                                                </a>
                                                @endif
                                                <br>
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
                                                </label>
                                                @if($orphan->image && $orphan->image->birth_certificate)<br>
                                                <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->birth_certificate)])}}" type="button" class="text-decoration-none file-image p-2">
                                                    <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                    شهادة الميلاد
                                                </a>
                                                @endif
                                                <br>
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
                                                </label> 
                                                @if($orphan->image && $orphan->image->personl_image)
                                                <br>
                                                <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->personl_image)])}}" type="button" class="text-decoration-none file-image p-2">
                                                    <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                    صورة شخصية حديثة
                                                </a>
                                                @endif
                                                <br>

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
                            <button class="submit-btn mb-4"  type="submit">  حفظ التعديل </button>
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
                const rowCount = table.rows.length + 1;
                const row = table.insertRow();
                row.innerHTML = `
                    <td>${rowCount}</td>
                    <td>
                        <input name="brother_name[]" type="text" placeholder="أدخل اسم الأخ/الأخت" class="rounded form-control" />
                    </td>

                        <td>
                        <input name="brother_id_number[]" type="text" placeholder=" رقم الهوية " class="rounded form-control" />
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
                            <option selected value="">اختر</option>
                            <option value="سليم">سليم</option>
                            <option value="مريض">مريض</option>

                        </select>
                    </td>

                    <td>

                        <label for="brother_medical_report" class="custom-file-upload text-center p-1"  style="font-size:14px;color:#777a78; border:1px solid #777a78">
                            {{-- <img src=""  width="30px" height="30px"> --}}
                            اختر الملفات
                        </label>
                        <x-form.input name="brother_medical_report[]" class="hidden-file-style" type="file" id="brother_medical_report" style="display: none;"/>

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
                    // اجعل الحقل يبدأ دائمًا بالرقم 4
                    if (!this.value.startsWith('4')) {
                        this.value = '4' + this.value.replace(/4/g, '');
                    }

                    // الحد الأقصى 9 أرقام
                    if (this.value.length > 9) {
                        this.value = this.value.slice(0, 9);
                    }

                    // إزالة أي أحرف غير الأرقام
                    this.value = this.value.replace(/\D/g, '');
                    // إعادة الرقم 4 في البداية بعد إزالة الأحرف
                    if (!this.value.startsWith('4')) {
                        this.value = '4' + this.value.slice(1);
                    }
                });
            });
        </script>

    @endpush


</x-main-layout>
