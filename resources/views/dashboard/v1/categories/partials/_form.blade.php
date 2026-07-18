@include('dashboard.v1.layouts.partials.plugins.fileinput')

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'name_ar')}}">
            <label class="form-control-label" for="name_ar">{{__('Name in arabic')}}</label>
            <input name="name_ar" type="text"
                   value="{{old('name_ar')}}@isset($category){{isset_property($category,'name_ar')}}@endisset"
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
                   value="{{old('name_en')}}@isset($category){{isset_property($category,'name_en')}}@endisset"
                   class="form-control {{is_invalid($errors,'name_en')}}"
                   id="name_en" placeholder="" autocomplete="off">
            {{input_error($errors,'name_en')}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'category_id')}}">
            <label class="form-control-label" for="category_id">{{__('Parent category')}}</label>
            <select id="category_id" class="form-control {{is_invalid($errors,'category_id')}} select2"
                    name="category_id">
                <option></option>
                @foreach ($categoryList as $key=>$selectCategory)
                    <option value="{{$key}}"
                        {{select_input_val($key,old('category_id'),isset($category)?isset_property($category,'category_id'):null)}}>
                        {{$selectCategory}}
                    </option>
                @endforeach
            </select>
            {{--<span class='required'>*</span>--}}
            {{input_error($errors,'category_id')}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'feature_image')}}">
            <label class="form-control-label"
                   for="feature_image">{{__('Feature image')}}</label>
            @if(!is_create() && (isset_property($category,'feature_image') != null))
                <p class="show-page" id="feature_image">
                    <a href="{{asset($category['feature_image'])}}"
                       target="_blank">
                        <img src="{{asset($category['feature_image'])}}"
                             alt="{{__('Feature image')}}" class="show-img">
                    </a>
                </p>
            @endif
            <input id="feature_image" name="feature_image" type="file"
                   class="file {{is_invalid($errors,'feature_image')}}">
            {{input_error($errors,'feature_image')}}
            <span class='required'>*</span>
        </div>
    </div>
</div>
