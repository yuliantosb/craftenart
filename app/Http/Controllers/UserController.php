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
    	$user = User::find($id);

        return view('backend.user.show', compact(['user']));
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
            $customer->address = $request->address;
            $user->cust()->save($customer);

            $user->roles()->sync($request->role_id);


        });

        return redirect()
                ->route('admin.user.index')
                ->with('message', 'Date saved successfully!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::get();
        $provinces = RajaOngkir::getProvince();
        $cities = RajaOngkir::getCity($user->cust->province_id);

        return view('backend.user.edit', compact(['roles', 'provinces', 'user', 'cities']));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id){

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            $user->cust()->delete();

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
            $customer->address = $request->address;
            $user->cust()->save($customer);

            $user->roles()->sync($request->role_id);


        });

        return redirect()
                ->route('admin.user.index')
                ->with('message', 'Date updated successfully!');
    }

    public function check(Request $request)
    {
        if ($request->ajax()) {


            $user = User::where('email', $request->email);

            if ($request->has('id')) {
                clone $user->where('id', '<>', $request->id);
            }

            if ($user->count() > 0) {
                return 'false';
            } else {
                return 'true';
            }

        }
    }
}
