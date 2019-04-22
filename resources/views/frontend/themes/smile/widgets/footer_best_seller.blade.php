@if (!empty($config['name']))
<h5 class="f-widget-heading {{ !empty($config['align']) ? $config['align'] : '' }}">{{ $config['name'] }}</h5>
@endif

@if (!empty($products))
<div class="footer-best-seller">
    <ul>
        @foreach ($products as $product)
        <li>
            <div class="fw-thumb">
                <img src="{{ url('uploads/thumbs/'.$product->picture) }}" alt="{{ $product->name }}">
            </div>
            <div class="fw-info">
                <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                {!! Helper::getRate($product->reviews->avg('rate')) !!}
                @if (!empty($product->sale))
                    <del class="text-muted">{{ Helper::currency($product->price) }}</del>
                    <span>{{ Helper::currency($product->sale) }}</span>
                @else
                    <span>{{ Helper::currency($product->price) }}</span>
                @endif
            </div>
        </li>
        @endforeach
    </ul>
</div>
@else
<div>No products found</div>
@endif