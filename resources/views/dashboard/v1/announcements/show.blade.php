@extends('dashboard.v1.layouts.app')

@section('breadcrumbs', Breadcrumbs::render('v1AnnouncementShow',$announcement))

@include('dashboard.v1.layouts.partials.plugins.datatable')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">{{__('Data of').' '.str_limit($announcement['name'],30)}}</h3>
                    <p class="text-sm mb-0">
                    </p>
                </div>
                <div class="card-body">
                    <!-- Form groups used in grid -->
                    @include('dashboard.v1.announcements.partials._form')

                    @component('dashboard.v1.layouts.partials.buttons._edit_button',[
                            'route' => route('dashboard.v1.announcements.edit',$announcement),
                            'buttonText' => __('Edit'),
                             ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection
