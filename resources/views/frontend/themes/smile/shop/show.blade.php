@extends('frontend.themes.'.config('app.themes').'.layouts.master')

@section('title')
{{ $product->name }}
@endsection

@section('content')

<!-- BREADCRUMBS -->
<div class="bcrumbs">
	<div class="container">
		<ul>
			<li><a href="{{ url('/') }}">Home</a></li>
			<li><a href="{{ url('/shop?category='.$product->categories->first()->slug) }}">{{ $product->categories->first()->name }}</a></li>
			<li>{{ $product->name }}</li>
		</ul>
	</div>
</div>

<div class="space10"></div>

<!-- MAIN CONTENT -->
<div class="shop-single">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="row">
					<div class="col-md-5 col-sm-6">                                    
						<div class="owl-carousel prod-slider sync1">
							@foreach ($product->galleries as $gallery)
							<div class="item"> 
								<img src="{{ url('uploads/'.$gallery->picture) }}" alt="">
								<a href="{{ url('uploads/'.$gallery->picture) }}" class="caption-link"><i class="fa fa-arrows-alt"></i></a>
							</div>
							@endforeach
						</div>

						<div  class="owl-carousel sync2">
							@foreach ($product->galleries as $gallery)
								<div class="item"> <img src="{{ url('uploads/thumbs/'.$gallery->picture) }}" alt=""> </div>
							@endforeach
						</div>
					</div>
					<div class="col-md-7 col-sm-6">
						<div class="product-single">
							<div class="ps-header">
								@if (!empty($product->sale))
									<span class="badge offer">-{{ round(( ($product->price - $product->sale) / $product->price) * 100) }}%</span>
								@endif
								<h3>{{ $product->name }}</h3>
								<div class="ratings-wrap">
									<span class="inline-rating">{!! Helper::getRate($product->reviews->avg('rate')) !!}</span>
									<em>({{ $product->reviews->count() }} reviews)</em>
								</div>
								@if (!empty($product->sale))
									<div class="ps-price"><span>{{ Helper::currency($product->price) }}</span> {{ Helper::currency($product->sale) }}</div>
								@else
									<div class="ps-price">{{ Helper::currency($product->price) }}</div>
								@endif
							</div>
							{!! $product->description !!}
							
							@if (app()->isLocale('en') && empty($product->description_en))

							<p class="text-muted"><small><em>*) @lang('label.description_not_available_in') English</em></small></p>

							@elseif (app()->isLocale('id') && empty($product->description_id))

							<p class="text-muted"><small><em>*) @lang('label.description_not_available_in') Bahasa Indonesia</em></small></p>

							@endif

							<div class="ps-stock">
								@if ($product->stock->amount <= 0)
								<p class="text-danger">@lang('label.this_product_out_of_stock')</p>
								@endif

								<p class="text-primary">@lang('label.available_stock') : <a href="#">{{ $product->stock->amount }}</a></p>
								
								<p>@lang('label.tags')</p>
								<ul class="tags">
									@foreach ($product->tags as $tag)
										<li><a href="{{ url('shop?tags%5B%5D='.$tag->slug) }}">{{ $tag->name }}</a></li>
									@endforeach
								</ul>

							</div>
							<form action="{{ route('cart.store') }}" class="product-form" method="post" id="product-form">
							@csrf
								<input type="text" name="id" value="{{ $product->id }}" hidden="hidden">
								<div class="sep"></div>
								<div class="row select-wraps">
									<div class="col-md-4 col-sm-4">
										<p>Quantity<span>*</span></p>
										<select name="qty" class="selectBoxIt">
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
										</select>
									</div>
									@if ($product->attributes->count() > 0)
										@foreach ($product->attributes as $attribute)
										<div class="col-md-4 col-sm-4">
										<p>{{ $attribute->name }}</p>
										<input type="text" name="attribute_name[]" value="{{ $attribute->name }}" hidden="hidden">
										<select name="attribute_value[]" class="selectBoxIt">
											@foreach (json_decode($attribute->value) as $value)
												<option value="{{ $value }}">{{ $value }}</option>
											@endforeach
										</select>

										</div>
										@endforeach
									@endif
							</div>
							</form>
							<div class="space20"></div>
							{!! Share::page(route('shop.show', $product->slug), $product->name, [], '<div class="share">', '</div>')->facebook()->whatsapp()->twitter() !!}
							<div class="share">
								<span>
								@if (auth()->check())
									@if (in_array($product->id, auth()->user()->wishlist->pluck('product_id')->toArray()))

									<a data-toggle="tooltip" title="@lang('label.you_like_this')" class="likeitem fa fa-heart-o active"></a>

									@else
									<a href="javascript:void(0)" onclick="document.getElementById('single-wishlist-{{ $product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
									@endif

								@else
								<a href="javascript:void(0)" onclick="document.getElementById('single-wishlist-{{ $product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
								@endif
								</span>
								<div class="addthis_native_toolbox"></div>
							</div>
							<div class="space20"></div>
							<div class="sep"></div>
							<a class="addtobag" href="javascript:void(0)" onclick="document.getElementById('product-form').submit()">Add to Bag</a>
							
							<form style="display: none" action="{{ route('wishlist.store') }}" method="post" id="single-wishlist-{{ $product->id }}">
								@csrf
								<input type="text" name="product_id" value="{{ $product->id }}" hidden="hidden">
							</form>
						</div>
					</div>
				</div>
				<div class="clearfix space40"></div>

				<h5 class="heading space40"><span>@lang('label.review')</span></h5>

				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">@lang('label.description')</a></li>
						<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">@lang('label.reviews') ({{ count($product->reviews) }})</a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="home">
							{!! $product->description !!}
						</div>
						<div role="tabpanel" class="tab-pane" id="profile">
							<div class="reviews-tab">
								@if (session()->has('review'))
								<div class="alert alert-{{ session()->get('review')['type'] }} alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>{{ session()->get('review')['title'] }}</strong> {{ session()->get('review')['message'] }}
								</div>

								@endif

								@foreach ($product->reviews as $review)
								<p><b>{{ $review->user->name }}</b>, {{ Carbon\Carbon::parse($review->created_at)->format('F jS, Y') }}</p>
								<p>{{ $review->content }}</p>
								{!! Helper::getRate($review->rate) !!}
								<div class="sep"></div>
								@endforeach
								
								@if (auth()->check())

									@if (in_array(auth()->user()->id, $product->reviews->pluck('user_id')->toArray()))

										<h5>Your Review</h5>
										<blockquote>
											<p>{{ $product->reviews->where('user_id', auth()->user()->id)->first()->content }}</p>
											<small style="font-size:10px">{{ Carbon\Carbon::parse($product->reviews->where('user_id', auth()->user()->id)->first()->created_at)->format('F jS, Y') }}</small style="font-size:10px">
										</blockquote>

									@else

									<form action="{{ route('review.store') }}" class="p-commentform" method="post">
									@csrf
									<fieldset>
										<h5>@lang('label.add_review')</h5>
										<input type="text" name="product_id" value="{{ $product->id }}" hidden="hidden">
										<div class="form-group">
											<label>@lang('label.rate')</label>
											<fieldset class="rating text-left">
											    <input type="radio" id="star5" name="rate" value="5" /><label class = "full" for="star5" title="@lang('label.awesome') - 5 stars"></label>
											    <input type="radio" id="star4" name="rate" value="4" /><label class = "full" for="star4" title="@lang('label.pretty_good') - 4 stars"></label>
											    <input type="radio" id="star3" name="rate" value="3" /><label class = "full" for="star3" title="@lang('label.meh') - 3 stars"></label>
											    <input type="radio" id="star2" name="rate" value="2" /><label class = "full" for="star2" title="@lang('label.kinda_bad') - 2 stars"></label>
											    <input type="radio" id="star1" name="rate" value="1" /><label class = "full" for="star1" title="@lang('label.big_suck_time') - 1 star"></label>
											</fieldset>
										</div>
										<div class="clearfix space20"></div>
										<div class="form-group">
											<label>@lang('label.review')</label>
											<textarea name="content"></textarea>
										</div>
										<button type="submit" class="btn-black">@lang('label.add_review')</button>
									</fieldset>
								</form>

									@endif

								@else

								<h3>@lang('label.you_must_sign_in_review')</h3>

								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix space40"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<h5 class="heading space40"><span>@lang('label.related_product')</span></h5>
						<div class="product-carousel3">
							@foreach ($relateds as $product)
							<div class="pc-wrap">
								<div class="product-item">

								<div class="product-item">
									<div class="item-thumb">
										@if (!empty($product->sale))
										<span class="badge offer">-{{ round(( ($product->price - $product->sale) / $product->price) * 100) }}%</span>
										@endif

										<img src="{{ url('uploads/'.$product->picture) }}" class="img-responsive" alt="{{ $product->name }}"/>
										<div class="overlay-rmore fa fa-search quickview" onclick="onView({{ $product->id }})"></div>
										<div class="product-overlay">
											<form style="display: none" action="{{ route('cart.store') }}" method="post" id="new-product-{{ $product->id }}">
											@csrf
											<input type="text" name="id" value="{{ $product->id }}" hidden="hidden">
											</form>

											<form style="display: none" action="{{ route('wishlist.store') }}" method="post" id="new-product-wishlist-{{ $product->id }}">
												@csrf
												<input type="text" name="product_id" value="{{ $product->id }}" hidden="hidden">
											</form>
											{!! Share::page(route('shop.show', $product->slug), $product->name)->facebook()->whatsapp()->twitter() !!}
											<a href="javascript:void(0)" onclick="document.getElementById('new-product-{{ $product->id }}').submit()" class="addcart fa fa-shopping-cart"></a>
											
											@if (auth()->check())

												@if (in_array($product->id, auth()->user()->wishlist->pluck('product_id')->toArray()))

												<a data-toggle="tooltip" title="@lang('label.you_like_this')" class="likeitem fa fa-heart-o active"></a>


												@else
												<a href="javascript:void(0)" onclick="document.getElementById('new-product-wishlist-{{ $product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
												@endif

											@else
												<a href="javascript:void(0)" onclick="document.getElementById('new-product-wishlist-{{ $product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
											@endif

										</div>
									</div>
									<div class="product-info">
										<h4 class="product-title"><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></h4>
										@if (!empty($product->sale))
										<span class="product-price"><sup class="text-muted"><s>{{ Helper::currency($product->price) }}</s></sup> {{ Helper::currency($product->sale) }}</span>
										@else
										<span class="product-price">{{ Helper::currency($product->price) }}</span>
										@endif
									</div>
									<div class="text-center">
										{!! Helper::getRate($product->reviews->avg('rate')) !!} 
									</div>
								</div>
							</div>
						</div>
						@endforeach

						</div>
					</div>
				</div>
				<div class="clearfix space20"></div>
			</div>
		</div>
	</div>
</div>


@endsection

@if (session()->has('message'))

@push('js')
<script type="text/javascript">
    show_notification('<b>Success</b>','success', "{{ session()->get('message') }}");
</script>
@endpush

@endif