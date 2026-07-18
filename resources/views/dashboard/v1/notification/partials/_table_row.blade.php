@foreach($notificationList as $index => $notification)
    <tr id="row_{{$notification['id']}}">
        <th class="text-center">
            {{ $index+1}}
        </th>
        <th>{{$notification->user['name']}}</th>
        <th>{{$notification['title_en']}}</th>
        <th>{{$notification['title_ar']}}</th>
        <th>{{$notification['content_en']}}</th>
        <th>{{$notification['content_ar']}}</th>
        <th>{{$notification['date']}}</th>
        <th>
            @can('Delete notification')
                @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                            'route' => route('dashboard.v1.notification.destroy',$notification['id']) ,
                            'renderURL'=>route('dashboard.v1.notification.index'),
                            'tooltip' => __('Delete').' '.str_limit($notification['title_en'],30),
                             ])
                @endcomponent
            @endcan
        </th>
    </tr>
@endforeach
