<a href="{{isset($route) ? $route : 'javascript:void(0);'}}"
   @if(isset($target)) target="{{$target}}" @endif
   class="btn btn-success @if(!isset($buttonText)) btn-icon-only rounded-circle @endif"
@if(isset($tooltip)) {{tooltip($tooltip)}} @endif>
    <span class="btn-inner--icon"><i class="far fa-edit"></i></span>
    @if(isset($buttonText)) {{$buttonText }} @endif
</a>
