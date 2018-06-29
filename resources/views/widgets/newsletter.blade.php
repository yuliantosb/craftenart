<div class="f-widget-newsletter">
@if (!empty($config['name']))
	<h3 class="f-widget-heading {{ !empty($config['align']) ? $config['align'] : '' }}">{{ $config['name'] }}</h3>
@endif

	<form class="newsletter-form form2" action="{{ route('subscribe.save') }}" method="post" id="form-subscribe-bottom">
		@csrf
		<fieldset>
			<div class="form-group">
				<input type="email" class="form-control" placeholder="Your e-mail" name="email">
				<button type="submit">Subscribe</button>
				<span class="help-block"></span>
			</div>
		</fieldset>
	</form>
	
</div>

@push('js')
<script src="{{ url('frontend/js/newsletter.js') }}"></script>
@endpush