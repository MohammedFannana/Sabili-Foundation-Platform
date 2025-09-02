<x-main-layout title="مؤسسة سبيلي الخيرية">

    <section class="mt-1">

        <x-alert name="success" />
        <x-alert name="danger" />



        {{-- section header component --}}
        <h3 class="mb-5"> تعديل بيانات الموظف </h3>



        <div class="rounded mt-3" style="border-top-color:#f0fff4 !important">

            <div class="mt-4 mb-4 row">


                <form action="{{route('employee.update' , $employee->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- basic information section --}}
                        <section class="basic-information">

                            {{-- section header component --}}
                            <x-header title=" بيانات الموظف " />

                            <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                                <div class="mt-4 mb-4 ms-3 me-3">

                                    <div class="row mb-3">

                                        {{-- orphan-name --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="name"  type="text" id="name" label=" الاسم الرباعي للموظف " value="{{$employee->name}}" required="required" placeholder=" ادخل الاسم الرباعي " />
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="email"  type="email" id="email" label="  البريد الالكتروني " value="{{$employee->email}}" required="required" placeholder=" ادخل  البريد الالكتروني   " />
                                        </div>


                                        {{-- birth-place --}}
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input name="phone"  type="text" id="phone" required="required" label=" رقم هاتف الموظف " value="{{$employee->phone}}" placeholder="ادخل رقم هاتف الموظف"/>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input type="password"  name="password"  autocomplete="new-password"  required="required" label=" كلمة المرور " placeholder="ادخل كلمة المرور"/>
                                        </div>

                                         <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <x-form.input  type="password" name="password_confirmation" required="required" autocomplete="new-password"   label=" تأكيد كلمة المرور " placeholder="ادخل تأكيد كلمة المرور"/>
                                        </div>



                                        {{-- image --}}
                                        <div class="col-12 col-md-6  mb-4" >
                                                <label class="mb-2 fw-bold"> الصورة الشخصية
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <br>
                                                <a href="{{route('orphan.show.image' , ['file' => encrypt($employee->image)])}}" type="button" class="text-decoration-none file-image p-2">
                                                    <img src="{{asset('assets/icon/album.png')}}" alt="" width="24px" height="24px" >
                                                    الصورة الشخصية
                                                </a>
                                                <br>
                                                <label for="image" class="custom-file-upload text-center" style="color:#777a78;">
                                                    <img src="{{asset('assets/images/file.png')}}" alt="" width="50px" height="50px"> <br>
                                                    اسحب الملف هنا أو اضغط لاختياره
                                                </label>
                                                <x-form.input name="image" class="hidden-file-style" type="file" id="image" style="display: none;"/>
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


</x-main-layout>
