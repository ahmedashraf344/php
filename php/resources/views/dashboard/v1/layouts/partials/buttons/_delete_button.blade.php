<button type="button"
        class="btn btn-danger btn-icon-only rounded-circle
        {{!isset($buttonSquare) ?'btn-icon-only rounded-circle': null}}
        {{isset($buttonClass) ? $buttonClass : null}} delete-item"
        route="{{isset($route) ? $route : 'javascript:void(0);'}}"
        @if(isset($renderURL)) renderURL="{{  $renderURL }}" @endif
        @if(isset($renderType)) renderType="{{  $renderType }}" @endif
        {{isset($tooltip) ? tooltip($tooltip) : null}}>
    @if(!isset($buttonSquare))
        <span class="btn-inner--icon"><i class="far fa-trash-alt"></i></span>
    @endif
    {{isset($buttonText) ?$buttonText : null}}
</button>
