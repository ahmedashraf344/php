@foreach($contactUsList as $index=>$contact)
    @include('dashboard.v1.contact-us-forms.partials.message_modal',$contact)

    <tr id="row_{{$contact['id']}}">
        <th class="text-center">
            {{ $index+1}}
        </th>
        <th>{{$contact['create_date']}}</th>
        <th>{{$contact['email']}}</th>
        <th>
            <div data-toggle="modal" data-target="#exampleModalLong">
                {{str_limit($contact['message'],30,' ..... '.__('read more'))}}
            </div>
        </th>
        <th>{{status_value($contact)}}</th>
        <th>
            @if($contact['status'] == \App\Models\ContactUs::STATUS_PENDING)
                @can('Edit contactus')
                    @component('dashboard.v1.layouts.partials.buttons._custom_button',[
                                'route' => route('dashboard.v1.contact-us-forms.edit',$contact),
                                'buttonText' => __('mark as contacted'),
                                'buttonSquare'=>true,
                                'buttonClass'=>'btn-success btn-sm'
                                 ])
                    @endcomponent
                @endcan
            @endif
            @can('Delete contactus')
                @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                                'route' => route('dashboard.v1.contact-us-forms.destroy',$contact) ,
                                'renderURL'=>route('dashboard.v1.contact-us-forms.index'),
                                'tooltip' => __('Delete'),
                                 ])
                @endcomponent
            @endcan
        </th>
    </tr>
@endforeach
