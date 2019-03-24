<ul class="nav nav-sidebar">
    <li {{ $active == 'dashboard' ? 'class=active' : '' }}><a href="{{ route('user.dashboard.index') }}">@lang('label.dashboard') </a></li>
    <li {{ $active == 'order' ? 'class=active' : '' }}><a href="{{ route('user.order.index') }}">@lang('label.order') &nbsp; <span class="badge"></span></a></li>
    <li {{ $active == 'testing' ? 'class=active' : '' }}><a href="{{ route('user.testing.index') }}">Testing</a></li>
    <li {{ $active == 'review' ? 'class=active' : '' }}><a href="{{ route('user.review.index') }}">@lang('label.review')</a></li>
    <li {{ $active == 'wishlist' ? 'class=active' : '' }}><a href="{{ route('user.wishlist.index') }}">@lang('label.wishlist')</a></li>
    <li {{ $active == 'profile' ? 'class=active' : '' }}><a href="{{ route('user.profile.index') }}">@lang('label.profile')</a></li>
    <li {{ $active == 'change_passwd' ? 'class=active' : '' }}><a href="{{ route('user.password.edit') }}">@lang('label.change_password')</a></li>
    <li><a href="{{ route('logout') }}"
           onclick="event.preventDefault();
                     document.getElementById('logout-form-user').submit();"
         	>@lang('label.logout')</a>
 	</li>

 	<form id="logout-form-user" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</ul>