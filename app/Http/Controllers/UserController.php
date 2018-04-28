<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;
use App\Role;
use DB;
use RajaOngkir;
use Gravatar;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::paginate(5);
    	return view('backend.user.index', compact(['users']));
    }

    public function create()
    {
    	$roles = Role::get();
    	$provinces = RajaOngkir::getProvince();
    	return view('backend.user.create', compact(['roles', 'provinces']));
    }

    public function show($id)
    {
    	$provinces = RajaOngkir::getProvince();
    	dd($provinces);
    }

    public function store(Request $request)
    {
        DB::transaction(function() use ($request){

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $customer = new Customer;
            $customer->picture = !empty($request->feature_image) ? url('uploads/thumbs/'.$request->feature_image) : Gravatar::get($request->email);
            $customer->identity_number = $request->identity_number;
            $customer->phone_number = $request->phone_no;
            $customer->country_id = $request->country_id;
            $customer->province_id = $request->province_id;
            $customer->city_id = $request->city_id;
            $customer->place_of_birth = $request->place_of_birth;
            $customer->date_of_birth = $request->date_of_birth;
            $customer->sex = $request->sex;
            $customer->zip = $request->zip;
            $user->cust()->save($customer);

            $user->roles()->sync($request->role_id);


        });

        return redirect()
                ->route('admin.user.index')
                ->with('message', 'Date saved successfully!');
    }
}
