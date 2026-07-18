<table class="table text-center table-striped table-bordered dataTable"
       style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('Added By')}}</th>
        <th>{{__('Title En')}}</th>
        <th>{{__('Title Ar')}}</th>
        <th>{{__('Content En')}}</th>
        <th>{{__('Content Ar')}}</th>
        <th>{{__('Date')}}</th>
        <th>{{__('Actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @include('dashboard.v1.notification.partials._table_row')
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{__('Added By')}}</th>
        <th>{{__('Title En')}}</th>
        <th>{{__('Title Ar')}}</th>
        <th>{{__('Content En')}}</th>
        <th>{{__('Content Ar')}}</th>
        <th>{{__('Date')}}</th>
        <th>{{__('Actions')}}</th>
    </tr>
    </tfoot>
</table>
