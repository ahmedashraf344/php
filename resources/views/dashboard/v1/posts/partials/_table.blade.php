<table class="table text-center table-striped table-bordered dataTable"
       style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('name')}}</th>
        <th>{{__('added by')}}</th>
        <th>{{__('status')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @include('dashboard.v1.posts.partials._table_row')
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{__('name')}}</th>
        <th>{{__('added by')}}</th>
        <th>{{__('status')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </tfoot>
</table>
