
<h2>{{ $config['name'] }}</h2>
<!-- category list start here -->
<ul class="list-unstyled category-list">
	<li>
		<a href="{{ url('shop') }}">
			<span class="name">All Categories</span>
			<span class="num">{{ App\Product::count() }}</span>
		</a>
	</li>
	@foreach ($categories as $category)
	<li>
		<a href="{{ url('shop?category='.$category->slug) }}">
			<span class="name">{{ $category->name }}</span>
			<span class="num">{{ $category->products->count() }}</span>
		</a>
	</li>
	@endforeach
</ul><!-- category list end here -->