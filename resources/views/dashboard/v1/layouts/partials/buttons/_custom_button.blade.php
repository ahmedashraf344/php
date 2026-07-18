@php if(!isset($iconOnly) ) $iconOnly=true @endphp
<a href="{{isset($route) ? $route : 'javascript:void(0);'}}"
   @if(isset($target)) target="{{$target}}" @endif
   class="btn {{isset($buttonClass) ? $buttonClass : 'btn-info'}}
@if(!isset($buttonSquare) && $iconOnly){{!is_show()  ?'btn-icon-only rounded-circle' : 'btn-md'}}@endif"
@if(isset($tooltip) ) {{tooltip($tooltip)}} @endif>
    @if(isset($buttonIcon))
        <span class="btn-inner--icon"><i class="{{$buttonIcon}}"></i></span>
    @endif
    @if(isset($buttonText)) {{$buttonText }} @endif
</a>
