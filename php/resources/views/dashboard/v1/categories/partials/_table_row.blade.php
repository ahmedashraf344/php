@foreach($categoryList as $index=>$category)
    <tr id="row_{{$category['id']}}">
        <th class="text-center">
            {{ $index+1}}
        </th>
        <th>{{$category['name']}}</th>
        @if(isset($currentCategory) &&($category['category_id'] != null))
            <th>{{$category->parentCategory['name']}}</th>
        @endif
        <th>{{$category['subcategories_count']}}</th>
        <th>
            @can('View category')
                @component('dashboard.v1.layouts.partials.buttons._show_button',[
                                  'route' => route('dashboard.v1.categories.show',$category),
                                  'tooltip' => __('sub categories of').' '.str_limit($category['name'],30),
                                   ])
                @endcomponent
            @endcan
            @can('Edit category')
                @component('dashboard.v1.layouts.partials.buttons._edit_button',[
                            'route' => route('dashboard.v1.categories.edit',$category),
                            'tooltip' => __('Edit').' '.str_limit($category['name'],30),
                             ])
                @endcomponent
            @endcan
            @can('Delete category')
                @php $renderURL=isset($currentCategory) ? route('dashboard.v1.categories.show',$currentCategory) :route('dashboard.v1.categories.index');  @endphp
                @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                            'route' => route('dashboard.v1.categories.destroy',$category) ,
                            'renderURL'=>$renderURL,
                            'tooltip' => __('Delete').' '.str_limit($category['name'],30),
                             ])
                @endcomponent
            @endcan
        </th>
    </tr>
@endforeach
