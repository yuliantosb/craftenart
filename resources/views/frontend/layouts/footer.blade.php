<!-- Footer Holder of the Page -->
<div class="footer-holder dark">
	<div class="container">
		<div class="row">

			@foreach (App\Setting::getSetting('footer') as $footer)
			<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
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
</div>
<!-- Footer Holder of the Page end -->
<!-- Footer Area of the Page -->
<div class="footer-area">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				{!! App\Setting::getSetting('left_footer')->text !!}
			</div>
			<div class="col-xs-12 col-sm-6 text-right">
				{!! App\Setting::getSetting('right_footer')->text !!}
			</div>
		</div>
	</div>
</div>
<!-- Footer Area of the Page end -->