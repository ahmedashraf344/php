@extends('dashboard.v1.layouts.app')
@section('style')
    {{-- File input--}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/fileinput/fileinput.css')}}">
    @if(App::getLocale() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/fileinput/fileinput-rtl.css')}}">
    @endif
@endsection
@section('breadcrumbs', Breadcrumbs::render('mobileHomeScreen'))
@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{$pageTitle}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form action="{{route('static.updateContent')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group {{has_error($errors,'mobile_home_image')}}">
                            <label class="form-control-label"
                                   for="mobile_home_image">{{__('mobile_home_image')}}</label>
                            <p class="show-page" id="mobile_home_image">
                                <a href="{{setting_value('mobile_home_image')}}"
                                   target="_blank">
                                    <img src="{{setting_value('mobile_home_image')}}"
                                         alt="{{__('mobile_home_image')}}" class="show-img">
                                </a>
                            </p>
                            <input id="mobile_home_image" name="mobile_home_image" type="file"
                                   class="file {{is_invalid($errors,'mobile_home_image')}}">
                            {{input_error($errors,'mobile_home_image')}}
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group {{has_error($errors,'mobile_mnask_image')}}">
                            <label class="form-control-label"
                                   for="mobile_mnask_image">{{__('mobile_mnask_image')}}</label>
                            <p class="show-page" id="mobile_home_image">
                                <a href="{{setting_value('mobile_mnask_image')}}"
                                   target="_blank">
                                    <img src="{{setting_value('mobile_mnask_image')}}"
                                         alt="{{__('mobile_mnask_image')}}" class="show-img">
                                </a>
                            </p>
                            <input id="mobile_mnask_image" name="mobile_mnask_image" type="file"
                                   class="file {{is_invalid($errors,'mobile_mnask_image')}}">
                            {{input_error($errors,'mobile_mnask_image')}}
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group {{has_error($errors,'mobile_fdl_image')}}">
                            <label class="form-control-label"
                                   for="mobile_fdl_image">{{__('mobile_fdl_image')}}</label>
                            <p class="show-page" id="mobile_home_image">
                                <a href="{{setting_value('mobile_fdl_image')}}"
                                   target="_blank">
                                    <img src="{{setting_value('mobile_fdl_image')}}"
                                         alt="{{__('mobile_fdl_image')}}" class="show-img">
                                </a>
                            </p>
                            <input id="mobile_fdl_image" name="mobile_fdl_image" type="file"
                                   class="file {{is_invalid($errors,'mobile_fdl_image')}}">
                            {{input_error($errors,'mobile_fdl_image')}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{__('update')}}</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    {{-- File input --}}
    <script type="text/javascript" src="{{asset('admin/vendor/fileinput/fileinput.js')}}"></script>

    <script>
        $(".file").fileinput({
            showUpload: false,
            dropZoneEnabled: false,
        });
    </script>
@endsection
