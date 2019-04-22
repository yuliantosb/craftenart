<div class="filter-wrap">
	<div class="row">
		<div class="col-md-3 col-sm-3">
			View as: <span><a {{ session()->get('view') == 'grid' || !session()->has('view') ? 'class=active' : '' }} href="{{ url('shop?view=grid') }}">Grid</a> / <a {{ session()->get('view') == 'list' ? 'class=active' : '' }} href="{{ url('shop?view=list') }}">List</a></span>
		</div>
		<div class="col-md-5 col-sm-5">
			Sort by:
			<select id="sort-select" class="selectBoxIt">
				<option {{ $sort_type == trans('label.a_to_z') ? 'selected=selected' : '' }} value="{{ url('shop?sort=name&type=asc') }}">@lang('label.a_to_z')</option>
				<option {{ $sort_type == trans('label.z_to_a') ? 'selected=selected' : '' }} value="{{ url('shop?sort=name&type=desc') }}">@lang('label.z_to_a')</option>
				<option {{ $sort_type == trans('label.low_to_high') ? 'selected=selected' : '' }} value="{{ url('shop?sort=price&type=asc') }}">@lang('label.low_to_high')</option>
				<option {{ $sort_type == trans('label.high_to_low') ? 'selected=selected' : '' }} value="{{ url('shop?sort=price&type=desc') }}">@lang('label.high_to_low')</option>
			</select>
		</div>
		<div class="col-md-4 col-sm-4">
			<span class="pull-right">
				Show:
				<select id="limit-select" class="selectBoxIt">
					<option value="{{ url('shop?limit=6')  }}" {{ session()->get('limit') == '6' ? 'selected=selected' : '' }}>6 items</option>
					<option value="{{ url('shop?limit=12') }}" {{ session()->get('limit') == '12' || !session()->has('limit') ? 'selected=selected' : '' }}>12 items</option>
					<option value="{{ url('shop?limit=18') }}" {{ session()->get('limit') == '18' ? 'selected=selected' : '' }}>18 items</option>
					
				</select>
			</span>
		</div>
	</div>
</div>