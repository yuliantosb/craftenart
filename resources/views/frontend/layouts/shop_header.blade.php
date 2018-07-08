<header class="mt-shoplist-header">
	<!-- btn-box start here -->
	<div class="btn-box">
		<ul class="list-inline">
			<li>
				<a href="#" class="drop-link">
					{{ $sort_type }} <i aria-hidden="true" class="fa fa-angle-down"></i>
				</a>
				<div class="drop">
					<ul class="list-unstyled">
						<li><a href="{{ url('shop?sort=name&type=asc') }}">@lang('label.a_to_z')</a></li>
						<li><a href="{{ url('shop?sort=name&type=desc') }}">@lang('label.z_to_a')</a></li>
						<li><a href="{{ url('shop?sort=price&type=asc') }}">@lang('label.low_to_high')</a></li>
						<li><a href="{{ url('shop?sort=price&type=desc') }}">@lang('label.high_to_low')</a></li>
					</ul>
				</div>
			</li>
			<li {{ session()->get('view') == 'grid' || !session()->has('view') ? 'class=active' : '' }}>
				<a class="mt-viewswitcher" href="{{ url('shop?view=grid') }}" data-toggle="tooltip" title="@lang('label.grid_view')"><i class="fa fa-th-large" aria-hidden="true"></i></a>
			</li>
			<li {{ session()->get('view') == 'list' ? 'class=active' : '' }}>
				<a class="mt-viewswitcher" href="{{ url('shop?view=list') }}" data-toggle="tooltip" title="@lang('label.list_view')"><i class="fa fa-th-list" aria-hidden="true"></i></a>
			</li>
		</ul>
	</div><!-- btn-box end here -->
	<!-- mt-textbox start here -->
	<div class="mt-textbox">
		<p>@lang('label.showing')  <strong>{{ $products->currentPage() }}–{{ $products->count() }}</strong> @lang('label.of')  <strong>{{ $products->total() }}</strong> @lang('label.result')</p>

		<p>View   
			<a href="{{ url('shop?limit=6') }}" {{ session()->get('limit') == '6' ? 'class=active' : '' }}>6</a> / 
			<a href="{{ url('shop?limit=12') }}" {{ session()->get('limit') == '12' || !session()->has('limit') ? 'class=active' : '' }}>12</a> / 
			<a href="{{ url('shop?limit=18') }}" {{ session()->get('limit') == '18' ? 'class=active' : '' }}>18</a> /
		</p>

	</div><!-- mt-textbox end here -->
</header><!-- mt shoplist header end here -->