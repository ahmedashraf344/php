@extends('dashboard.v1.layouts.app')

@include('dashboard.v1.layouts.partials.plugins.tinymce')

@section('breadcrumbs', Breadcrumbs::render('v1AnnouncementEdit',$announcement))

@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{__('Update announcement')}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form action="{{route('dashboard.v1.announcements.update',$announcement)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('dashboard.v1.announcements.partials._form')

                @component('dashboard.v1.layouts.partials.buttons._save_cancel_button',[])
                @endcomponent
            </form>
        </div>
    </div>
@endsection
