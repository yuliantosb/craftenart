@if (!empty($config['name']))
	<h5 class="f-widget-heading {{ !empty($config['align']) ? $config['align'] : '' }}">{{ $config['name'] }}</h5>
@endif
<p>Sign up for our newsletter and promotions</p>
<form class="newsletter" action="{{ route('subscribe.save') }}" method="post" id="form-subscribe-bottom">
	@csrf
	<fieldset>
		<div class="form-group">
			<input type="email" placeholder="@lang('label.enter_your_email')" name="email">
			<span class="help-block"></span>
			<button type="submit">@lang('label.subscribe')</button>
		</div>
	</fieldset>
</form>

@push('js')
<script type="text/javascript">
	var EMAIL_INVALID = "@lang('label.email_already_subscibed')";
</script>
<script src="{{ url('frontend/'.config('app.themes').'/js/newsletter.js') }}"></script>
@endpush