<a href="{{isset($route) ? $route : 'javascript:void(0);'}}"
   class="btn btn-primary btn-icon-only rounded-circle"
@if(isset($tooltip) ) {{tooltip($tooltip)}} @endif>
    <span class="btn-inner--icon"><i class="far fa-eye"></i></span>
    @if(isset($buttonText)) {{$buttonText }} @endif
</a>
