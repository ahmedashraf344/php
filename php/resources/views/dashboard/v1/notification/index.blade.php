@extends('dashboard.v1.layouts.app')

@include('dashboard.v1.layouts.partials.plugins.datatable')

@section('breadcrumbs', Breadcrumbs::render('v1NotificationIndex'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">{{__('Posts')}}</h3>
                    <p class="text-sm mb-0">
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive py-1">
                        <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12" id="results">
                                    @include('dashboard.v1.notification.partials._table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
