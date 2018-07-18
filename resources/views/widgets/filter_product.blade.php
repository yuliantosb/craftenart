
<h2>{{ $config['name'] }}</h2>

<form action="{{ url('shop') }}" method="get">
	<span class="sub-title">{{ $config['subtitle_one'] }}</span>
	@if (!empty(request()->category))
	<input type="text" name="category" value="{{ request()->category }}" hidden="hidden">
	@endif
	<!-- nice-form start here -->
	<ul class="list-unstyled nice-form">
		@foreach ($tags as $tag)
		<li>
			<label for="check-{{ $tag->id }}">
				<input id="check-{{ $tag->id }}" type="checkbox" value="{{ $tag->slug }}" name="tags[]" {{ !empty(request()->tags) ? in_array($tag->slug, request()->tags) ? 'checked=checked' : '' : ''  }}>
				<span class="fake-input"></span>
				<span class="fake-label">{{ $tag->name }}</span>
			</label>
			<span class="num">{{ $tag->products->count() }}</span>
		</li>
		@endforeach
	</ul><!-- nice-form end here -->

	<span class="sub-title">{{ $config['subtitle_two'] }}</span>
	<div class="price-range">
		
		<div class="form-group">
			<input type="text" class="span2 slider" value="" data-slider-min="{{ $min }}" data-slider-max="{{ $max }}" data-slider-step="{{ session()->get('currency') == 'idr' ? 10000 : 1 }}" data-slider-value="[{{ !empty(request()->price_range) ? explode(',', request()->price_range)[0] : $min }},{{ !empty(request()->price_range) ? explode(',', request()->price_range)[1] : $max }}]" name="price_range" data-slider-tooltip="show">
		</div>
		
		<span class="price">@lang('label.price') &nbsp;   {{ Helper::takeCurrency()->symbol }} 
			<span id="range-from">
				{{ number_format(!empty(request()->price_range) ? explode(',', request()->price_range)[0] : $min, 0, Helper::takeCurrency()->decimal_separator, Helper::takeCurrency()->thousand_separator) }}
			</span>  &nbsp;  -  &nbsp;   {{ Helper::takeCurrency()->symbol }} 

			<span id="range-to">
				{{ number_format(!empty(request()->price_range) ? explode(',', request()->price_range)[1] : $max, 0, Helper::takeCurrency()->decimal_separator, Helper::takeCurrency()->thousand_separator) }}
			</span>
		</span>
		<button type="submit" class="filter-btn" style="border: none; margin-top: 20px">@lang('label.filter')</button>
	</div>
</form>

@push('js')
<script type="text/javascript">
	var thousand_separator = '{{ Helper::takeCurrency()->thousand_separator }}';
	var decimal_separator = '{{ Helper::takeCurrency()->decimal_separator }}';
</script>
@endpush