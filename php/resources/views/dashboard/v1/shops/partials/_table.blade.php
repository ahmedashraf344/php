<table class="table text-center table-striped table-bordered dataTable"
       style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('name')}}</th>
        <th>{{__('category')}}</th>
        <th>{{__('average rate')}}</th>
        <th>{{__('status')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @include('dashboard.v1.shops.partials._table_row')
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{__('name')}}</th>
        <th>{{__('category')}}</th>
        <th>{{__('average rate')}}</th>
        <th>{{__('status')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </tfoot>
</table>
