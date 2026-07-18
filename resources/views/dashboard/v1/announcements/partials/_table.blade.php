<table class="table text-center table-striped table-bordered dataTable"
       style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('name')}}</th>
        <th>{{__('enable at')}}</th>
        <th>{{__('disable at')}}</th>
        <th>{{__('type')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @include('dashboard.v1.announcements.partials._table_row')
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{__('name')}}</th>
        <th>{{__('enable at')}}</th>
        <th>{{__('disable at')}}</th>
        <th>{{__('type')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </tfoot>
</table>
