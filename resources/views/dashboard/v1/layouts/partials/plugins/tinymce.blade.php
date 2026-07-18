@section('style')
    <!-- tinymce -->
    <script type="text/javascript" src="{{asset('admin/vendor/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: "textarea.tinymce",
            theme: "silver",
            width: '100%',
            height: 500,
            menubar: false,
            //toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
            plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount tinymcespellchecker a11ychecker imagetools textpattern help formatpainter permanentpen pageembed tinycomments mentions linkchecker',
            toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',
            image_advtab: true,
        });
    </script>
@endsection
