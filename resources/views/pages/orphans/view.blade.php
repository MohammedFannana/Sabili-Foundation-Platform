<x-main-layout title="مؤسسة سبيلي الخيرية">

    @push('styles')

        <style>
            .value{
                color: rgba(36, 36, 36, 0.6)
            }

             table , td , th ,tr{
                border: none !important;
                border-bottom: none !important;
            }

            .table-info{
               --bs-table-bg: var(--third-color);
               border-top-right-radius: 10px;
               border-top-left-radius: 10px;
            }
        </style>

    @endpush

    <section class="mt-1">

        <x-alert name="success" />
        <x-alert name="danger" />



        {{-- section header component --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h3 class="mb-5"> صفحة بيانات اليتيم </h3>
            <a href="{{route('orphan.edit' ,$orphan->id)}}" class="submit-btn text-decoration-none">تعديل البيانات</a>
        </div>

        <div class="rounded mt-3" style="border-top-color:#f0fff4 !important">

            <div class="mt-4 mb-4 row">

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
                                        <span class="fw-bold"> الاسم الرباعي لليتيم:</span>
                                        <span  class="value">  {{$orphan->name}} </span>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> رقم هوية اليتيم:</span>
                                        <span  class="value"> {{$orphan->id_number}} </span>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> رقم كود اليتيم:</span>
                                        <span  class="value"> {{$orphan->orphan_code}} </span>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> الجنس:</span>
                                        <span  class="value"> {{$orphan->gender}} </span>
                                    </div>

                                    {{-- address --}}
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> العنوان / المدينة:</span>
                                        <span  class="value"> {{$orphan->address}} </span>
                                    </div>



                                    {{-- birth-date --}}
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> تاريخ ميلاد اليتيم :</span>
                                         <span  class="value"> {{$orphan->birth_date}} </span>
                                    </div>

                                    {{-- health-status --}}
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> الحالة الصحية:</span>
                                         <span  class="value"> {{$orphan->health_status}} </span>
                                    </div>


                                    <div class="col-12 col-md-8 d-flex gap-3 mb-4">

                                        {{-- {{route('orphan.primary.image' , ['file' => encrypt($orphan->mother_death_certificate)])}} --}}
                                        @if ($orphan->image && $orphan->image->medical_report)
                                            <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->medical_report)])}}" type="button" class="text-decoration-none file-image p-2">
                                                <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                التقرير الطبي
                                            </a>
                                        @endif

                                        @if ($orphan->image && $orphan->image->birth_certificate)
                                            <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->birth_certificate)])}}" type="button" class="text-decoration-none file-image p-2">
                                                <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                شهادة الميلاد
                                            </a>
                                        @endif

                                        @if ($orphan->image && $orphan->image->personl_image)
                                            <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->personl_image)])}}" type="button" class="text-decoration-none file-image p-2">
                                                <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                صورة شخصية حديثة
                                            </a>
                                        @endif

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
                                        <span class="fw-bold"> اسم (الشهيد/ المتوفى):</span>
                                        <span  class="value"> {{$orphan->deceased_name}} </span>
                                    </div>

                                    {{-- deceased_id_number --}}
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> رقم هوية (الشهيد/ المتوفى):</span>
                                        <span  class="value">  {{$orphan->deceased_id_number}} </span>
                                    </div>

                                    {{-- death_deceased_date --}}
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> تاريخ (الإستشهاد/ الوفاة):</span>
                                        <span  class="value">  {{$orphan->death_deceased_date}} </span>
                                    </div>

                                    {{-- cause_deceased_death --}}
                                    @if($orphan->cause_deceased_death)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <span class="fw-bold"> سبب الوفاة:</span>
                                            <span  class="value">  {{$orphan->cause_deceased_death}} </span>
                                        </div>
                                    @endif


                                    {{-- father_work --}}
                                    @if($orphan->father_work)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <span class="fw-bold"> عمل الأب:</span>
                                            <span  class="value">  {{$orphan->father_work}} </span>
                                        </div>
                                    @endif

                                    {{-- nature_father_work --}}
                                    @if($orphan->nature_father_work)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <span class="fw-bold"> طبيعة عمل الأب:</span>
                                            <span  class="value"> {{$orphan->nature_father_work}} </span>
                                        </div>
                                    @endif


                                    {{-- nature_work --}}
                                    @if ($orphan->nature_work)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <span class="fw-bold"> طبيعة العمل </span>
                                            <span  class="value">  {{$orphan->nature_work}}  </span>
                                        </div>
                                    @endif

                                    @if ($orphan->image && $orphan->image->father_death_certificate)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->father_death_certificate)])}}" type="button" class="text-decoration-none file-image p-2">
                                                <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                شهادة وفاة الأب
                                            </a>
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
                                        <span class="fw-bold"> اسم زوجة (الشهيد/ المتوفى) :</span>
                                        <span  class="value">  {{$orphan->mother_name}} </span>
                                    </div>

                                    {{-- mother_id_number --}}
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> رقم هوية زوجة (الشهيد/ المتوفى):</span>
                                        <span  class="value">  {{$orphan->mother_id_number}}  </span>
                                    </div>

                                    {{-- mother_birth_date --}}
                                    @if ($orphan->mother_birth_date)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <span class="fw-bold"> تاريخ ميلاد الأم:</span>
                                            <span  class="value">  {{$orphan->mother_birth_date}}  </span>
                                        </div>
                                    @endif

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                       <span class="fw-bold"> حالة الأم:</span>
                                       <span  class="value">  {{$orphan->mother_status}}  </span>
                                    </div>


                                    {{-- mother_work --}}
                                    @if($orphan->mother_work)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> عمل الأم:</span>
                                        <span  class="value"> {{$orphan->mother_work}} </span>
                                        </div>
                                    @endif



                                    {{-- nature_mother_work --}}
                                    @if($orphan->nature_mother_work)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> طبيعة عمل الأم:</span>
                                        <span  class="value"> {{$orphan->nature_mother_work}} </span>
                                        </div>
                                    @endif

                                    @if ($orphan->image && $orphan->image->wife_ID)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->wife_ID)])}}" type="button" class="text-decoration-none file-image p-2">
                                                <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                صورة هوية الزوجة كاملة
                                            </a>
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
                                       <span class="fw-bold"> اسم الوكيل رباعي:</span>
                                       <span  class="value">  {{$orphan->guardian_name}} </span>
                                    </div>

                                    {{-- guardian_id_number --}}
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> رقم هوية الوكيل:</span>
                                        <span  class="value">   {{$orphan->guardian_id_number}}  </span>
                                    </div>

                                    {{-- guardian_relation --}}
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> صلة القرابة:</span>
                                        <span  class="value">   {{$orphan->guardian_relation}}  </span>
                                    </div>

                                    {{-- guardian_anthor_relation --}}
                                    @if($orphan->guardian_anthor_relation)
                                        <div class="col-12 col-md-6 col-lg-4  mb-4">
                                            <span class="fw-bold">  توضيح صلة القرابة:</span>
                                            <span  class="value">   {{$orphan->guardian_anthor_relation}}  </span>
                                        </div>
                                    @endif

                                    @if ($orphan->image && $orphan->image->sponsor_ID)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <a href="{{route('orphan.show.image' , ['file' => encrypt($orphan->image->sponsor_ID)])}}" type="button" class="text-decoration-none file-image p-2">
                                                <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                صورة هوية الوكيل
                                            </a>
                                        </div>
                                    @endif


                                </div>

                            </div>
                        </div>

                    </section>


                    {{-- بيانات إخوة اليتيم --}}
                    @if($orphan->brothers->isNotEmpty())
                        <section class="family-information mt-5">

                            {{-- section header component --}}
                            <x-header title=" بيانات الأخوة (غير أساسي) " />

                            <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                                <div class="m-4">

                                    <div class="table-responsive">
                                        <table  class="table border-0">
                                            <thead class="table-info">
                                                <tr>
                                                    <th scope="col" style="border-top-right-radius:15px">#</th>
                                                    <th scope="col">الاسم رباعي</th>
                                                    <th scope="col">رقم الهوية</th>
                                                    <th scope="col">الجنس</th>
                                                    <th scope="col">تاريخ الميلاد</th>
                                                    <th scope="col">الحالة الصحية</th>
                                                    <th scope="col" style="border-top-left-radius:15px">التقرير الطبي</th>
                                                </tr>
                                            </thead>
                                            <tbody>

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

                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>

                        </section>
                    @endif


                    {{-- Contact information--}}
                    <section class="contact-information mt-5">

                        {{-- section header component --}}
                        <x-header title=" بيانات التواصل " />

                        <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                            <div class="m-4">

                                <div class="row mb-3">


                                    <div class="col-12 col-md-6 col-lg-4 mt-3">
                                        <div class="w-100">
                                            <span class="fw-bold"> رقم جوال أساسي:</span>
                                            <span  class="value">   {{$orphan->phone}}  </span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mt-3">
                                        <div class="w-100">
                                           <span class="fw-bold"> رقم جوال ثانوي:</span>
                                           <span  class="value">   {{$orphan->phone1}}  </span>
                                        </div>
                                    </div>


                                    @if($orphan->email)
                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                            <div class="w-100">
                                                <span class="fw-bold"> البريد الالكتروني:</span>
                                                <span  class="value">   {{$orphan->email}}  </span>
                                            </div>
                                        </div>
                                    @endif

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
                                        <label class="mb-2 fw-bold" style="color: var(--primary-color)"> بيانات حساب البنك:  </label>
                                        <div class="d-flex row align-items-center mb-3">

                                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                <span class="fw-bold"> اسم البنك:</span>
                                                <span  class="value">   {{$orphan->bank_name}} </span>
                                            </div>


                                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                <span class="fw-bold"> اسم صاحب الحساب:</span>
                                                <span  class="value">  {{$orphan->bank_account_owner}}  </span>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                 <span class="fw-bold"> رقم هوية صاحب الحساب:</span>
                                                 <span  class="value"> {{$orphan->bank_owner_id_number}} </span>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-6 mb-4">
                                                 <span class="fw-bold"> رقم الجوال المرتبط بالحساب البنكي </span>
                                                 <span  class="value"> {{$orphan->phone_number_linked_bank}} </span>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                 <span class="fw-bold"> رقم الحساب البنكي:</span>
                                                  <span  class="value"> {{$orphan->bank_account_number}} </span>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- استلام الكفالة عن طريق محفظة بال باي: --}}

                                   @if($orphan->wallet_owner)
                                    <div id="receive-wallet">
                                        <label class="mb-2 fw-bold" style="color: var(--primary-color)">  بيانات المحفظة:  </label>
                                        <div class="d-flex align-items-center row mb-3">

                                            @if($orphan->wallet_owner)
                                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                <span class="fw-bold"> اسم صاحب المحفظة </span>
                                                <span  class="value">  {{$orphan->wallet_owner}} </span>

                                            </div>
                                            @endif

                                            @if($orphan->wallet_owner_id_number)
                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <span class="fw-bold"> رقم هوية صاحب المحفظة:</span>
                                                    <span  class="value"> {{$orphan->wallet_owner_id_number}} </span>
                                                </div>
                                            @endif

                                            @if($orphan->owner_phone_linked_wallet)
                                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                    <span class="fw-bold"> رقم الجوال المرتبط بالمحفظة </span>
                                                    <span  class="value"> {{$orphan->owner_phone_linked_wallet}} </span>
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                    @endif


                                </div>



                            </div>
                        </div>

                    </section>


                </div>

            </div>

        </div>

    </section>




</x-main-layout>
