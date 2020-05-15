<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" href="{{config('app.url')}}assets/images/Favicon-KLY.png">
  <title>
    @if(View::hasSection('title'))
        @yield('title')
    @else
    {{ str_replace('_',' ', env('APP_NAME','SOSMED TOOL')) }}
    @endif
</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Datta Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, datta able, datta able bootstrap admin template">
    <meta name="author" content="Codedthemes" />

    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{config('app.url')}}assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="{{config('app.url')}}assets/plugins/animation/css/animate.min.css">
    <!-- prism css -->
    <link rel="stylesheet" href="{{config('app.url')}}assets/plugins/prism/css/prism.min.css">
    <!-- vendor css -->  
    <link id="realcss"  rel="stylesheet" href="{{config('app.url')}}assets/css/style.css">
    <link href="{{config('app.url')}}assets/plugins/material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="{{config('app.url')}}assets/fonts/material/css/materialdesignicons.min.css" rel="stylesheet">
    {{-- <link href="{{config('app.url')}}assets/plugins/bootstrap-datetimepicker/css/prettify.css" rel="stylesheet">
    <link href="{{config('app.url')}}assets/plugins/bootstrap-datetimepicker/css/docs.css" rel="stylesheet"> --}}
    <link href="{{config('app.url')}}assets/plugins/bootstrap-datetimepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="{{config('app.url')}}assets/plugins/select2/css/select2.min.css" rel="stylesheet">
    <link href="{{config('app.url')}}assets/plugins/ekko-lightbox/css/ekko-lightbox.min.css" rel="stylesheet">
     <link href="{{config('app.url')}}assets/plugins/lightbox2-master/css/lightbox.min.css" rel="stylesheet">
     <link href="{{config('app.url')}}assets/css/jquery.timepicker.min.css" rel="stylesheet">
     <link href="{{config('app.url')}}assets/plugins/ekko-lightbox/css/ekko-lightbox.min.css" rel="stylesheet">
    <link href="{{config('app.url')}}assets/plugins/lightbox2-master/css/lightbox.min.css" rel="stylesheet">
     
    @if (request()->cookie('theme')=="dark")
    <link id="darkcss" rel="stylesheet" href="{{config('app.url')}}assets/css/layouts/dark.css">
    @endif
    <style>
        .select2-selection--single{
            height: calc(2.55rem + 2px) !important;
            border: 1px solid #212224;
            color: currentColor !important;
            background-color: transparent !important;
        }
        .ekko-lightbox-item .img-fluid{
            height: 200px !important;
            width: 200px !important;
        }
        .modal-dialog{
            flex: none !important;
            max-width: none !important;
            width: 400px !important;
            text-align: center !important;
        }
        .modal-body{
            margin-bottom: 150px !important;
        }
        .ekko-lightbox-container{
            height: auto !important;
            margin-bottom: 5% !important;
        }
    </style>
</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    @include('layouts.admin.sidebar')
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    @include('layouts.admin.navbar')
    <!-- [ chat message ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->
                    <div class="page-header">
                                <div class="page-block">
                                @yield("content-header")       
                            </div>
                    </div>

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            @yield("content")
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Required Js -->
    @include('layouts.admin.footer')
    @stack('script')

</body>
</html>
