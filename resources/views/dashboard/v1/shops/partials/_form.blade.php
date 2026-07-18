@include('dashboard.v1.layouts.partials.plugins.fileinput')

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'name_ar')}}">
            <label class="form-control-label" for="name_ar">{{__('Name in arabic')}}</label>
            <input name="name_ar" type="text"
                   value="{{old('name_ar')}}@isset($shop){{isset_property($shop,'name_ar')}}@endisset"
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
                   value="{{old('name_en')}}@isset($shop){{isset_property($shop,'name_en')}}@endisset"
                   class="form-control {{is_invalid($errors,'name_en')}}"
                   id="name_en" placeholder="" autocomplete="off">
            {{input_error($errors,'name_en')}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'category_id')}}">
            <label class="form-control-label" for="category_id">{{__('category')}}</label>
            <select id="category_id" class="form-control {{is_invalid($errors,'category_id')}} select2"
                    name="category_id">
                <option>{{__('select category')}}</option>
                @foreach ($categoryList as $key=>$selectCategory)
                    <option value="{{$key}}"
                        {{select_input_val($key,old('category_id'),isset($shop)?isset_property($shop,'category_id'):null)}}>
                        {{$selectCategory}}
                    </option>
                @endforeach
            </select>
            <span class='required'>*</span>
            {{input_error($errors,'category_id')}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'address_ar')}}">
            <label class="form-control-label" for="address_ar">{{__('Address in arabic')}}</label>
            <input name="address_ar" type="text"
                   value="{{old('address_ar')}}@isset($shop){{isset_property($shop,'address_ar')}}@endisset"
                   class="form-control {{is_invalid($errors,'address_ar')}}"
                   id="address_ar" placeholder="" autocomplete="off">
            {{input_error($errors,'address_ar')}}
            <span class='required'>*</span>
        </div>
    </div>

    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'address_en')}}">
            <label class="form-control-label" for="address_en">{{__('Address in english')}}</label>
            <input name="address_en" type="text"
                   value="{{old('address_en')}}@isset($shop){{isset_property($shop,'address_en')}}@endisset"
                   class="form-control {{is_invalid($errors,'address_en')}}"
                   id="address_en" placeholder="" autocomplete="off">
            {{input_error($errors,'address_en')}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'mobile_1')}}">
            <label class="form-control-label" for="mobile_1">{{__('Mobile 1')}}</label>
            <input name="mobile_1" type="text"
                   value="{{old('mobile_1')}}@isset($shop){{isset_property($shop,'mobile_1')}}@endisset"
                   class="form-control {{is_invalid($errors,'mobile_1')}}"
                   id="mobile_1" placeholder="" autocomplete="off">
            {{input_error($errors,'mobile_1')}}
            {{--<span class='required'>*</span>--}}
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'mobile_2')}}">
            <label class="form-control-label" for="mobile_2">{{__('Mobile 2')}}</label>
            <input name="mobile_2" type="text"
                   value="{{old('mobile_2')}}@isset($shop){{isset_property($shop,'mobile_2')}}@endisset"
                   class="form-control {{is_invalid($errors,'mobile_2')}}"
                   id="mobile_2" placeholder="" autocomplete="off">
            {{input_error($errors,'mobile_2')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'phone_1')}}">
            <label class="form-control-label" for="phone_1">{{__('Phone 1')}}</label>
            <input name="phone_1" type="text"
                   value="{{old('phone_1')}}@isset($shop){{isset_property($shop,'phone_1')}}@endisset"
                   class="form-control {{is_invalid($errors,'phone_1')}}"
                   id="phone_1" placeholder="" autocomplete="off">
            {{input_error($errors,'phone_1')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'phone_2')}}">
            <label class="form-control-label" for="phone_2">{{__('Phone 2')}}</label>
            <input name="phone_2" type="text"
                   value="{{old('phone_2')}}@isset($shop){{isset_property($shop,'phone_2')}}@endisset"
                   class="form-control {{is_invalid($errors,'phone_2')}}"
                   id="phone_2" placeholder="" autocomplete="off">
            {{input_error($errors,'phone_2')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'hotline')}}">
            <label class="form-control-label" for="hotline">{{__('Hotline')}}</label>
            <input name="hotline" type="text"
                   value="{{old('hotline')}}@isset($shop){{isset_property($shop,'hotline')}}@endisset"
                   class="form-control {{is_invalid($errors,'hotline')}}"
                   id="hotline" placeholder="" autocomplete="off">
            {{input_error($errors,'hotline')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'latitude')}}">
            <label class="form-control-label" for="latitude">{{__('Latitude')}}</label>
            <input name="latitude" type="text"
                   value="{{old('latitude')}}@isset($shop){{isset_property($shop,'latitude')}}@endisset"
                   class="form-control {{is_invalid($errors,'latitude')}}"
                   id="latitude" placeholder="" autocomplete="off">
            {{input_error($errors,'latitude')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'longitude')}}">
            <label class="form-control-label" for="longitude">{{__('Longitude')}}</label>
            <input name="longitude" type="text"
                   value="{{old('longitude')}}@isset($shop){{isset_property($shop,'longitude')}}@endisset"
                   class="form-control {{is_invalid($errors,'longitude')}}"
                   id="longitude" placeholder="" autocomplete="off">
            {{input_error($errors,'longitude')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>
    @if(!is_create())
        <div class="col-sm-6 col-md-3">
            <div class="form-group {{has_error($errors,'status')}}">
                <label class="form-control-label" for="status">{{__('Status')}}</label>
                <select id="status" class="form-control {{is_invalid($errors,'status')}} select2"
                        name="status">
                    @foreach (\App\Models\Shop::selectStatusList() as $key=>$statusText)
                        <option value="{{$key}}"
                            {{select_input_val($key,old('status'),isset($shop)?isset_property($shop,'status'):null)}}>
                            {{$statusText}}
                        </option>
                    @endforeach
                </select>
                <span class='required'>*</span>
                {{input_error($errors,'status')}}
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label class="form-control-label" for="status_reason">{{__('Status Reason')}}</label>
                <textarea name="status_reason" class="form-control">{{old('status_reason')}}@isset($shop){{isset_property($shop,'status_reason')}}@endisset</textarea>
            </div>
        </div>

    @endif
</div>

<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'working_days_ar')}}">
            <label class="form-control-label" for="working_days_ar">{{__('working days in arabic')}}</label>
            <input name="working_days_ar" type="text"
                   value="{{old('working_days_ar')}}@isset($shop){{isset_property($shop,'working_days_ar')}}@endisset"
                   class="form-control {{is_invalid($errors,'working_days_ar')}}"
                   id="working_days_ar" placeholder="" autocomplete="off">
            {{input_error($errors,'working_days_ar')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'working_days_en')}}">
            <label class="form-control-label" for="working_days_en">{{__('working days in english')}}</label>
            <input name="working_days_en" type="text"
                   value="{{old('working_days_en')}}@isset($shop){{isset_property($shop,'working_days_en')}}@endisset"
                   class="form-control {{is_invalid($errors,'working_days_en')}}"
                   id="working_days_en" placeholder="" autocomplete="off">
            {{input_error($errors,'working_days_en')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'start_at')}}">
            <label class="form-control-label" for="start_at">{{__('start working at')}}</label>
            <input name="start_at" type="time"
                   value="{{old('start_at')}}@isset($shop){{isset_property($shop,'start_at')}}@endisset"
                   class="form-control {{is_invalid($errors,'start_at')}}"
                   id="start_at" placeholder="" autocomplete="off">
            {{input_error($errors,'start_at')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'end_at')}}">
            <label class="form-control-label" for="end_at">{{__('end working at')}}</label>
            <input name="end_at" type="time"
                   value="{{old('end_at')}}@isset($shop){{isset_property($shop,'end_at')}}@endisset"
                   class="form-control {{is_invalid($errors,'end_at')}}"
                   id="end_at" placeholder="" autocomplete="off">
            {{input_error($errors,'end_at')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'facebook')}}">
            <label class="form-control-label" for="facebook">{{__('Facebook link')}}</label>
            <input name="facebook" type="text"
                   value="{{old('facebook')}}@isset($shop){{isset_property($shop,'facebook')}}@endisset"
                   class="form-control {{is_invalid($errors,'facebook')}}"
                   id="facebook" placeholder="" autocomplete="off">
            {{input_error($errors,'facebook')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>

    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'instagram')}}">
            <label class="form-control-label" for="instagram">{{__('Instagram link')}}</label>
            <input name="instagram" type="text"
                   value="{{old('instagram')}}@isset($shop){{isset_property($shop,'instagram')}}@endisset"
                   class="form-control {{is_invalid($errors,'instagram')}}"
                   id="instagram" placeholder="" autocomplete="off">
            {{input_error($errors,'instagram')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'feature_image')}}">
            <label class="form-control-label"
                   for="feature_image">{{__('Feature image')}}</label>
            @if(!is_create() && (isset_property($shop,'feature_image') != null))
                <p class="show-page" id="feature_image">
                    <a href="{{asset($shop['feature_image'])}}"
                       target="_blank">
                        <img src="{{asset($shop['feature_image'])}}"
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

    <div class="col-sm-6 col-md-8">
        <div class="form-group {{has_error($errors,'more_images')}}">
            <label class="form-control-label"
                   for="more_images">{{__('More images')}}</label>
            @if(!is_create() && ($shop->gallery->count() != 0))
                <div class="show-page row" id="more_images">
                    @foreach($shop->gallery as $moreImage)
                        <div class="col-3 mb-3">
                            <a href="{{asset($moreImage['file'])}}"
                               target="_blank">
                                <img src="{{asset($moreImage['file'])}}"
                                     alt="{{__('more image')}}" class="show-img mb-2 mr-2">
                            </a>
                            <div class="text-center">
                                @can('Delete filecenter')
                                    @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                                                'route' => route('dashboard.v1.files.destroy',$moreImage) ,
                                                'tooltip' => __('Delete image'),
                                                'renderType'=>'hard_reload'
                                                 ])
                                    @endcomponent
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <input id="more_images" name="more_images[]" type="file" multiple
                   class="file {{is_invalid($errors,'more_images')}}">
            {{input_error($errors,'more_images')}}
            {{--            <span class='required'>*</span>--}}
        </div>
    </div>
</div>
