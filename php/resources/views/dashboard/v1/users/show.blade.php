@extends('dashboard.v1.layouts.app')

@section('breadcrumbs', Breadcrumbs::render('v1UserShow',$user))


@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{__('user data')}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            @include('dashboard.v1.users.partials._form')

            @component('dashboard.v1.layouts.partials.buttons._edit_button',[
                                        'route' => route('dashboard.v1.users.edit',$user),
                                        'buttonText' => __('Edit'),
                                         ])
            @endcomponent
            </form>
        </div>
    </div>
@endsection
