<footer>
	<div class="container">
		<div class="row">
			@foreach (App\Setting::getSetting('footer') as $footer)
			<div class="col-md-3 col-sm-3 widget-footer">
				@php($widget = App\Widget::find($footer->widget_id))
				@widget($widget->type, [
					'widget' => $widget,
					'count' => $widget->limit,
					'name' => $footer->title,
					'align' => $footer->align
				])
			</div>
			@endforeach
		</div>
	</div>
</footer>
<!-- Footer Holder of the Page end -->
<!-- Footer Area of the Page -->
<div class="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-sm-7">
				{!! !empty(App\Setting::getSetting('left_footer')->text) ? str_replace_array('[url]', [url('/')], App\Setting::getSetting('left_footer')->text) : '' !!}
			</div>
			<div class="col-md-5 col-sm-5">
				{!! !empty(App\Setting::getSetting('right_footer')->text) ? str_replace_array('[url]', [url('/')], App\Setting::getSetting('right_footer')->text) : '' !!}
			</div>
		</div>
	</div>
</div>	
<!-- Footer Area of the Page end -->