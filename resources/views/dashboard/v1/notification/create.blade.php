@extends('dashboard.v1.layouts.app')

@section('breadcrumbs', Breadcrumbs::render('v1NotificationIndex'))

@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{__('Create Notification')}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form action="{{route('dashboard.v1.notification.store')}}" method="post" >
                @csrf

                @include('dashboard.v1.notification.partials._form')

                @component('dashboard.v1.layouts.partials.buttons._save_cancel_button',[])
                @endcomponent
            </form>
        </div>
    </div>
@endsection
