@foreach($shopList as $index=>$shop)
    <tr id="row_{{$shop['id']}}">
        <th class="text-center">
            {{ $index+1}}
        </th>
        <th>{{$shop['name']}}</th>
        <th>{{$shop->category['name']}}</th>
        <th>{{round($shop->reviews->avg('rate'),1)}}</th>
        <th>{{status_value($shop)}}</th>
        <th>
            @can('View shop')
                @component('dashboard.v1.layouts.partials.buttons._show_button',[
                                  'route' => route('dashboard.v1.shops.show',$shop),
                                  'tooltip' => __('data of').' '.str_limit($shop['name'],30),
                                   ])
                @endcomponent
            @endcan
            @can('Edit shop')
                @component('dashboard.v1.layouts.partials.buttons._edit_button',[
                            'route' => route('dashboard.v1.shops.edit',$shop),
                            'tooltip' => __('Edit').' '.str_limit($shop['name'],30),
                             ])
                @endcomponent
            @endcan
            @can('Delete shop')
                @php $renderUrlParams=isset($currentShop) ? ['shop_id'=>$currentShop['id']] :[];  @endphp
                @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                            'route' => route('dashboard.v1.shops.destroy',$shop) ,
                            'renderURL'=>route('dashboard.v1.shops.index',$renderUrlParams),
                            'tooltip' => __('Delete').' '.str_limit($shop['name'],30),
                             ])
                @endcomponent
            @endcan
        </th>
    </tr>
@endforeach
