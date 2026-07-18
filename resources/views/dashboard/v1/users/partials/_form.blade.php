@include('dashboard.v1.layouts.partials.plugins.fileinput')

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'name')}}">
            <label class="form-control-label" for="name">{{__('name')}}</label>
            <input name="name" type="text"
                   value="@isset($user){{isset_property($user,'name')}}@endisset"
                   class="form-control {{is_invalid($errors,'name')}}"
                   id="name" placeholder="" autocomplete="off">
            {{input_error($errors,'name')}}
            <span class='required'>*</span>
        </div>
    </div>

    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'email')}}">
            <label class="form-control-label" for="email">{{__('email')}}</label>
            <input name="email" type="email"
                   value="@isset($user){{isset_property($user,'email')}}@endisset"
                   class="form-control {{is_invalid($errors,'email')}}"
                   id="email" placeholder="" autocomplete="off">
            {{input_error($errors,'email')}}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'password')}}">
            <label class="form-control-label" for="password">{{__('password')}}</label>
            <input name="password" type="password"
                   value=""
                   class="form-control {{is_invalid($errors,'password')}}"
                   id="password" placeholder="" autocomplete="off">
            {{input_error($errors,'password')}}
        </div>
    </div>

    <div class="col-sm-6 col-md-6">
        <div class="form-group {{has_error($errors,'password_confirmation')}}">
            <label class="form-control-label" for="password_confirmation">{{__('password confirmation')}}</label>
            <input name="password_confirmation" type="password"
                   value=""
                   class="form-control {{is_invalid($errors,'password_confirmation')}}"
                   id="password_confirmation" placeholder="" autocomplete="off">
            {{input_error($errors,'password_confirmation')}}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'mobile')}}">
            <label class="form-control-label" for="mobile">{{__('mobile')}}</label>
            <input name="mobile" type="text"
                   value="@isset($user){{isset_property($user,'mobile')}}@endisset"
                   class="form-control {{is_invalid($errors,'mobile')}}"
                   id="mobile" placeholder="" autocomplete="off">
            {{input_error($errors,'mobile')}}
        </div>
    </div>
    <div class="col-sm-6 col-md-4 {{disable_on_edit()}}">
        <div class="form-group">
            <label class="form-control-label" for="status">{{__('status')}}</label>
            <input name="status" type="text" {{readonly_on_edit()}}
                   value="@isset($user){{$user['verified_value']}}@endisset"
                   class="form-control"
                   id="status" placeholder="" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group {{has_error($errors,'avatar')}}">
            <label class="form-control-label"
                   for="avatar">{{__('Image')}}</label>
            @if(!is_create() && (isset_property($user,'avatar') != null))
                <p class="show-page" id="avatar">
                    <a href="{{asset($user['avatar'])}}"
                       target="_blank">
                        <img src="{{asset($user['avatar'])}}"
                             alt="{{__('Avatar')}}" class="show-img">
                    </a>
                </p>
            @endif
            <input id="avatar" name="avatar" type="file"
                   class="file {{is_invalid($errors,'avatar')}}">
            {{input_error($errors,'avatar')}}
            {{--<span class='required'>*</span>--}}
        </div>
    </div>

</div>
