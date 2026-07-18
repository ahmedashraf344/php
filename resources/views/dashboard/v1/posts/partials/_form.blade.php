@include('dashboard.v1.layouts.partials.plugins.fileinput')

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'name_ar')}}">
            <label class="form-control-label" for="name_ar">{{__('Name in arabic')}}</label>
            <input name="name_ar" type="text"
                   value="{{old('name_ar')}}@isset($post){{isset_property($post,'name_ar')}}@endisset"
                   class="form-control {{is_invalid($errors,'name_ar')}}"
                   id="name_ar" placeholder="" autocomplete="off">
            {{input_error($errors,'name_ar')}}
            <span class='required'>*</span>
        </div>
    </div>

    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'name_en')}}">
            <label class="form-control-label" for="name_en">{{__('Name in english')}}</label>
            <input name="name_en" type="text"
                   value="{{old('name_en')}}@isset($post){{isset_property($post,'name_en')}}@endisset"
                   class="form-control {{is_invalid($errors,'name_en')}}"
                   id="name_en" placeholder="" autocomplete="off">
            {{input_error($errors,'name_en')}}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'content_ar')}}">
            <label class="form-control-label" for="content_ar">{{__('Content in arabic')}}</label>
            <textarea name="content_ar" class="form-control {{is_invalid($errors,'content_ar')}}"
                      id="content_ar" rows="7" cols="30">
                {{old('content_ar')}}@isset($post){{isset_property($post,'content_ar')}}@endisset
            </textarea>
            {{input_error($errors,'content_ar')}}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'content_en')}}">
            <label class="form-control-label" for="content_en">{{__('Content in english')}}</label>
            <textarea name="content_en" class="form-control {{is_invalid($errors,'content_en')}}"
                      id="content_en" rows="7" cols="30">
                {{old('content_en')}}@isset($post){{isset_property($post,'content_en')}}@endisset
            </textarea>
            {{input_error($errors,'content_en')}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'image')}}">
            <label class="form-control-label"
                   for="image">{{__('Image')}}</label>
            @if(!is_create() && (isset_property($post,'image') != null))
                <p class="show-page" id="image">
                    <a href="{{asset($post['image'])}}"
                       target="_blank">
                        <img src="{{asset($post['image'])}}"
                             alt="{{__('Feature image')}}" class="show-img">
                    </a>
                </p>
            @endif
            @if(!is_show())
                <input id="image" name="image" type="file"
                       class="file {{is_invalid($errors,'image')}}">
                {{input_error($errors,'image')}}
                {{--<span class='required'>*</span>--}}
            @endif
        </div>
    </div>

    @if(!is_create())
        <div class="col-sm-6 col-md-6">
            <div class="form-group {{has_error($errors,'status')}}">
                <label class="form-control-label" for="status">{{__('Status')}}</label>
                <select id="status" class="form-control {{is_invalid($errors,'status')}} select2"
                        name="status">
                    @foreach (\App\Models\Post::selectStatusList() as $key=>$selectStatus)
                        <option value="{{$key}}"
                            {{select_input_val($key,old('status'),isset($post)?isset_property($post,'status'):null)}}>
                            {{$selectStatus}}
                        </option>
                    @endforeach
                </select>
                {{--<span class='required'>*</span>--}}
                {{input_error($errors,'status')}}
            </div>
        </div>
    @endif
</div>
