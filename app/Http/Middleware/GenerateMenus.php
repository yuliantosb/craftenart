<?php

namespace App\Http\Middleware;

use Closure;

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
            $menu->add('Dashboard', ['route' => 'admin.dashboard.index'])
                ->append('<i class="ti-panel"></i>');

            $menu->add('Product')
                    ->append('<i class="ti-package"></i>')
                    ->link
                    ->attr(['data-toggle' => 'collapse'])
                    ->href('#product')
                    ->active('admin/product/*');

            $menu->product->add('All Product', ['route' => 'admin.product.index'])
                    ->active('admin/product/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('product');

            $menu->product->add('Category', ['route' => 'admin.category.index'])
                    ->active('admin/category/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('product');

            $menu->product->add('Tag', ['route' => 'admin.tag.index'])
                    ->active('admin/tag/*')
                    ->append('</span>')
                    ->prepend('<span class="sidebar-normal"> ')
                    ->nickname('product');

            $menu->add('Order', 'admin/order')
                ->append('<i class="ti-shopping-cart"></i>')
                ->append('<label class="label label-primary" style="margin-left: 10px">2</label>');

            $menu->add('Review', 'admin/review')
                ->append('<i class="ti-comment"></i>')
                ->append('<label class="label label-primary" style="margin-left: 10px">2</label>');

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
