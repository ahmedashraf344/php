<table class="table text-center table-striped table-bordered dataTable"
       style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('Name ar')}}</th>
        <th>{{__('Name en')}}</th>
        <th>{{__('Description ar')}}</th>
        <th>{{__('Description en')}}</th>
        <th>{{__('Min Number')}}</th>
        <th>{{__('Max Number')}}</th>
        <th>{{__('Active')}}</th>
        <th>{{__('Actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @include('dashboard.v1.competition.partials._table_row')
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{__('Name ar')}}</th>
        <th>{{__('Name en')}}</th>
        <th>{{__('Description ar')}}</th>
        <th>{{__('Description en')}}</th>
        <th>{{__('Min Number')}}</th>
        <th>{{__('Max Number')}}</th>
        <th>{{__('Status')}}</th>
        <th>{{__('Actions')}}</th>
    </tr>
    </tfoot>
</table>
