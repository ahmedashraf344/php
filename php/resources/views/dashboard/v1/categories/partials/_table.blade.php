<table class="table text-center table-striped table-bordered dataTable"
       style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('name')}}</th>
        @if(isset($currentCategory))
            <th>{{__('parent category')}}</th>
        @endif
        <th>{{__('sub categories count')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @include('dashboard.v1.categories.partials._table_row')
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{__('name')}}</th>
        @if(isset($currentCategory))
            <th>{{__('parent category')}}</th>
        @endif
        <th>{{__('sub categories count')}}</th>
        <th>{{__('actions')}}</th>
    </tr>
    </tfoot>
</table>
