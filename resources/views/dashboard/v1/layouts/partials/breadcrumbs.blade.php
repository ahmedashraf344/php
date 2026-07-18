@if (count($breadcrumbs))
    <div class="row m-0">
        <ul class="col-12 breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
        </ul>
    </div>

@endif
