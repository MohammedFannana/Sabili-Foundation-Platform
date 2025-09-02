<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.rtl.min.css" integrity="sha384-q8+l9TmX3RaSz3HKGBmqP2u5MkgeN7HrfOJBLcTgZsQsbrx8WqqxdA5PuwUV9WIx" crossorigin="anonymous">

    <style>

        .nav-item{
            width: 100%;
        }

        .nav-link{
            padding-right: 5px;
            width: 100% !important;
            color: white !important
        }

        .li-active{
           background-color: var(--third-color);
        }

        .link-active{
            color: var(--primary-color) !important;
        }

        .a-active{
            display: inline-block;
            color: var(--third-color) !important;
            text-decoration: none;
            padding-right: 5px;
            width: 100% !important;
            padding-bottom: 8px;
            margin-bottom: 3px
        }


        @media (max-width: 425px) {
            .welcome{
                display: none;
            }
        }


    </style>

    @stack('styles')

</head>

<body class="hold-transition sidebar-mini layout-fixed" dir="rtl">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('assets/images/logo1.png')}}" alt=" مؤسسة سبيلي الخيرية " height="100" width="100">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand" style="border-bottom:none;">

            <ul class="navbar-nav ml-auto gap-4 f-flex align-items-center">

                <a class="" data-widget="pushmenu" href="#" role="button" style="color:var(--primary-color)"><i class="fas fa-bars"></i></a>

                @php
                        $user = null;

                        $nameParts = explode(' ', Auth::user()->name ?? '');
                        $displayName = '';
                        $displayName = $nameParts[0] ?? '';

                    @endphp

                <div  style="color:var(--primary-color)" class=" welcome d-flex align-items-center gap-2 fw-bold" style="font-size: 18px">
                    مرحبًا بعودتك, {{ $displayName }}
                    <img src="{{asset('assets/icon/hand.png')}}" alt="">
                </div>

            </ul>

            <!-- Left navbar links -->
            <ul class="navbar-nav d-flex align-items-center">

                <a href="{{route('notification')}}" style="position: relative">
                    <img src="{{asset('assets/icon/notification.png')}}" alt="" height="30px" style="margin-left:10px">
                    @if($unreadCountNotification > 0)
                        <span class="badge" style="color:var(--primary-color);position:absolute;left:26px;top: -15px;font-size:17px"> {{$unreadCountNotification}} </span>
                    @endif
                </a>

                @auth
                    @if(Auth::user()->image)
                        <img src="{{asset('storage/' . Auth::user()->image)}}" alt="" class="rounded-circle" width="56px" height="56px">
                    @else
                        <img src="{{asset('assets/images/profile.png')}}" alt="">
                    @endif
                @else
                    <img src="{{asset('assets/images/profile.png')}}" alt="">
                @endauth


                <div class="dropdown d-flex align-items-center gap-1" >
                    <button class="btn  dropdown-toggle border-0 d-flex align-items-center gap-2 fw-bold"data-bs-toggle="dropdown" aria-expanded="false" style="color: var(--primary-color)">
                        {{ $displayName }}
                    </button>
                    <ul class="dropdown-menu" style="transform: translateX(70px);">
                      {{-- <li><a class="dropdown-item" @if (Auth::check()) href="{{route('orphan.primary.index')}}" @else  href="{{route('profile.show')}}" @endif >الصفحة الشخصية</a></li> --}}
                        <li> <a class="dropdown-item"  href="{{route('profile.edit')}}" >الصفحة الشخصية</a></li>

                    </ul>
                </div>

            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar p-3" style="right:0px !important; left: initial !important; background-color:var(--primary-color)">
            <!-- Brand Logo -->
            <div class="mt-2 mb-3 d-flex justify-content-center">
                <img src="{{asset('assets/images/logo.png')}}" alt="" width="234px" height="146px">
            </div>

            <!-- Sidebar -->
            <div class="sidebar d-flex flex-column"  style="height: 100vh;">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        {{-- @auth --}}

                            <li class="nav-item rounded  mb-2  {{Route::is('home')?'li-active':''}}"> <!-- li-active -->
                                <a href="{{route('home')}}" class="nav-link d-flex gap-2 {{Route::is('home')?'link-active':''}}">  <!-- link-active -->
                                    @if(Route::is('home'))
                                        <img src="{{asset('assets/icon/home.png')}}" alt="">
                                    @else
                                        <img src="{{asset('assets/icon/home1.png')}}" alt="">
                                    @endif
                                    <p class=""> الرئيسية </p>
                                </a>
                            </li>

                            <li class="nav-item rounded">
                                <a href="" class="nav-link {{Route::is('orphan.*')?'li-active':''}}" >

                                    @if(Route::is('orphan.*'))
                                        <img src="{{asset('assets/icon/user1.png')}}" alt="">
                                    @else
                                        <img src="{{asset('assets/icon/user.png')}}" alt="">
                                    @endif
                                    <p class="{{Route::is('orphan.*')?'link-active':'text-white'}} ">
                                        الأيتام
                                    </p>
                                    <i class="right fas fa-angle-left {{Route::is('orphan.*')?'link-active':'text-white'}}" style="transform:translateX(-170px);"></i>

                                </a>

                                <ul class="nav nav-treeview">

                                    <li class="nav-item rounded">
                                        <a href="{{route('orphan.create')}}" class=" ms-3 {{Route::is(['orphan.create' , 'orphan.group.create'])?'a-active':'nav-link'}} " >
                                            إضافة يتيم
                                        </a>
                                    </li>

                                    <li class="nav-item rounded">
                                        <a href="{{route('orphan.registerd')}}" class="ms-3 {{Route::is('orphan.registerd')?'a-active':'nav-link'}} ">
                                            تدقيق طلبات الإضافة
                                        </a>
                                    </li>

                                    <li class="nav-item rounded">
                                        <a href="{{route('orphan.certified')}}" class="ms-3 {{Route::is('orphan.certified')?'a-active':'nav-link'}} ">
                                             الأيتام المعتمدون
                                        </a>
                                    </li>

                                    <li class="nav-item rounded">
                                        <a href="{{route('orphan.waiting')}}" class="{{Route::is('orphan.waiting')?'a-active':'nav-link'}}  ms-3">
                                           الأيتام قيد الانتظار
                                        </a>
                                    </li>

                                    <li class="nav-item rounded">
                                        <a href="{{route('orphan.sponsored')}}" class="{{Route::is('orphan.sponsored')?'a-active':'nav-link'}}  ms-3">
                                            الأيتام المكفولون
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            <li class="nav-item  rounded ">
                                <a href="{{route('orphans.sponsorship.index')}}" class="nav-link d-flex justify-content-between gap-2 {{Route::is('orphans.sponsorship.index')?'li-active':''}}">

                                    <div class="{{Route::is('orphans.sponsorship.index')?'link-active':'text-white'}}">
                                        @if(Route::is('orphans.sponsorship.index'))
                                             <img src="{{asset('assets/icon/elements1.png')}}" alt="">
                                        @else
                                             <img src="{{asset('assets/icon/elements.png')}}" alt="">
                                        @endif
                                         <p>توزيع الكفالات</p>
                                    </div>

                                </a>
                            </li>

                            <li class="nav-item  rounded"> {{-- {{Route::is('admin.notification')?'li-active':''}} --}}
                                <a href="{{route('orphans.finance.index')}}" class="nav-link d-flex justify-content-between gap-2 {{Route::is('orphans.finance.index')?'li-active':''}}">

                                    <div class="{{Route::is('orphans.finance.index')?'link-active':'text-white'}}">
                                        @if(Route::is('orphans.finance.index'))
                                            <img src="{{asset('assets/icon/money.png')}}" alt="" width="24px" height="24px">
                                        @else
                                            <img src="{{asset('assets/icon/money1.png')}}" alt="">
                                        @endif
                                        {{-- <img src="{{asset('assets/icon/money1.png')}}" alt=""> --}}
                                         <p> المالية </p>
                                    </div>

                                </a>
                            </li>

                            <li class="nav-item  rounded"> {{-- {{Route::is('admin.notification')?'li-active':''}} --}}
                                <a href="{{route('orphans.financial.documents.index')}}" class="nav-link d-flex justify-content-between gap-2 {{Route::is('orphans.financial.documents.index')?'li-active':''}}">

                                    <div class="{{Route::is('orphans.financial.documents.index')?'link-active':'text-white'}}">
                                        @if(Route::is('orphans.financial.documents.index'))
                                            <img src="{{asset('assets/icon/money.png')}}" alt="" width="24px" height="24px">
                                        @else
                                            <img src="{{asset('assets/icon/money1.png')}}" alt="">
                                        @endif
                                        {{-- <img src="{{asset('assets/icon/money1.png')}}" alt=""> --}}
                                         <p> مستندات مالية </p>
                                    </div>

                                </a>
                            </li>

                            @can('is-admin')

                                <li class="nav-item  rounded"> {{-- {{Route::is('admin.notification')?'li-active':''}} --}}
                                    <a href="{{route('employee.index')}}" class="nav-link d-flex justify-content-between gap-2 {{Route::is('employee.*')?'li-active':''}}">

                                        <div class="{{Route::is('employee.*')?'link-active':'text-white'}}">
                                            @if(Route::is('employee.*'))
                                                <img src="{{asset('assets/icon/user1.png')}}" alt="">
                                            @else
                                                <img src="{{asset('assets/icon/user.png')}}" alt="">
                                            @endif

                                            <p> الموظفين </p>
                                        </div>

                                    </a>
                                </li>

                            @endcan


                            <li class="nav-item  rounded"> {{-- {{Route::is('admin.notification')?'li-active':''}} --}}
                                <a href="{{route('notification')}}" class="nav-link d-flex justify-content-between gap-2 {{Route::is('notification')?'li-active':''}}">

                                    <div class="{{Route::is('notification')?'link-active':'text-white'}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 640 640">
                                            @if (Route::is('notification'))
                                                <path  fill="#018f91"  d="M320 64C306.7 64 296 74.7 296 88L296 97.7C214.6 109.3 152 179.4 152 264L152 278.5C152 316.2 142 353.2 123 385.8L101.1 423.2C97.8 429 96 435.5 96 442.2C96 463.1 112.9 480 133.8 480L506.2 480C527.1 480 544 463.1 544 442.2C544 435.5 542.2 428.9 538.9 423.2L517 385.7C498 353.1 488 316.1 488 278.4L488 263.9C488 179.3 425.4 109.2 344 97.6L344 87.9C344 74.6 333.3 63.9 320 63.9zM488.4 432L151.5 432L164.4 409.9C187.7 370 200 324.6 200 278.5L200 264C200 197.7 253.7 144 320 144C386.3 144 440 197.7 440 264L440 278.5C440 324.7 452.3 370 475.5 409.9L488.4 432zM252.1 528C262 556 288.7 576 320 576C351.3 576 378 556 387.9 528L252.1 528z"/>
                                            @else
                                                <path  fill="#ffffff"  d="M320 64C306.7 64 296 74.7 296 88L296 97.7C214.6 109.3 152 179.4 152 264L152 278.5C152 316.2 142 353.2 123 385.8L101.1 423.2C97.8 429 96 435.5 96 442.2C96 463.1 112.9 480 133.8 480L506.2 480C527.1 480 544 463.1 544 442.2C544 435.5 542.2 428.9 538.9 423.2L517 385.7C498 353.1 488 316.1 488 278.4L488 263.9C488 179.3 425.4 109.2 344 97.6L344 87.9C344 74.6 333.3 63.9 320 63.9zM488.4 432L151.5 432L164.4 409.9C187.7 370 200 324.6 200 278.5L200 264C200 197.7 253.7 144 320 144C386.3 144 440 197.7 440 264L440 278.5C440 324.7 452.3 370 475.5 409.9L488.4 432zM252.1 528C262 556 288.7 576 320 576C351.3 576 378 556 387.9 528L252.1 528z"/>
                                            @endif

                                        </svg>
                                         <p> الإشعارات </p>
                                    </div>

                                    @if($unreadCountNotification > 0)
                                        <span class="badge" style="background-color: #d5fbe3; color:var(--primary-color)"> {{$unreadCountNotification}} </span>
                                    @endif

                                </a>
                            </li>


                        {{-- @endauth --}}

                        @auth
                            <li class="nav-item  rounded" style="border:1px solid #fdebf0; @can('is-admin') margin-top:45px @else margin-top:160px @endcan ">

                                <form action="{{route('logout')}}" method="post">
                                    @csrf

                                    <button type="submit" class="nav-link d-flex justify-content-between gap-2" style="background-color: #fdebf0;padding:5px 1px 5px 5px">
                                        <p class="text-danger"> تسجيل الخروج </p>
                                        <img src="{{asset('assets/icon/logout.png')}}" alt="" width="30px" height="30px">
                                    </button>

                                </form>

                            </li>
                        @endauth

                        @guest
                            <a href="{{route('login')}}" class="nav-link d-flex justify-content-between " style="background-color: #e6f9ed;margin-top:130px">
                                <p class="text-success"> تسجيل الدخول </p>
                                <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 640 640" style="transform: translateX(-10px);">
                                    <path fill="#198754" d="M409 337C418.4 327.6 418.4 312.4 409 303.1L265 159C258.1 152.1 247.8 150.1 238.8 153.8C229.8 157.5 224 166.3 224 176L224 256L112 256C85.5 256 64 277.5 64 304L64 336C64 362.5 85.5 384 112 384L224 384L224 464C224 473.7 229.8 482.5 238.8 486.2C247.8 489.9 258.1 487.9 265 481L409 337zM416 480C398.3 480 384 494.3 384 512C384 529.7 398.3 544 416 544L480 544C533 544 576 501 576 448L576 192C576 139 533 96 480 96L416 96C398.3 96 384 110.3 384 128C384 145.7 398.3 160 416 160L480 160C497.7 160 512 174.3 512 192L512 448C512 465.7 497.7 480 480 480L416 480z"/>
                                </svg>
                            </a>
                        @endguest


                    </ul>
                </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <div class="content-wrapper" style="min-height: 232px; background-color: #f8fafa">
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                    <div class="bg-white" style="margin-right:1px; margin-left:1px;border-radius:15px;border-top:none">

                        <main style="margin-right: 1rem;margin-left:1rem;padding-top:25px;padding-bottom:25px">
                            {{$slot}}
                        </main>
                    </div>

              </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>


        <!-- /.content-wrapper -->
        <footer class="main-footer text-center p-1" style="background-color:var(--third-color)">
            © 2025 مؤسسة سبيلي الخيرية. جميع الحقوق محفوظة.
        </footer>


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>
</html>
