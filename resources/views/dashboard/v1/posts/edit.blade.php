@extends('dashboard.v1.layouts.app')

@section('breadcrumbs', Breadcrumbs::render('v1PostEdit',$post))

@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{__('Edit post data added by').' : '.$post->user['name']}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form action="{{route('dashboard.v1.posts.update',$post)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('dashboard.v1.posts.partials._form')

                @component('dashboard.v1.layouts.partials.buttons._save_cancel_button',[])
                @endcomponent
            </form>
        </div>
    </div>
@endsection
