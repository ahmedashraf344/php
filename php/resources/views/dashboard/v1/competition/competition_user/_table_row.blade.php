@foreach($competitionUsers as $index => $comp_user)
    <tr id="row_{{$comp_user->pivot->id}}">
        <th class="text-center">
            {{$comp_user->pivot->id}}
        </th>
        <th>{{$comp_user->user_name}}</th>
        <th>{{$comp_user->user_email}}</th>
        <th>{{$comp_user->user_mobile}}</th>
        <th>{{$comp_user->pivot->number}}</th>
    </tr>
@endforeach
