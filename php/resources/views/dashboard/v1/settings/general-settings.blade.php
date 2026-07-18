@extends('dashboard.v1.layouts.app')

@section('style')
    {{-- File input--}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/fileinput/fileinput.css')}}">
    @if(App::getLocale() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/fileinput/fileinput-rtl.css')}}">
    @endif
@endsection
@section('breadcrumbs', Breadcrumbs::render('manageSiteSettings'))
@section('content')
    <!-- Form groups used in grid -->
    <form action="{{route('static.updateContent')}}" method="post" enctype="multipart/form-data">
        @csrf

        <input hidden name="group_title" value="{{$groupTitle}}">

        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">{{$pageTitle}}</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'name')}}">
                            <label class="form-control-label"
                                   for="name">{{__('site_name')}}</label>
                            <input name="name"  type="text" value="{{old('name') ?: setting_value('name')}}"
                                   class="form-control {{is_invalid($errors,'name')}}"
                                   id="name" placeholder="">
                            {{input_error($errors,'name')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <div class="form-group {{has_error($errors,'copyrights')}}">
                            <label class="form-control-label"
                                   for="copyrights">{{__('copyrights')}}</label>
                            <input name="copyrights"  type="text"
                                   value="{{old('copyrights') ?: setting_value('copyrights')}}"
                                   class="form-control {{is_invalid($errors,'copyrights')}}"
                                   id="copyrights" placeholder="">
                            {{input_error($errors,'copyrights')}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'meta_description')}}">
                            <label class="form-control-label"
                                   for="meta_description">{{__('meta_description')}}</label>
                            <textarea name="meta_description"  type="text"
                                      class="form-control {{is_invalid($errors,'meta_description')}}"
                                      id="meta_description" placeholder=""
                                      rows="7">{{old('meta_description') ?: setting_value('meta_description')}}</textarea>
                            {{input_error($errors,'meta_description')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <div class="form-group {{has_error($errors,'meta_keywords')}}">
                            <label class="form-control-label"
                                   for="meta_keywords">{{__('meta_keywords')}}</label>
                            <textarea name="meta_keywords"  type="text"
                                      class="form-control {{is_invalid($errors,'meta_keywords')}}"
                                      id="meta_keywords" placeholder=""
                                      rows="7">{{old('meta_keywords') ?: setting_value('meta_keywords')}}</textarea>
                            {{input_error($errors,'meta_keywords')}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'logo')}}">
                            <label class="form-control-label"
                                   for="logo">{{__('logo')}}</label>
                            <p class="show-page" id="logo">
                                <a href="{{setting_value('logo')}}"
                                   target="_blank">
                                    <img src="{{setting_value('logo')}}"
                                         alt="{{__('logo')}}" class="show-img">
                                </a>
                            </p>
                            <input id="logo" name="logo" type="file"
                                   class="file {{is_invalid($errors,'logo')}}">
                            {{input_error($errors,'logo')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'logo_text_image')}}">
                            <label class="form-control-label"
                                   for="logo_text_image">{{__('logo_text_image')}}</label>
                            <p class="show-page" id="logo_text_image">
                                <a href="{{setting_value('logo_text_image')}}"
                                   target="_blank">
                                    <img src="{{setting_value('logo_text_image')}}"
                                         alt="{{__('logo_text_image')}}" class="show-img">
                                </a>
                            </p>
                            <input id="logo_text_image" name="logo_text_image" type="file"
                                   class="file {{is_invalid($errors,'logo_text_image')}}">
                            {{input_error($errors,'logo_text_image')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'fav_icon')}}">
                            <label class="form-control-label"
                                   for="fav_icon">{{__('fav_icon')}}</label>
                            <p class="show-page" id="fav_icon">
                                <a href="{{setting_value('fav_icon')}}"
                                   target="_blank">
                                    <img src="{{setting_value('fav_icon')}}"
                                         alt="{{__('fav_icon')}}" class="show-img">
                                </a>
                            </p>
                            <input id="fav_icon" name="fav_icon" type="file"
                                   class="file {{is_invalid($errors,'fav_icon')}}">
                            {{input_error($errors,'fav_icon')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">{{__('contact_info')}}</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'email')}}">
                            <label class="form-control-label"
                                   for="email">{{__('email')}}</label>
                            <input name="email"  type="email" value="{{old('email') ?: setting_value('email')}}"
                                   class="form-control {{is_invalid($errors,'email')}}"
                                   id="email" placeholder="">
                            {{input_error($errors,'email')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'phone')}}">
                            <label class="form-control-label"
                                   for="phone">{{__('phone')}}</label>
                            <input name="phone"  type="text" value="{{old('phone') ?: setting_value('phone')}}"
                                   class="form-control {{is_invalid($errors,'phone')}}"
                                   id="phone" placeholder="">
                            {{input_error($errors,'phone')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'mobile')}}">
                            <label class="form-control-label"
                                   for="mobile">{{__('mobile')}}</label>
                            <input name="mobile"  type="text" value="{{old('mobile') ?: setting_value('mobile')}}"
                                   class="form-control {{is_invalid($errors,'mobile')}}"
                                   id="mobile" placeholder="">
                            {{input_error($errors,'mobile')}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'twitter')}}">
                            <label class="form-control-label"
                                   for="twitter">{{__('twitter')}}</label>
                            <input name="twitter"  type="text" value="{{old('twitter') ?: setting_value('twitter')}}"
                                   class="form-control {{is_invalid($errors,'twitter')}}"
                                   id="twitter" placeholder="">
                            {{input_error($errors,'twitter')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'youtube')}}">
                            <label class="form-control-label"
                                   for="youtube">{{__('youtube')}}</label>
                            <input name="youtube"  type="text" value="{{old('youtube') ?: setting_value('youtube')}}"
                                   class="form-control {{is_invalid($errors,'youtube')}}"
                                   id="youtube" placeholder="">
                            {{input_error($errors,'youtube')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'instagram')}}">
                            <label class="form-control-label"
                                   for="instagram">{{__('instagram')}}</label>
                            <input name="instagram"  type="text" value="{{old('instagram') ?: setting_value('instagram')}}"
                                   class="form-control {{is_invalid($errors,'instagram')}}"
                                   id="instagram" placeholder="">
                            {{input_error($errors,'instagram')}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group {{has_error($errors,'address')}}">
                            <label class="form-control-label"
                                   for="address">{{__('address')}}</label>
                            <textarea name="address"  type="text"
                                   class="form-control {{is_invalid($errors,'address')}}"
                                      id="address" placeholder="" rows="3">{{old('address') ?: setting_value('address')}}</textarea>
                            {{input_error($errors,'address')}}
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group {{has_error($errors,'latitude')}}">
                            <label class="form-control-label"
                                   for="latitude">{{__('latitude')}}</label>
                            <input name="latitude"  type="text" value="{{old('latitude') ?: setting_value('latitude')}}"
                                   class="form-control {{is_invalid($errors,'latitude')}}"
                                   id="latitude" placeholder="">
                            {{input_error($errors,'latitude')}}
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group {{has_error($errors,'longitude')}}">
                            <label class="form-control-label"
                                   for="longitude">{{__('longitude')}}</label>
                            <input name="longitude"  type="text" value="{{old('longitude') ?: setting_value('longitude')}}"
                                   class="form-control {{is_invalid($errors,'longitude')}}"
                                   id="longitude" placeholder="">
                            {{input_error($errors,'longitude')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">{{__('footer_info')}}</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'footer_about_title')}}">
                            <label class="form-control-label"
                                   for="footer_about_title">{{__('footer_about_title')}}</label>
                            <input name="footer_about_title"  type="text" value="{{old('footer_about_title') ?: setting_value('footer_about_title')}}"
                                   class="form-control {{is_invalid($errors,'footer_about_title')}}"
                                   id="footer_about_title" placeholder="">
                            {{input_error($errors,'footer_about_title')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <div class="form-group {{has_error($errors,'footer_about_content')}}">
                            <label class="form-control-label"
                                   for="footer_about_content">{{__('footer_about_content')}}</label>
                            <textarea name="footer_about_content"  type="text"
                                   class="form-control {{is_invalid($errors,'footer_about_content')}}"
                                      id="footer_about_content" placeholder="" rows="3">{{old('footer_about_content') ?: setting_value('footer_about_content')}}</textarea>
                            {{input_error($errors,'footer_about_content')}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'footer_contact_info_title')}}">
                            <label class="form-control-label"
                                   for="footer_contact_info_title">{{__('footer_contact_info_title')}}</label>
                            <input name="footer_contact_info_title"  type="text" value="{{old('footer_contact_info_title') ?: setting_value('footer_contact_info_title')}}"
                                   class="form-control {{is_invalid($errors,'footer_contact_info_title')}}"
                                   id="footer_contact_info_title" placeholder="">
                            {{input_error($errors,'footer_contact_info_title')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'footer_contact_form_title')}}">
                            <label class="form-control-label"
                                   for="footer_contact_form_title">{{__('footer_contact_form_title')}}</label>
                            <input name="footer_contact_form_title"  type="text" value="{{old('footer_contact_form_title') ?: setting_value('footer_contact_form_title')}}"
                                   class="form-control {{is_invalid($errors,'footer_contact_form_title')}}"
                                   id="footer_contact_form_title" placeholder="">
                            {{input_error($errors,'footer_contact_form_title')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'footer_contact_form_button')}}">
                            <label class="form-control-label"
                                   for="footer_contact_form_button">{{__('footer_contact_form_button')}}</label>
                            <input name="footer_contact_form_button"  type="text" value="{{old('footer_contact_form_button') ?: setting_value('footer_contact_form_button')}}"
                                   class="form-control {{is_invalid($errors,'footer_contact_form_button')}}"
                                   id="footer_contact_form_button" placeholder="">
                            {{input_error($errors,'footer_contact_form_button')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{__('update')}}</button>
    </form>
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
