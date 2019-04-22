
<form action="{{ url('shop') }}" method="get">
	<h5>{{ $config['name'] }}</h5>
	<div class="row col-xs-12">
		<button class="btn-black pull-left" type="submit">Filter Now</button>
	</div>
	<div class="clearfix space20"></div>
	<div class="clearfix">
		<div class="price-range">
			
			<div class="form-group">
				<input type="text" class="span2 slider" value="" data-slider-min="{{ $min }}" data-slider-max="{{ $max }}" data-slider-step="{{ session()->get('currency') == 'idr' ? 10000 : 1 }}" data-slider-value="[{{ !empty(request()->price_range) ? explode(',', request()->price_range)[0] : $min }},{{ !empty(request()->price_range) ? explode(',', request()->price_range)[1] : $max }}]" name="price_range" data-slider-tooltip="hide">
			</div>
			
			<span class="price">@lang('label.price') &nbsp;  <strong> {{ Helper::takeCurrency()->symbol }} 
					<span id="range-from">
						{{ number_format(!empty(request()->price_range) ? explode(',', request()->price_range)[0] : $min, 0, Helper::takeCurrency()->decimal_separator, Helper::takeCurrency()->thousand_separator) }}
					</span>  &nbsp;  -  &nbsp;   {{ Helper::takeCurrency()->symbol }} 

					<span id="range-to">
						{{ number_format(!empty(request()->price_range) ? explode(',', request()->price_range)[1] : $max, 0, Helper::takeCurrency()->decimal_separator, Helper::takeCurrency()->thousand_separator) }}
					</span>
				</strong>
			</span>
		</div>
	</div>
</form>

@push('js')
<script type="text/javascript">
	var thousand_separator = '{{ Helper::takeCurrency()->thousand_separator }}';
	var decimal_separator = '{{ Helper::takeCurrency()->decimal_separator }}';
</script>
@endpush