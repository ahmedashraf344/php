<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'name_ar')}}">
            <label class="form-control-label" for="name_ar">{{__('Name in arabic')}}</label>
            <input name="name_ar" type="text"
                   value="{{old('name_ar')}}@isset($competition){{isset_property($competition,'name_ar')}}@endisset"
                   class="form-control {{is_invalid($errors,'name_ar')}}"
                   id="name_ar" autocomplete="off" required >
            {{input_error($errors,'name_ar')}}
            <span class='required'>*</span>
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'name_en')}}">
            <label class="form-control-label" for="name_en">{{__('Name in english')}}</label>
            <input name="name_en" type="text"
                   value="{{old('name_en')}}@isset($competition){{isset_property($competition,'name_en')}}@endisset"
                   class="form-control {{is_invalid($errors,'name_en')}}"
                   id="name_en" autocomplete="off" required >
            {{input_error($errors,'name_en')}}
            <span class='required'>*</span>
        </div>
    </div>
</div>

<div class="row">
       <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'description_ar')}}">
            <label class="form-control-label" for="description_ar">{{__('Description arabic')}}</label>
            <textarea name="description_ar" class="form-control {{is_invalid($errors,'description_ar')}}">{{old('description_ar')}}@isset($competition){{isset_property($competition,'description_ar')}}@endisset</textarea>
            {{input_error($errors,'description_ar')}}
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'description_en')}}">
            <label class="form-control-label" for="description_en">{{__('Description english')}}</label>
            <textarea name="description_en" class="form-control {{is_invalid($errors,'description_en')}}">{{old('description_en')}}@isset($competition){{isset_property($competition,'description_en')}}@endisset</textarea>
            {{input_error($errors,'description_en')}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'min_number')}}">
            <label class="form-control-label" for="min_number">{{__('Min Number')}}</label>
            <input name="min_number" type="number" min="0"
                   value="{{old('min_number')}}@isset($competition){{isset_property($competition,'min_number')}}@endisset"
                   class="form-control {{is_invalid($errors,'min_number')}}"
                   id="min_number" autocomplete="off" required />
            {{input_error($errors,'min_number')}}
            <span class='required'>*</span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'max_number')}}">
            <label class="form-control-label" for="max_number">{{__('Max Number')}}</label>
            <input name="max_number" type="number" min="0"
                   value="{{old('max_number')}}@isset($competition){{isset_property($competition,'max_number')}}@endisset"
                   class="form-control {{is_invalid($errors,'max_number')}}"
                   id="max_number"  autocomplete="off" required />
            {{input_error($errors,'max_number')}}
            <span class='required'>*</span>
        </div>
    </div>
</div>
{{-- <div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="form-group {{has_error($errors,'active')}}">
            <label class="form-control-label" for="active">{{__('active')}}</label>
            <select id="active" class="form-control {{is_invalid($errors,'active')}} select2" name="active">
                <option value="" >please select active</option>
                <option value="1" {{select_input_val('1',old('active'),isset($competition)?isset_property($competition,'active'):null)}}>Enable</option>
                <option value="0" {{select_input_val('0',old('active'),isset($competition)?isset_property($competition,'active'):null)}}>Disable</option>
            </select>
            <span class='required'>*</span>
            {{input_error($errors,'active')}}
        </div>
    </div>
</div> --}}