@section('style')
    {{-- Data table --}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('script')
    {{-- Data table --}}
    <script type="text/javascript" src="{{asset('admin/vendor/datatable/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/vendor/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            /*$('.dataTable').DataTable();*/
            $('.dataTable').dataTable({
                aaSorting: [[0, 'asc']]
            });
        });
    </script>
    @if(App::getLocale() == 'ar')
        <script src="{{asset('admin/js/datatable-ar.js')}}"></script>
    @endif
@endsection

