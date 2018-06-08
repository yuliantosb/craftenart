<ul class="nav nav-sidebar">
    <li {{ $active == 'dashboard' ? 'class=active' : '' }}><a href="{{ route('user.dashboard.index') }}">Dashboard </a></li>
    <li {{ $active == 'order' ? 'class=active' : '' }}><a href="#">Order &nbsp; <span class="badge">2</span></a></li>
    <li {{ $active == 'testing' ? 'class=active' : '' }}><a href="#">Testing</a></li>
    <li {{ $active == 'wishlist' ? 'class=active' : '' }}><a href="#">Wishlist</a></li>
    <li {{ $active == 'profile' ? 'class=active' : '' }}><a href="{{ route('user.profile.index') }}">Profile</a></li>
    <li {{ $active == 'change_passwd' ? 'class=active' : '' }}><a href="#">Change Password</a></li>
    <li><a href="{{ route('logout') }}"
           onclick="event.preventDefault();
                     document.getElementById('logout-form-user').submit();"
         	>@lang('label.logout')</a>
 	</li>

 	<form id="logout-form-user" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</ul>