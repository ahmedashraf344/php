@foreach($postList as $index=>$post)
    <tr id="row_{{$post['id']}}">
        <th class="text-center">
            {{ $index+1}}
        </th>
        <th>{{$post['name']}}</th>
        <th>{{$post->user['name']}}</th>
        <th>{{status_value($post)}}</th>
        <th>
            {{--@can('View post')
                @component('dashboard.v1.layouts.partials.buttons._show_button',[
                                  'route' => route('dashboard.v1.posts.show',$post),
                                  'tooltip' => __('data of').' '.str_limit($post['name'],30),
                                   ])
                @endcomponent
            @endcan--}}
            @can('Edit post')
                @component('dashboard.v1.layouts.partials.buttons._edit_button',[
                            'route' => route('dashboard.v1.posts.edit',$post),
                            'tooltip' => __('Edit').' '.str_limit($post['name'],30),
                             ])
                @endcomponent
            @endcan
            @can('Delete post')
                @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                            'route' => route('dashboard.v1.posts.destroy',$post) ,
                            'renderURL'=>route('dashboard.v1.posts.index'),
                            'tooltip' => __('Delete').' '.str_limit($post['name'],30),
                             ])
                @endcomponent
            @endcan
        </th>
    </tr>
@endforeach
