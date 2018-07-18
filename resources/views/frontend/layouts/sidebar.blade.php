<!-- sidebar of the Page start here -->
<aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
	<!-- shop-widget filter-widget of the Page start here -->
	<section class="shop-widget filter-widget bg-grey">
		@widget('filter_product', ['name' => trans('label.filter'), 'subtitle_one' => trans('label.filter_by_tag'), 'subtitle_two' => trans('label.filter_by_price')])
	</section><!-- shop-widget filter-widget of the Page end here -->
	<!-- shop-widget of the Page start here -->
	<section class="shop-widget">
		@widget('categories_list', ['count' => 10, 'name' => trans('label.categories')])
	</section><!-- shop-widget of the Page end here -->
	<!-- shop-widget of the Page start here -->
	<section class="shop-widget">
		@widget('hot_sale', ['count' => 10, 'name' => trans('label.hot_sale')])
	</section><!-- shop-widget of the Page end here -->
</aside><!-- sidebar of the Page end here -->