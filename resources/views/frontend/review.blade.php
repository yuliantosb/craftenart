@extends('frontend.layouts.master')

@section('title', 'Review')

@section('content')

<main id="mt-main">
	<section class="mt-about-sec" style="padding-bottom: 0;">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="txt">
            
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-detail-sec toppadding-zero">

        <div class="container">
            <div class="row">

                <div class="col-sm-3 col-md-2 sidebar">
                  @include('frontend.layouts.user_sidebar', ['active' => 'review'])
                </div>

                <div class="col-sm-9 col-md-10">
                    <div class="row">
                        <div class="col-md-12 product-comment">
                            @foreach ($reviews as $review)

                            <div class="mt-box">
                                <div class="mt-hold">

                                    <div class="col-md-2 text-center">
                                        <img src="{{ url('uploads/thumbs/'.$review->product->picture) }}" style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>

                                    <div class="col-md-10">
                                        {!! Helper::getRate($review->rate, ['class' => 'mt-star']) !!}
                                        <span class="name">{{ $review->product->name }}</span>
                                        <time>{{ Carbon\Carbon::parse($review->crated_at)->format('F jS, Y') }}</time>
                                        <p style="margin: 10px 0px">{{ $review->content }}</p>
                                    </div>
                                </div>
                            </div>
                               

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection