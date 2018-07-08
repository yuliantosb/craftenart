
<ul>
	@foreach (App\Menu::getMenu() as $menu)
	<li {{ $menu->is_mega ? 'class=drop' : '' }}>


		<a onclick="window.location = '{{ $menu->url }}'" href="{{ $menu->url }}">
		{{ $menu->name }}
		@if (count($menu->child) > 0)
		<i class="fa fa-angle-down" aria-hidden="true"></i>
		@endif
		</a>

		@if (count($menu->child) > 0)

			@if ($menu->is_mega)

			
				<div class="mt-dropmenu text-left">
					<!-- mt frame start here -->
					<div class="mt-frame">
						<!-- mt f box start here -->
						<div class="mt-f-box">

							@foreach ($menu->child as $child)
							<!-- mt col3 start here -->
							<div class="mt-col-3 {{ $child->widget->type == 'hyper_text' ? 'promo' : '' }}">

								@widget($child->widget->type, [
									'count' => $child->widget->limit,
									'name' => $child->name,
									'widget' => $child->widget,
									'children' => $child->child
								])

							</div>

							@endforeach
							
						</div>
						<!-- mt f box end here -->
					</div>
					<!-- mt frame end here -->
				</div>
				<span class="mt-mdropover"></span>

			@else

			<div class="s-drop">
				<ul>
					@foreach ($menu->child as $child)
					<li><a href="{{ $child->url }}">{{ $child->name }}</a></li>
					@endforeach
				</ul>
			</div>

			@endif

		@endif

	</li>
	@endforeach
</ul>