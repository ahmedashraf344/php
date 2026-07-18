@foreach($announcementList as $index=>$announcement)
    <tr id="row_{{$announcement['id']}}">
        <th class="text-center">
            {{ $index+1}}
        </th>
        <th>{{str_limit($announcement['name'])}}</th>
        <th>{{$announcement['enable_at']}}</th>
        <th>{{$announcement['disable_at']}}</th>
        <th>{{$announcement['type_value']}}</th>
        <th>
            {{--@can('View announcement')
                @component('dashboard.v1.layouts.partials.buttons._show_button',[
                                  'route' => route('dashboard.v1.announcements.show',$announcement),
                                  'tooltip' => __('Data of').' '.str_limit($announcement['name'],30),
                                   ])
                @endcomponent
            @endcan--}}
            @can('Edit announcement')
                @component('dashboard.v1.layouts.partials.buttons._edit_button',[
                            'route' => route('dashboard.v1.announcements.edit',$announcement),
                            'tooltip' => __('Edit').' '.str_limit($announcement['name'],30),
                             ])
                @endcomponent
            @endcan
            @can('Delete announcement')
                @php $renderURL=isset($currentAnnouncement) ? route('dashboard.v1.announcements.show',$currentAnnouncement) :route('dashboard.v1.announcements.index');  @endphp
                @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                            'route' => route('dashboard.v1.announcements.destroy',$announcement) ,
                            'renderURL'=> route('dashboard.v1.announcements.index'),
                            'tooltip' => __('Delete').' '.str_limit($announcement['name'],30),
                             ])
                @endcomponent
            @endcan
        </th>
    </tr>
@endforeach
