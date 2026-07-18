<table class="table text-center table-striped table-bordered dataTable"
       style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('name')}}</th>
        <th>{{__('email') .' / '.__('mobile')}}</th>
        <th>{{__('registration date')}}</th>
        <th>{{__('status')}}</th>
        <th>{{__('user uuid')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @include('dashboard.v1.users.partials._table_row')
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{__('name')}}</th>
        <th>{{__('email') .' / '.__('mobile')}}</th>
        <th>{{__('registration date')}}</th>
        <th>{{__('status')}}</th>
        <th>{{__('user uuid')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </tfoot>
</table>
