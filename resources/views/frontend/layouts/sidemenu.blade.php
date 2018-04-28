<!-- mt holder start here -->
<div class="mt-holder">
	@if (auth()->check())
	<a href="#" class="side-close"><span></span><span></span></a>
	<strong class="mt-side-title" style="text-transform: none; size: 1em">Howdy {{ auth()->user()->name }}!</strong>
	<!-- mt side widget start here -->
	<div class="mt-side-widget">
		<div class="profile-picture">
			<img src="{{ auth()->user()->cust->picture }}" class="img img-circle">
		</div>
		<hr>
		<div class="mt-side-widget">
			<nav class="mt-side-nav">
				<ul>
					<li><a href="homepage1.html" class="drop-link"><i class="fa fa-home"></i>Dashbord</a></li>
					<li><a href="homepage1.html" class="drop-link"><i class="fa fa-shopping-cart"></i>Order History</a></li>
					<li><a href="homepage1.html" class="drop-link"><i class="fa fa-heart"></i>Wishlist</a></li>
					<li><a href="homepage1.html" class="drop-link"><i class="fa fa-cog"></i>Account Settings</a></li>
					<li>
						<a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"
                         	class="drop-link"><i class="fa fa-sign-out"></i>Log Out</a>
                 	</li>

                 	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    
				</ul>
			</nav>
		</div>
	</div>
	@else
	<!-- mt holder start here -->
	<div class="mt-holder">
		<a href="#" class="side-close"><span></span><span></span></a>
		<strong class="mt-side-title">MY ACCOUNT</strong>
		<!-- mt side widget start here -->
		<div class="mt-side-widget">
			<header>
				<span class="mt-side-subtitle">SIGN IN</span>
				<p>Welcome back! Sign in to Your Account</p>
			</header>
			 <form action="{{ route('login') }}" method="post">
              @csrf
                <fieldset>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" placeholder="Email Address" class="input" name="email">
                    @if ($errors->has('email'))
                      <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" placeholder="Password" class="input" name="password">
                    @if ($errors->has('password'))
                      <span class="help-block text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                  </div>


                  <div class="box">
                    <span class="left"><input class="checkbox" type="checkbox" name="remember" id="check2" {{ old('remember') ? 'checked' : '' }} ><label for="check2">Remember Me</label></span>
                    <a href="{{ route('password.request') }}" class="help">Forgot Password?</a>
                  </div>
                  <button type="submit" class="btn-type1">Login</button>
                </fieldset>
            </form>
		</div>
		<!-- mt side widget end here -->
		<div class="or-divider"><span class="txt">or</span></div>

		<!-- mt side widget start here -->
		<div class="mt-side-widget">

			<header>
                <span class="mt-side-subtitle">Don't have account yet?</span>
                <p>Register Here</p>
                </header>

                <form action="{{ route('register') }}" method="post" id="form-register-sidemenu">
                  @csrf
                    <fieldset>

                      <div class="form-group">
                        <input type="text" placeholder="Fullname" class="input" name="name" required="required">
                        <span class="help-block"></span>
                      </div>


                      <div class="form-group">
                        <input type="text" placeholder="Email" class="input" name="email" required="required">
                        <span class="help-block"></span>
                      </div>

                      <div class="form-group">
                        <input type="password" placeholder="Password" class="input" name="password" required="required" minlength="6">
                        <span class="help-block"></span>
                      </div>

                      <div class="form-group">
                        <input type="password" placeholder="Re-type Password" class="input" name="password_confirmation" required="required">
                        <span class="help-block"></span>
                      </div>

                      <button type="submit" class="btn-type1">Register</button>
                      <hr>
                      <div class="text-center">
                        <p style="margin-bottom: 20px">Or <br> Login using social account</p>
                        <fieldset class="text-center m-t-10">
                            <a class="btn-type1" style="background-color: #d34836" href="{{ route('login.provider', 'google') }}"><i class="fa fa-google-plus" style="margin-right: 5px"></i> Google</a>
                            <a class="btn-type1" style="background-color: #3B5998" href="{{ route('login.provider', 'facebook') }}"><i class="fa fa-facebook" style="margin-right: 5px"></i> Facebook</a>
                          </fieldset>

                      </div>

                    </fieldset>
                </form>

		</div>
		<!-- mt side widget end here -->
	</div>
	<!-- mt holder end here -->
	@endif
</div>
<!-- mt holder end here -->