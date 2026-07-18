<table class="table text-center table-striped table-bordered dataTable"
       style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('date')}}</th>
        <th>{{__('contact email')}}</th>
        <th>{{__('message')}}</th>
        <th>{{__('status')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @include('dashboard.v1.contact-us-forms.partials._table_row')
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{__('date')}}</th>
        <th>{{__('contact email')}}</th>
        <th>{{__('message')}}</th>
        <th>{{__('status')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </tfoot>
</table>
