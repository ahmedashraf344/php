<table class="table text-center table-striped table-bordered dataTable"
       style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('User Name')}}</th>
        <th>{{__('User Email')}}</th>
        <th>{{__('User Mobile')}}</th>
        <th>{{__('Number Selected')}}</th>
        {{-- <th>{{__('Actions')}}</th> --}}
    </tr>
    </thead>
    <tbody>
    @include('dashboard.v1.competition.competition_user._table_row')
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{__('User Name')}}</th>
        <th>{{__('User Email')}}</th>
        <th>{{__('User Mobile')}}</th>
        <th>{{__('Number Selected')}}</th>
        {{-- <th>{{__('Actions')}}</th> --}}
    </tr>
    </tfoot>
</table>
