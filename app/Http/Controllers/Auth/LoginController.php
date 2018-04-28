<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;
use App\Customer;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)
                        ->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($data, $provider)
    {

        //DB::transaction(function() use ($data, $provider) {

            $authUser = User::where('provider_id', $data->id)->first();
            $check = User::where('email', $data->email)->first();
            
            if ($authUser || $check) {
                return $authUser;
            } else {

                $avatar = $provider == 'google' ? str_replace('?sz=50', '', $data->getAvatar()) : str_replace('type=normal', 'type=large',  $data->getAvatar());

                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->provider = $provider;
                $user->provider_id = $data->id;
                $user->password = bcrypt(str_random(16));
                $user->save();

                $customer = new Customer;
                $customer->picture = $avatar;
                $user->cust()->save($customer);

                $user->attachRole(2);

                return $user;
            }

        //});
        
    }

    public function check(Request $request)
    {

        if ($request->ajax()) {

            $user = User::where('email', $request->email);

            if ($user->count() > 0) {
                return 'false';
            } else {
                return 'true';
            }
            
        }
    }
}
