<?php

namespace App\Http\Middleware;

use Closure;
use App\Review;
use App\Order;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('MyNavBar', function ($menu) {

            $review_count = Review::where('status', 0)->count();
            $order_count = Order::countOrder();

            $menu->add('Dashboard', ['route' => 'admin.dashboard.index'])
                ->append('<i class="ti-panel"></i>');

            $menu->add('Page')
                ->append('<i class="ti-folder"></i>')
                ->link
                ->attr(['data-toggle' => 'collapse'])
                ->href('#page');


            $menu->page->add('All Pages', ['route' => 'admin.page.index'])
                    ->active('admin/page/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('page');

            $menu->page->add('Category', ['route' => 'admin.category.index'])
                    ->active('admin/category/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('page');

            $menu->page->add('Tag', ['route' => 'admin.tag.index'])
                    ->active('admin/tag/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('page');

            $menu->add('Post', ['route' => 'admin.post.index'])
                ->append('<i class="ti-file"></i>');

            $menu->add('Product', ['route' => 'admin.product.index'])
                    ->append('<i class="ti-package"></i>')
                    ->active('admin/product/*');

            $menu->add('Order', 'admin/order')
                ->append('<i class="ti-shopping-cart"></i>')
                ->append( $order_count > 0 ? '<label class="label label-primary" style="margin-left: 10px">'. $order_count .'</label>' : '');

            $menu->add('Review', 'admin/review')
                ->append('<i class="ti-comment"></i>')
                ->append( $review_count > 0 ? '<label class="label label-primary" style="margin-left: 10px">'.$review_count.'</label>' : '');

            $menu->add('Stock', 'admin/stock')
                ->append('<i class="ti-archive"></i>');

            $menu->add('Coupon', 'admin/coupon')
                ->append('<i class="ti-ticket"></i>');

            $menu->add('Menu', 'admin/menu')
                ->append('<i class="ti-menu"></i>');

            $menu->add('Widget', 'admin/widget')
                ->append('<i class="ti-panel"></i>');


            $menu->add('Settings')
                ->append('<i class="ti-settings"></i>')
                ->link
                ->attr(['data-toggle' => 'collapse'])
                ->href('#settings')
                ->active('admin/settings/*');

            
            $menu->settings->add('User', 'admin/user')
                    ->active('admin/user/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('settings');

            $menu->settings->add('Role', 'admin/role')
                    ->active('admin/role/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('settings');

            $menu->settings->add('Permission', 'admin/permission')
                    ->active('admin/permission/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('settings');

            $menu->settings->add('Currency', 'admin/currency')
                    ->active('admin/currency/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('settings');

            $menu->settings->add('Site Setting', 'admin/settings')
                    ->active('admin/settings/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('settings');

            
        });

        return $next($request);
    }
}
