<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <meta name="caffeinated" content="false">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{--{{setting_value('name')}}--}}</title>
    <!-- Favicon -->
    <link href="{{--{{setting_value('fav_icon')}}--}}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{asset('admin/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="{{asset('admin/css/argon.css')}}" rel="stylesheet">
{{--    <link type="text/css" href="{{asset('admin/css/bootstrap-rtl.min.css')}}" rel="stylesheet">--}}
    <link type="text/css" href="{{asset('admin/vendor/select2/select2.css')}}" rel="stylesheet">
    <link type="text/css" href="{{asset('admin/css/print.min.css')}}" rel="stylesheet">
{{--    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('admin/vendor/sweet-alert/sweetalert2.min.css')}}"/>--}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{--    <link type="text/css" href="{{asset('admin/css/custom-rtl.css')}}" rel="stylesheet">--}}
    <link type="text/css" href="{{asset('admin/css/custom.css')}}" rel="stylesheet">

    @if(App::getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
        <style type="text/css">
            body{
                font-family: 'Cairo', sans-serif;
            }
        </style>
    @endif

    @yield('style')
</head>

<body>

@include('dashboard.v1.layouts.partials.sidebar')

<!-- Main content -->
<div class="main-content rtl">

    @include('dashboard.v1.layouts.partials.navbar')

    <div class="header bg-gradient-primary pb-6 pt-5 pt-md-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        @yield('breadcrumbs')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--7">

        @yield('content')

        @include('dashboard.v1.layouts.partials.footer')

    </div>
</div>

<!-- End Main content -->
<script src="{{asset('admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/vendor/select2/select2.js')}}"></script>
<script>
    // Select
    $(".select2").select2({
        placeholder: $(this).attr("title"),
    });

    $(".select2-tags").select2({
        placeholder: $(this).attr("title"),
        tags:true,
    });
</script>
@yield('script')

{{--  SweetAlert  --}}
{{--<script src="{{asset('admin/vendor/sweet-alert/sweetalert2.min.js')}}"></script>--}}
@include('sweet::alert')

<!-- Argon JS -->
<script src="{{asset('admin/js/argon.js')}}"></script>

<script src="{{asset('admin/js/custom.js')}}"></script>

</body>

</html>
