<x-main-layout title="مؤسسة سبيلي الخيرية">

    @push('styles')

        <style>
            .value{
                color: rgba(36, 36, 36, 0.6)
            }
        </style>

    @endpush

    <section class="mt-1">

        <x-alert name="success" />
        <x-alert name="danger" />



        {{-- section header component --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h3 class="mb-5"> صفحة بيانات الموظف </h3>
            <a href="{{route('employee.edit' , $employee->id)}}" class="submit-btn text-decoration-none">تعديل البيانات</a>
        </div>

        <div class="rounded mt-3" style="border-top-color:#f0fff4 !important">

            <div class="mt-4 mb-4 row">


                {{-- basic information section --}}
                <section class="basic-information">

                    {{-- section header component --}}
                    <x-header title=" بيانات الموظف " />

                    <div class="border border-1 rounded" style="border-top-color:#f0fff4 !important">

                        <div class="mt-4 mb-4 ms-3 me-3">

                            <div class="row mb-3 justify-content-between">

                                <div class="col-3">
                                    @if ($employee->image)

                                        <img src="{{asset('storage/' . $employee->image)}}" alt="" class="w-100">

                                    @else
                                        <img src="{{asset('assets/images/profile.png')}}" alt="" class="w-100">
                                    @endif
                                </div>

                                <div class="col-8">
                                    {{-- orphan-name --}}
                                    <div class="col-12 col-md-6  mb-4">
                                        <span class="fw-bold">اسم الموظف:</span>
                                        <span  class="value">  {{$employee->name}} </span>
                                    </div>

                                    <div class="col-12 col-md-6  mb-4">
                                        <span class="fw-bold"> البريد الالكتروني:</span>
                                        <span  class="value"> {{$employee->email}} </span>
                                    </div>

                                    <div class="col-12 col-md-6  mb-4">
                                        <span class="fw-bold">   رقم الهاتف:</span>
                                        <span  class="value"> {{$employee->phone}} </span>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>

                </section>



            </div>

        </div>

    </section>




</x-main-layout>
