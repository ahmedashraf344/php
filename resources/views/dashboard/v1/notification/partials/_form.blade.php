<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'title_en')}}">
            <label class="form-control-label" for="title_en">{{__('Title in English')}}</label>
            <input name="title_en" type="text"
                   value="{{old('title_en')}}"
                   class="form-control {{is_invalid($errors,'title_en')}}"
                   id="title_en" placeholder="" autocomplete="off">
            {{input_error($errors,'title_en')}}
            {{-- <span class='required'>*</span> --}}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'title_ar')}}">
            <label class="form-control-label" for="title_ar">{{__('Title in Arabic')}}</label>
            <input name="title_ar" type="text"
                   value="{{old('title_ar')}}"
                   class="form-control {{is_invalid($errors,'title_ar')}}"
                   id="title_ar" placeholder="" autocomplete="off">
            {{input_error($errors,'title_ar')}}
            {{-- <span class='required'>*</span> --}}
        </div>
    </div>

</div>

<div class="row">

    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'content_en')}}">
            <label class="form-control-label" for="content_en">{{__('Content in english')}}</label>
            <textarea name="content_en" class="form-control {{is_invalid($errors,'content_en')}}"
                      id="content_en" rows="7" cols="30">{{old('content_en')}}</textarea>
            {{input_error($errors,'content_en')}}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'content_ar')}}">
            <label class="form-control-label" for="content_ar">{{__('Content in arabic')}}</label>
            <textarea name="content_ar" class="form-control {{is_invalid($errors,'content_ar')}}" id="content_ar" rows="7" cols="30">{{old('content_ar')}}</textarea>
            {{input_error($errors,'content_ar')}}
        </div>
    </div>
</div>
<div class="row">

    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'date')}}">
            <label class="form-control-label" for="date">{{__('Date')}}</label>
            <input name="date" type="date"
                   value="{{old('date')}}"
                   class="form-control {{is_invalid($errors,'date')}}"
                   id="date" placeholder="" autocomplete="off">
            {{input_error($errors,'date')}}
        </div>
    </div>
</div>
