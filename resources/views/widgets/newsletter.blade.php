<div class="f-widget-newsletter">
@if (!empty($config['name']))
	<h3 class="f-widget-heading {{ !empty($config['align']) ? $config['align'] : '' }}">{{ $config['name'] }}</h3>
@endif

	<form class="newsletter-form form2" action="{{ route('subscribe.save') }}" method="post" id="form-subscribe-bottom">
		@csrf
		<fieldset>
			<div class="form-group">
				<input type="email" class="form-control" placeholder="@lang('label.enter_your_email')" name="email">
				<button type="submit">@lang('label.subscribe')</button>
				<span class="help-block"></span>
			</div>
		</fieldset>
	</form>
	
</div>

@push('js')
<script type="text/javascript">
	var EMAIL_INVALID = "@lang('label.email_already_subscibed')";
</script>
<script src="{{ url('frontend/js/newsletter.js') }}"></script>
@endpush