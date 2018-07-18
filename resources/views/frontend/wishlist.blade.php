@extends('frontend.layouts.master')

@section('title', 'Wishlist')

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
                  @include('frontend.layouts.user_sidebar', ['active' => 'wishlist'])
                </div>

                <div class="col-sm-9 col-md-10">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>@lang('label.wishlist')</h2>
                            <hr>
                            <table class="table table-wishlist">
                                <tbody>
                                    @if (count($wishlists) > 0)
                                    @foreach ($wishlists as $wishlist)
                                        <tr>
                                            <td>
                                                <img src="{{ url('uploads/thumbs/'.$wishlist->product->picture) }}" class="img img-circle" style="width: 200px">
                                            </td>
                                            <td><h1>{!! $wishlist->product->price_amount !!}</h1></td>

                                            <form action="{{ route('cart.store') }}" class="product-form" method="post">
                                                <td>
                                                    <input type="number" placeholder="1" name="qty" value="1" class="mt-number" min="1" max="{{ $wishlist->product->stock->amount }}">
                                                </td>
                                                <td>

                                                @csrf
                                                <input type="text" name="id" value="{{ $wishlist->product_id }}" hidden="hidden">
                                                    
                                                        <button class="btn btn-custom-primary" type="submit">@lang('label.add_to_cart')</button>
                                                    
                                                    </form>
                                                    
                                                <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="post" style="display: inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-custom-secondary" type="submit">@lang('label.remove')</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center">
                                            @lang('label.no_wishlists_yet')
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection