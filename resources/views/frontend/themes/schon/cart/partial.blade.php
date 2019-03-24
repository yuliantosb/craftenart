<table class="table table-primary">
	<thead>
		<tr>
			<th>@lang('label.courier_name')</th>
			<th>@lang('label.service_name')</th>
			<th>@lang('label.cost')</th>
			<th style="width: 50px"></th>
		</tr>
	</thead>

	<tbody>
		@php($i = 0)
		@foreach ($costs as $couriers)
			@foreach ($couriers as $courier)
				<tr>
					<th rowspan="{{ count($courier->costs) }}">{{ $courier->name }}</th>
					@foreach ($courier->costs as $cost)
					<td>{{ $cost->service }} <br> {{ $cost->description }}</td>
					<td>
						@foreach ($cost->cost as $details)
							<strong>{{ Helper::currency(Helper::setCurrency($details->value, 'idr')) }}</strong> <br> 
							<span class="text-muted"> {{ $details->etd }} @lang('label.day')(s) </span>

							<input type="text" name="courier_id[{{ $i }}]" value="{{ $courier->code }}" hidden="hidden">
							<input type="text" name="courier_name[{{ $i }}]" value="{{ $courier->name }}" hidden="hidden">
							<input type="text" name="cost[{{ $i }}]" value="{{ Helper::setCurrency($details->value, 'idr') }}" hidden="hidden">
							<input type="text" name="service_name[{{ $i }}]" value="{{ $cost->service }}" hidden="hidden">
							<input type="text" name="service_description[{{ $i }}]" value="{{ $cost->description }}" hidden="hidden">
							<input type="text" name="estimate_delivery[{{ $i }}]" value="{{ $details->etd }}" hidden="hidden">

						@endforeach

					</td>

					<td class="text-center" style="vertical-align: middle;">
						
						<label class="container-radio">
						 	<input type="radio" name="fee" value="{{ $i++ }}" {{ $cost->service == session()->get('shipping.service_name') && $courier->code == session()->get('shipping.courier_id') ? 'checked=checked' : '' }}>
						  <span class="checkmark"></span>
						</label>
					</td>

					</tr>
					<tr>
					@endforeach
				</tr>
			@endforeach
		@endforeach

		<input type="text" name="total_weight" value="{{ $total_weight }}" hidden="hidden">

	</tbody>
</table>