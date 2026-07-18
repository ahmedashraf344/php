@extends('dashboard.v1.layouts.app')

@section('breadcrumbs', Breadcrumbs::render('v1ShopShow',$shop))


@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h2 class="mb-0">{{__('Data of').' : '.$shop['name']}}</h2>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <div class="row">

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('Name in arabic')}} : </b>
                    <span class="m-2">{{$shop['name_ar']??'----'}}</span>
                </div>

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('Name in english')}} : </b>
                    <span class="m-2">{{$shop['name_en']??'----'}}</span>
                </div>

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('Category')}} : </b>
                    <span class="m-2">{{$shop->category['name']??'----'}}</span>
                </div>

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('Status')}} : </b>
                    <span class="m-2">{{status_value($shop)??'----'}}</span>
                </div>

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('Status Reason')}} : </b>
                    <span class="m-2">{{$shop['status_reason']??'----'}}</span>
                </div>

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('Added by')}} : </b>
                    <span class="m-2">{{$shop->user['name']??'----'}}</span>
                </div>

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('Added at')}} : </b>
                    <span class="m-2">{{$shop['create_date']}}</span>
                </div>

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('Address in arabic')}} : </b>
                    <span class="m-2">{{$shop['address_ar']??'----'}}</span>
                </div>

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('Address in english')}} : </b>
                    <span class="m-2">{{$shop['address_en']??'----'}}</span>
                </div>

            </div>

            <div class="row">

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('Mobile 1')}} : </b>
                    <span class="m-2">{{$shop['mobile_1']??'----'}}</span>
                </div>

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('Mobile 2')}} : </b>
                    <span class="m-2">{{$shop['mobile_2']??'----'}}</span>
                </div>

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('Phone 1')}} : </b>
                    <span class="m-2">{{$shop['phone1']??'----'}}</span>
                </div>

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('Phone 2')}} : </b>
                    <span class="m-2">{{$shop['phone2']??'----'}}</span>
                </div>

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('Hotline')}} : </b>
                    <span class="m-2">{{$shop['hotline']??'----'}}</span>
                </div>

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('Latitude')}} : </b>
                    <span class="m-2">{{$shop['latitude']??'----'}}</span>
                </div>

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('Longitude')}} : </b>
                    <span class="m-2">{{$shop['longitude']??'----'}}</span>
                </div>

            </div>

            <div class="row">

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('working days in arabic')}} : </b>
                    <span class="m-2">{{$shop['working_days_ar']??'----'}}</span>
                </div>

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('working days in english')}} : </b>
                    <span class="m-2">{{$shop['working_days_en']??'----'}}</span>
                </div>

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('start working at')}} : </b>
                    <span class="m-2">{{$shop['start_at']??'----'}}</span>
                </div>

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('end working at')}} : </b>
                    <span class="m-2">{{$shop['end_at']??'----'}}</span>
                </div>

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('Facebook link')}} : </b>
                    <span class="m-2">
                    <a href="{{$shop['facebook'] ??'javascript:void;'}}" @if($shop['facebook']) target="_blank" @endif
                    class="text-warning">{{$shop['facebook'] ?__('visit'):__('not added yet')}}</a>
                    </span>
                </div>

                <div class="col-sm-3 mb-2">
                    <b class="text-primary">{{__('Instagram link')}} : </b>
                    <span class="m-2">
                    <a href="{{$shop['instagram'] ??'javascript:void;'}}" @if($shop['instagram']) target="_blank" @endif
                    class="text-warning">{{$shop['instagram'] ?__('visit'):__('not added yet')}}</a>
                    </span>
                </div>

            </div>

            <div class="row">

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('Feature image')}} : </b>
                    @if($shop['feature_image'] != null)
                        <p class="show-page mt-2 mb-2" id="feature_image">
                            <a href="{{asset($shop['feature_image'])}}"
                               target="_blank">
                                <img src="{{asset($shop['feature_image'])}}"
                                     alt="{{__('Feature image')}}" class="show-img">
                            </a>
                        </p>
                    @else
                        <span class="m-2">----</span>
                    @endif
                </div>

                <div class="col-sm-6 mb-2">
                    <b class="text-primary">{{__('More images')}} : </b>
                    @if($shop->gallery->count() != 0)
                        <div class="show-page row mt-2 mb-2" id="more_images">
                            @foreach($shop->gallery as $moreImage)
                                <div class="col-4 mb-4">
                                    <a href="{{asset($moreImage['file'])}}"
                                       target="_blank">
                                        <img src="{{asset($moreImage['file'])}}"
                                             . alt="{{__('more image')}}" class="show-img mb-2 mr-2">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <span class="m-2">----</span>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h2 class="mb-0">{{__('Statics of').' : '.$shop['name']}}</h2>
        </div>

        <div class="card-body mb-2">
            <div class="row">
                <div class="col-sm-4 mb-2">
                    <b class="text-primary">{{__('Average rates')}} : </b>
                    <span class="m-2">{{$shop->reviews->avg('rate') ?? 0}}</span>
                </div>
                <div class="col-sm-4 mb-2">
                    <b class="text-primary">{{__('total reviews')}} : </b>
                    <span class="m-2">{{$shop->reviews->whereNotNull('comment')->count()}}</span>
                </div>
                <div class="col-sm-4 mb-2">
                    <b class="text-primary">{{__('views')}} : </b>
                    <span class="m-2">{{$shop['views']}}</span>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="card mb-4">
        <div class="card-header">
            <h2 class="mb-0">{{__('Reviews of').' : '.$shop['name']}}</h2>
        </div>

        <div class="card-body mb-2" id="reviews_card">
            @forelse($reviewsList->sortBy('id') as $comment)
                <div class="card-body bg-secondary mb-3">
                    <div class="row">
                        <div class="col-sm-10 mb-2">
                            <blockquote>  {{$comment['comment']}} </blockquote>
                            &mdash;
                            <i class="text-warning mr-3 text-sm">{{optional($comment->user)['name'] ?: __('deleted user')}}</i>

                            @if($comment['rate'] != null)
                            &mdash;
                            <i class="text-primary ml-3 text-xs">
                                ( {{__('rate').' '.($comment['rate'] ?? 0) .' '.__('of') .' '. 5}} )
                            </i>
                            @endif

                            <i class="text-muted text-sm float-right" {{tooltip(custom_date($comment['updated_at']),'right')}}>
                                {{\Carbon\Carbon::parse($comment['updated_at'])->diffForHumans()}}
                            </i>
                        </div>
                        <div class="col-sm-2 mb-2 text-center">
                            @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                                        'route' => route('dashboard.v1.reviews.destroy',$comment) ,
                                        'tooltip' => __('Delete review'),
                                        'renderType'=>'hard_reload'
                                         ])
                            @endcomponent
                        </div>
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-12 text-danger">{{__('no reviews found')}}</div>
                </div>
            @endforelse
            <div class="row justify-content-center">
                <div class="col-12">
                    {{ $reviewsList->fragment('reviews_card')->links() }}
                </div>
            </div>
        </div>
    </div>--}}

    <div class="card mb-4">
        <div class="card-header">
            <h2 class="mb-0">{{__('Reviews of').' : '.$shop['name']}}</h2>
        </div>

        <div class="card-body mb-2" id="reviews_card">
            @forelse($reviewsList/*->sortBy('id')*/ as $review)
                <div class="card-body bg-secondary mb-3">
                    <div class="row">
                        <div class="col-sm-10 mb-2">
                            <blockquote>
                                {{__('rate').' '.($review['rate'] ?? 0) .' '.__('of') .' '. 5}}
                            </blockquote>
                            &mdash;
                            <i class="text-primary ml-3 text-xs">
                                {{\Carbon\Carbon::parse($review['updated_at'])->diffForHumans()}}
                            </i>
                        </div>
                        <div class="col-sm-2 mb-2 text-center">
                            @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                                        'route' => route('dashboard.v1.reviews.destroy',$review) ,
                                        'tooltip' => __('Delete review'),
                                        'renderType'=>'hard_reload'
                                         ])
                            @endcomponent
                        </div>
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-12 text-danger">{{__('no reviews found')}}</div>
                </div>
            @endforelse
            <div class="row justify-content-center">
                <div class="col-12">
                    {{ $reviewsList->fragment('reviews_card')->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h2 class="mb-0">{{__('comments of').' : '.$shop['name']}}</h2>
        </div>

        <div class="card-body mb-2" id="reviews_card">
            @forelse($commentsList->load('user')/*->sortBy('id')*/ as $comment)
                <div class="card-body bg-secondary mb-3">
                    <div class="row">
                        <div class="col-sm-10 mb-2">
                            <blockquote>  {{$comment['content']}} </blockquote>
                            &mdash;
                            <i class="text-warning mr-3 text-sm">{{optional($comment->user)['name'] ?: __('deleted user')}}</i>

                            &mdash;
                            <i class="text-primary ml-3 text-xs">
                                 {{__('status').' : '.$comment['status_value']}}
                            </i>

                            <i class="text-muted text-sm float-right" {{tooltip(custom_date($comment['updated_at']),'right')}}>
                                {{\Carbon\Carbon::parse($comment['updated_at'])->diffForHumans()}}
                            </i>
                        </div>
                        <div class="col-sm-2 mb-2 text-center">
                            @component('dashboard.v1.layouts.partials.buttons._delete_button',[
                                        'route' => route('dashboard.v1.comments.destroy',$comment) ,
                                        'tooltip' => __('Delete comment'),
                                        'renderType'=>'hard_reload'
                                         ])
                            @endcomponent
                        </div>
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-12 text-danger">{{__('no reviews found')}}</div>
                </div>
            @endforelse
            <div class="row justify-content-center">
                <div class="col-12">
                    {{ $reviewsList->fragment('reviews_card')->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
