<li id="menuItem_{{ $menu->id }}">
    <div>
		<span data-id="{{ $menu->id }}">{{ $menu->name }}</span>
		<span class="right-toggle">
			<button class="btn btn-link btn-xs text-success" onclick="on_edit({{ $menu->id }})"><i class="fa fa-pencil"></i></button>
			<button class="btn btn-link btn-xs text-danger" onclick="on_delete({{ $menu->id }})"><i class="fa fa-times"></i></button>
		</span>
	</div>
	@if (count($menu->child) > 0)
	<ol>
		@foreach($menu->child as $menu)
			@include('backend.menu.partial', $menu)
		@endforeach
	</ol>
	@endif
</li>