@include('dashboard.v1.layouts.partials.plugins.fileinput')

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'name_ar')}}">
            <label class="form-control-label" for="name_ar">{{__('Name in arabic')}}</label>
            <input name="name_ar" type="text"
                   value="{{old('name_ar')}}@isset($announcement){{isset_property($announcement,'name_ar')}}@endisset"
                   class="form-control {{is_invalid($errors,'name_ar')}}"
                   id="name_ar" placeholder="" autocomplete="off">
            {{input_error($errors,'name_ar')}}
            <span class='required'>*</span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'name_en')}}">
            <label class="form-control-label" for="name_en">{{__('Name in english')}}</label>
            <input name="name_en" type="text"
                   value="{{old('name_en')}}@isset($announcement){{isset_property($announcement,'name_en')}}@endisset"
                   class="form-control {{is_invalid($errors,'name_en')}}"
                   id="name_en" placeholder="" autocomplete="off">
            {{input_error($errors,'name_en')}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'type')}}">
            <label class="form-control-label" for="type">{{__('Type')}}</label>
            <select id="type" class="form-control {{is_invalid($errors,'type')}} select2"
                    name="type">
                @foreach (\App\Models\Announcement::selectTypesList() as $key=>$selectType)
                    <option value="{{$key}}"
                        {{select_input_val($key,old('type'),isset($announcement)?isset_property($announcement,'type'):null)}}>
                        {{$selectType}}
                    </option>
                @endforeach
            </select>
            {{--<span class='required'>*</span>--}}
            {{input_error($errors,'type')}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'description_ar')}}">
            <label class="form-control-label" for="description_ar">{{__('Description in arabic')}}</label>
            <textarea name="description_ar" class="form-control tinymce {{is_invalid($errors,'description_ar')}}"
                      id="description_ar" rows="4" cols="30">{{old('description_ar')}}@isset($announcement){{isset_property($announcement,'description_ar')}}@endisset</textarea>
            {{input_error($errors,'description_ar')}}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'description_en')}}">
            <label class="form-control-label" for="description_en">{{__('Description in english')}}</label>
            <textarea name="description_en" class="form-control tinymce {{is_invalid($errors,'description_en')}}"
                      id="description_en" rows="4" cols="30">{{old('description_en')}}@isset($announcement){{isset_property($announcement,'description_en')}}@endisset</textarea>
            {{input_error($errors,'description_en')}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'feature_image')}}">
            <label class="form-control-label"
                   for="feature_image">{{__('Feature image')}}</label>
            @if(!is_create() && (isset_property($announcement,'feature_image') != null))
                <p class="show-page" id="feature_image">
                    <a href="{{asset($announcement['feature_image'])}}"
                       target="_blank">
                        <img src="{{asset($announcement['feature_image'])}}"
                             alt="{{__('Feature image')}}" class="show-img">
                    </a>
                </p>
            @endif
            @if(!is_show())
                <input id="feature_image" name="feature_image" type="file"
                       class="file {{is_invalid($errors,'feature_image')}}">
                {{input_error($errors,'feature_image')}}
            @endif
            <span class='required'>*</span>
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'enable_at')}}">
            <label class="form-control-label" for="enable_at">{{__('Enable at')}}</label>
            <input name="enable_at" type="date"
                   value="{{old('enable_at')}}@isset($announcement){{isset_property($announcement,'enable_at')}}@endisset"
                   class="form-control {{is_invalid($errors,'enable_at')}}"
                   id="enable_at" placeholder="" autocomplete="off">
            {{input_error($errors,'enable_at')}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'disable_at')}}">
            <label class="form-control-label" for="disable_at">{{__('Disable at')}}</label>
            <input name="disable_at" type="date"
                   value="{{old('disable_at')}}@isset($announcement){{isset_property($announcement,'disable_at')}}@endisset"
                   class="form-control {{is_invalid($errors,'disable_at')}}"
                   id="disable_at" placeholder="" autocomplete="off">
            {{input_error($errors,'disable_at')}}
        </div>
    </div>
</div>
