@section('style')
    {{-- File input--}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/fileinput/fileinput.css')}}">
    @if(App::getLocale() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/fileinput/fileinput-rtl.css')}}">
    @endif
@endsection

@section('script')
    {{-- File input --}}
    <script type="text/javascript" src="{{asset('admin/vendor/fileinput/fileinput.js')}}"></script>

    <script>
        $(".file").fileinput({
            showUpload: false,
            dropZoneEnabled: false,
        });
    </script>
@endsection
