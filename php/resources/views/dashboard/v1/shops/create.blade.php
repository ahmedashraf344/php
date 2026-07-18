@extends('dashboard.v1.layouts.app')

@section('breadcrumbs', Breadcrumbs::render('v1ShopIndex'))

@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{__('Create shop')}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form action="{{route('dashboard.v1.shops.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                @include('dashboard.v1.shops.partials._form')

                @component('dashboard.v1.layouts.partials.buttons._save_cancel_button',[])
                @endcomponent
            </form>
        </div>
    </div>
@endsection
