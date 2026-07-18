@extends('dashboard.v1.layouts.app')


@include('dashboard.v1.layouts.partials.plugins.datatable')

@section('breadcrumbs', Breadcrumbs::render('v1CompetitionIndex',$competition))

@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h2 class="mb-0">{{__('Data of').' : '.$competition['name_en']}}</h2>
            
            <form action="{{route('dashboard.v1.competition.clear_data')}}" id="clear_data_form" method="post">
                @csrf
                <input type="hidden" name="competition_id" value="{{$competition->id}}" />
                <div class="row">
                    <div class="col-12">
                        <h3>To clear competition data please type your password and make sure the competition is disabled first</h3>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="password" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger form-control" >Clear Data</button>
                        </div>
                    </div>
            </form>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <div class="row">
                @include('dashboard.v1.competition.competition_user._table')
            </div>
        </div>
    </div>
@endsection
