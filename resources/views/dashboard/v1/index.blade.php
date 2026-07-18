@extends('dashboard.v1.layouts.app')

@section('breadcrumbs', Breadcrumbs::render('v1Dashboard'))

@section('content')
    <div class="row">
        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1"> {{__('v1.0')}} </h6>
                            <h2 class="mb-0">Rate zone</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <img style="width: 100%;" src="{{--{{setting_value('logo')}}--}}" class="navbar-brand-img" alt="{{--{{setting_value('name')}}--}}">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Optional JS -->
    <script src="{{asset('admin/vendor/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('admin/vendor/chart.js/dist/Chart.extension.js')}}"></script>
@endsection
