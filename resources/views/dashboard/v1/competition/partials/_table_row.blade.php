@foreach($competitionList as $index => $competition)
    @php
        $buttonText = ($competition->active == 1) ? 'Enabled': 'Disabled';
        $verbText = ($competition->active == 1) ? 'Disable': 'Enable';
    @endphp
    <tr id="row_{{$competition['id']}}">
        <th class="text-center">
            {{ $index+1}}
        </th>
        <th>{{$competition->name_ar}}</th>
        <th>{{$competition->name_en}}</th>
        <th>{{$competition->description_ar}}</th>
        <th>{{$competition->description_en}}</th>
        <th>{{$competition->min_number}}</th>
        <th>{{$competition->max_number}}</th>
        <th>@component('dashboard.v1.layouts.partials.buttons._enable_disable_button',[
                                    'route' => route('dashboard.v1.competition.status',$competition->id),
                                    'buttontxt' => $buttonText,
                                    'verbtxt' => $verbText,
                                    'name' => $competition->name_en .' - '.$competition->name_ar,
                                ])
            @endcomponent
        </th>
        <th>
            @can('View competition')
                @component('dashboard.v1.layouts.partials.buttons._show_button',[
                                  'route' => route('dashboard.v1.competition.show',$competition->id),
                                  'tooltip' => __('View')])
                @endcomponent
            @endcan
            @can('Edit competition')
                @component('dashboard.v1.layouts.partials.buttons._edit_button',[
                            'route' => route('dashboard.v1.competition.edit',$competition->id),
                            'tooltip' => __('Edit')])
                @endcomponent
            @endcan
            @can('Delete competition')
                @php $renderUrlParams=isset($currentcompetition) ? ['competition_id'=>$currentcompetition['id']] :[];  @endphp
                @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                            'route' => route('dashboard.v1.competition.destroy',$competition->id) ,
                            'renderURL'=>route('dashboard.v1.competition.index',$renderUrlParams),
                            'tooltip' => __('Delete')])
                @endcomponent
            @endcan
        </th>
    </tr>
@endforeach
