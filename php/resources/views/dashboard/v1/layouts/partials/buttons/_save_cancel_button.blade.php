<button type="submit" id="{{isset($submitId) ? $submitId :'submit'}}"
        class="btn {{isset($buttonClass) ? $buttonClass : 'btn-primary'}}
        {{isset($buttonSize) ? $buttonSize :'btn-md'}} m-2" id="submit_button">
    {{ (isset($submitText) ? $submitText :( is_create() ?  __('Save') : __('Save changes')))}}
</button>

<button type="reset" class="btn btn-warning {{isset($buttonSize) ? $buttonSize :'btn-md'}}
    m-2 {{isset($resetClass) ? $resetClass :null}}"
        @if(!isset($resetClass))id="reset_button"@endif>
    {!! __('Cancel') !!}
</button>
