<div class="f-widget-newsletter">
@if (!empty($config['name']))
	<h3 class="f-widget-heading {{ !empty($config['align']) ? $config['align'] : '' }}">{{ $config['name'] }}</h3>
@endif

	<form class="newsletter-form form2" action="#">
		<fieldset>
			<input type="email" class="form-control" placeholder="Your e-mail">
			<button type="submit">Subscribe</button>
		</fieldset>
	</form>
	
</div>