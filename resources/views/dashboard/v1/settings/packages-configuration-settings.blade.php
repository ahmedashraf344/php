@extends('dashboard.v1.layouts.app')
@section('breadcrumbs', Breadcrumbs::render('managePackagesConfigurationSettings'))
@section('content')
    <!-- Form groups used in grid -->
    <form action="{{route('static.updateContent')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0"><span class="small text-primary">for detecting new messages sent and send notifications</span> Pusher</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'PUSHER_APP_ID')}}">
                            <label class="form-control-label"
                                   for="PUSHER_APP_ID">PUSHER_APP_ID</label>
                            <input name="PUSHER_APP_ID"  type="text" value="{{old('PUSHER_APP_ID') ?: setting_value('PUSHER_APP_ID')}}"
                                   class="form-control {{is_invalid($errors,'PUSHER_APP_ID')}}"
                                   id="PUSHER_APP_ID" placeholder="">
                            {{input_error($errors,'PUSHER_APP_ID')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'PUSHER_APP_KEY')}}">
                            <label class="form-control-label"
                                   for="PUSHER_APP_KEY">PUSHER_APP_KEY</label>
                            <input name="PUSHER_APP_KEY"  type="text" value="{{old('PUSHER_APP_KEY') ?: setting_value('PUSHER_APP_KEY')}}"
                                   class="form-control {{is_invalid($errors,'PUSHER_APP_KEY')}}"
                                   id="PUSHER_APP_KEY" placeholder="">
                            {{input_error($errors,'PUSHER_APP_KEY')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'PUSHER_APP_SECRET')}}">
                            <label class="form-control-label"
                                   for="PUSHER_APP_SECRET">PUSHER_APP_SECRET</label>
                            <input name="PUSHER_APP_SECRET"  type="text" value="{{old('PUSHER_APP_SECRET') ?: setting_value('PUSHER_APP_SECRET')}}"
                                   class="form-control {{is_invalid($errors,'PUSHER_APP_SECRET')}}"
                                   id="PUSHER_APP_SECRET" placeholder="">
                            {{input_error($errors,'PUSHER_APP_SECRET')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0"><span class="small text-primary">for sending push notifications</span> OneSignal</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'ONE_SIGNAL_APP_ID')}}">
                            <label class="form-control-label"
                                   for="ONE_SIGNAL_APP_ID">ONE_SIGNAL_APP_ID</label>
                            <input name="ONE_SIGNAL_APP_ID"  type="text" value="{{old('ONE_SIGNAL_APP_ID') ?: setting_value('ONE_SIGNAL_APP_ID')}}"
                                   class="form-control {{is_invalid($errors,'ONE_SIGNAL_APP_ID')}}"
                                   id="ONE_SIGNAL_APP_ID" placeholder="">
                            {{input_error($errors,'ONE_SIGNAL_APP_ID')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'ONE_SIGNAL_REST_API_KEY')}}">
                            <label class="form-control-label"
                                   for="ONE_SIGNAL_REST_API_KEY">ONE_SIGNAL_REST_API_KEY</label>
                            <input name="ONE_SIGNAL_REST_API_KEY"  type="text" value="{{old('ONE_SIGNAL_REST_API_KEY') ?: setting_value('ONE_SIGNAL_REST_API_KEY')}}"
                                   class="form-control {{is_invalid($errors,'ONE_SIGNAL_REST_API_KEY')}}"
                                   id="ONE_SIGNAL_REST_API_KEY" placeholder="">
                            {{input_error($errors,'ONE_SIGNAL_REST_API_KEY')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'ONE_SIGNAL_USER_AUTH_KEY')}}">
                            <label class="form-control-label"
                                   for="ONE_SIGNAL_USER_AUTH_KEY">ONE_SIGNAL_USER_AUTH_KEY</label>
                            <input name="ONE_SIGNAL_USER_AUTH_KEY"  type="text" value="{{old('ONE_SIGNAL_USER_AUTH_KEY') ?: setting_value('ONE_SIGNAL_USER_AUTH_KEY')}}"
                                   class="form-control {{is_invalid($errors,'ONE_SIGNAL_USER_AUTH_KEY')}}"
                                   id="ONE_SIGNAL_USER_AUTH_KEY" placeholder="">
                            {{input_error($errors,'ONE_SIGNAL_USER_AUTH_KEY')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0"><span class="small text-primary">for managing newsletter subscriptions</span> MailChimp </h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'MAILCHIMP_API_KEY')}}">
                            <label class="form-control-label"
                                   for="MAILCHIMP_API_KEY">MAILCHIMP_API_KEY</label>
                            <input name="MAILCHIMP_API_KEY"  type="text" value="{{old('MAILCHIMP_API_KEY') ?: setting_value('MAILCHIMP_API_KEY')}}"
                                   class="form-control {{is_invalid($errors,'MAILCHIMP_API_KEY')}}"
                                   id="MAILCHIMP_API_KEY" placeholder="">
                            {{input_error($errors,'MAILCHIMP_API_KEY')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'MAILCHIMP_LIST_ID')}}">
                            <label class="form-control-label"
                                   for="MAILCHIMP_LIST_ID"><span class="small"> also called " Audience ID " </span>MAILCHIMP_LIST_ID</label>
                            <input name="MAILCHIMP_LIST_ID"  type="text" value="{{old('MAILCHIMP_LIST_ID') ?: setting_value('MAILCHIMP_LIST_ID')}}"
                                   class="form-control {{is_invalid($errors,'MAILCHIMP_LIST_ID')}}"
                                   id="MAILCHIMP_LIST_ID" placeholder="">
                            {{input_error($errors,'MAILCHIMP_LIST_ID')}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'MAILCHIMP_REGISTER_EMAIL')}}">
                            <label class="form-control-label"
                                   for="MAILCHIMP_REGISTER_EMAIL"><span class="small"> email in  registration process </span>MAILCHIMP_REGISTER_EMAIL </label>
                            <input name="MAILCHIMP_REGISTER_EMAIL"  type="text" value="{{old('MAILCHIMP_REGISTER_EMAIL') ?: setting_value('MAILCHIMP_REGISTER_EMAIL')}}"
                                   class="form-control {{is_invalid($errors,'MAILCHIMP_REGISTER_EMAIL')}}"
                                   id="MAILCHIMP_REGISTER_EMAIL" placeholder="">
                            {{input_error($errors,'MAILCHIMP_REGISTER_EMAIL')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0"><span class="small text-primary">for extracting youtube video data using its url</span> Youtube API 3 </h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group {{has_error($errors,'YOUTUBE_API_KEY')}}">
                            <label class="form-control-label"
                                   for="YOUTUBE_API_KEY">YOUTUBE_API_KEY</label>
                            <input name="YOUTUBE_API_KEY"  type="text" value="{{old('YOUTUBE_API_KEY') ?: setting_value('YOUTUBE_API_KEY')}}"
                                   class="form-control {{is_invalid($errors,'YOUTUBE_API_KEY')}}"
                                   id="YOUTUBE_API_KEY" placeholder="">
                            {{input_error($errors,'YOUTUBE_API_KEY')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{__('update')}}</button>
    </form>
@endsection

