@foreach($userList as $index=>$user)
    <tr id="row_{{$user['id']}}">
        <th class="text-center">
            {{ $index+1}}
        </th>
        <th>{{$user['name']}}</th>
        <th>
            <ul>
                @if($user['email'])
                    <li>{{$user['email']}}</li>
                @endif
                @if($user['mobile'])
                    <li>{{$user['mobile']}}</li>
                @endif
            </ul>
        </th>
        <th>{{custom_date_only($user['created_at'])}}</th>
        <th>{{$user['verification_status'] ? 'Verified' : 'Not Verified Yet'}}</th>
        <th>{{$user->uuid ? $user->uuid->device_id : 'No'}}</th>
        <th>
            {{--@can('View user')
                @component('dashboard.v1.layouts.partials.buttons._show_button',[
                                  'route' => route('dashboard.v1.users.show',$user),
                                  'tooltip' => __('data of').' '.str_limit($user['name'],30),
                                   ])
                @endcomponent
            @endcan--}}
            @can('Edit user')
                @component('dashboard.v1.layouts.partials.buttons._edit_button',[
                            'route' => route('dashboard.v1.users.edit',$user),
                            'tooltip' => __('Edit').' '.str_limit($user['name'],30),
                             ])
                @endcomponent
            @endcan
            @if(!in_array($user['id'],\App\Models\User::MAIN_ACCOUNTS_IDS))
                @can('Delete user')
                    @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                                    'route' => route('dashboard.v1.users.destroy',$user) ,
                                    'renderURL'=>route('dashboard.v1.users.index'),
                                    'tooltip' => __('Delete').' '.str_limit($user['name'],30),
                                     ])
                    @endcomponent
                @endcan
            @endif
        </th>
    </tr>
@endforeach
