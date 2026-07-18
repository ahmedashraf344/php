<button type="submit" class="btn {{isset($buttonClass) ? $buttonClass : 'btn-turquoise'}} " id="submit_button">
    {{isset($buttonText) ?$buttonText : __('Submit')}}
</button>
