@extends('dashboard.v1.layouts.app')

@include('dashboard.v1.layouts.partials.plugins.tinymce')

@section('breadcrumbs', Breadcrumbs::render('v1AboutUsPage',$groupTitle))

@section('content')

    <!-- Form groups used in grid -->
    <form action="{{route('dashboard.v1.settings.update',$groupTitle)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input hidden name="group_title" value="{{$groupTitle}}">

        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">{{__('About us page settings')}}</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group {{has_error($errors,'about_title_ar')}}">
                            <label class="form-control-label" for="about_title_ar">{{__('Title in arabic')}}</label>
                            <input name="about_title_ar" type="text"
                                   value="{{old('about_title_ar')?: setting_value('about_title_ar')}}"
                                   class="form-control {{is_invalid($errors,'about_title_ar')}}"
                                   id="about_title_ar" placeholder="" autocomplete="off">
                            {{input_error($errors,'about_title_ar')}}
                            <span class='required'>*</span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group {{has_error($errors,'about_title_en')}}">
                            <label class="form-control-label" for="about_title_en">{{__('Title in english')}}</label>
                            <input name="about_title_en" type="text"
                                   value="{{old('about_title_en')?:setting_value('about_title_en')}}"
                                   class="form-control {{is_invalid($errors,'about_title_en')}}"
                                   id="about_title_en" placeholder="" autocomplete="off">
                            {{input_error($errors,'about_title_en')}}
                            {{--            <span class='required'>*</span>--}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group {{has_error($errors,'about_content_ar')}}">
                            <label class="form-control-label"
                                   for="about_content_ar">{{__('Content in arabic')}}</label>
                            <textarea name="about_content_ar" type="text"
                                      class="form-control {{is_invalid($errors,'about_content_ar')}} tinymce"
                                      id="about_content_ar" placeholder=""
                                      rows="3">{{old('about_content_ar') ?: setting_value('about_content_ar')}}</textarea>
                            {{input_error($errors,'about_content_ar')}}
                            {{--<span class='required'>*</span>--}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group {{has_error($errors,'about_content_en')}}">
                            <label class="form-control-label"
                                   for="about_content_en">{{__('Content in english')}}</label>
                            <textarea name="about_content_en" type="text"
                                      class="form-control {{is_invalid($errors,'about_content_en')}} tinymce"
                                      id="about_content_en" placeholder=""
                                      rows="3">{{old('about_content_en') ?: setting_value('about_content_en')}}</textarea>
                            {{input_error($errors,'about_content_en')}}
                            {{--<span class='required'>*</span>--}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{__('save changes')}}</button>
            </div>
        </div>
    </form>
@endsection
