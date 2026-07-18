@extends('dashboard.v1.layouts.app')
@section('style')
    <!-- tinymce -->
    <script type="text/javascript" src="{{asset('admin/vendor/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: "textarea.tinymce",
            theme: "silver",
            width: '100%',
            height: 400,
            menubar: false,
            //toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
            plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount tinymcespellchecker a11ychecker imagetools textpattern help formatpainter permanentpen pageembed tinycomments mentions linkchecker',
            toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',
            image_advtab: true,
        });
    </script>

@endsection
@section('breadcrumbs', Breadcrumbs::render('mobileFdlScreen'))
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
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group {{has_error($errors,'fdl_screen_title')}}">
                            <label class="form-control-label" for="fdl_screen_title">{{__('fdl_screen_title')}}</label>
                            <input name="fdl_screen_title" required type="text" value="{{setting_value('fdl_screen_title')}}"
                                   class="form-control {{is_invalid($errors,'fdl_screen_title')}}"
                                   id="fdl_screen_title" placeholder="">
                            {{input_error($errors,'fdl_screen_title')}}
                            <span class='required'>*</span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group {{has_error($errors,'fdl_screen_content_title')}}">
                            <label class="form-control-label" for="fdl_screen_content_title">{{__('fdl_screen_content_title')}}</label>
                            <input name="fdl_screen_content_title" required type="text" value="{{setting_value('fdl_screen_content_title')}}"
                                   class="form-control {{is_invalid($errors,'fdl_screen_content_title')}}"
                                   id="fdl_screen_content_title" placeholder="">
                            {{input_error($errors,'fdl_screen_content_title')}}
                            <span class='required'>*</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group {{has_error($errors,'fdl_screen_content_body')}}">
                            <label class="form-control-label" for="fdl_screen_content_body">{{__('fdl_screen_content_body')}}</label>
                            <textarea name="fdl_screen_content_body" required type="text" rows="15"
                                      class="form-control {{is_invalid($errors,'fdl_screen_content_body')}} tinymce"
                                      id="fdl_screen_content_body" placeholder=""> {{setting_value('fdl_screen_content_body')}}</textarea>
                            {{input_error($errors,'fdl_screen_content_body')}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{__('update')}}</button>
            </form>
        </div>
    </div>
@endsection

