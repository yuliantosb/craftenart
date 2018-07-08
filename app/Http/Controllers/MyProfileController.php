<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RajaOngkir;
use DB;
use Image;
use App\User;
use App\Customer;
use App\Media;
use Hash;

class MyProfileController extends Controller
{
    public function index()
    {
    	$user = User::find(auth()->user()->id);
    	return view('frontend.profile', compact(['user']));
    }

    public function edit()
    {
    	$id = auth()->user()->id;
    	$user = User::find($id);
    	$provinces = RajaOngkir::getProvince();
		$cities = RajaOngkir::getCity($user->cust->province_id);

    	return view('frontend.profile.edit', compact(['user', 'provinces', 'cities']));
    }

    public function update(Request $request)
    {
    	
    	DB::transaction(function() use ($request) {

    		$user = User::with('cust')
    					->find(auth()->user()->id);

	    	$user->name = $request->name;
			$user->cust->identity_number = $request->identity_number;
			$user->cust->phone_number = $request->phone_number;
			$user->cust->place_of_birth = $request->place_of_birth;
			$user->cust->date_of_birth = $request->date_of_birth;
			$user->cust->province_id = $request->province_id;
			$user->cust->city_id = $request->city_id;
			$user->cust->address = $request->address;
			$user->cust->zip = $request->zip;
			$user->push();
		
		});

		return redirect()
				->route('user.profile.index')
				->with('message', 'Profile updated');
    }


    public function upload(Request $request)
    {

    	$res = '';

    	DB::transaction(function() use($request, &$res){

    		$extension = $request->file('file')->getClientOriginalExtension();
	        $realfilename = $request->file('file')->getClientOriginalName();
	        $filesize = $request->file('file')->getClientSize();

	        $dir = public_path('uploads/');
	        $filename = time() .'_'. rand() .'.' . $extension;
	        $request->file('file')->move($dir, $filename);

	        $thumb1 = Image::make($dir.'/'.$filename);
	        $thumb1->fit(215, 215);
	        $thumb1->save($dir.'thumbs/'.$filename);

	        $media = new Media;
	        $media->name = $filename;
	        $media->alt = pathinfo($realfilename, PATHINFO_FILENAME);
	        $media->size = $filesize;
	        $media->save();

	        $user = User::find(auth()->user()->id);
	        $user->cust->picture = url('uploads/thumbs/'.$filename);
	        $user->push();

	        if (!empty($request->old_pic) and $request->old_pic !== '')
	        {
	        	if (!empty(explode('/', $request->old_pic)[3])) {

	        		if(file_exists('uploads/'.explode('/', $request->old_pic)[3])) {
						unlink('uploads/'.explode('/', $request->old_pic)[3]);
						unlink('uploads/thumbs/'.explode('/', $request->old_pic)[3]);

						$media = Media::where('name', explode('/', $request->old_pic)[3])->first();
						$media->delete();
					}
	        	}
	        }

	        $res = [
	        		'title' => '<b>Success</b>',
	        		'type' => 'success',
	        		'message' => 'Avatar updated',
	        		'avatar' => $filename,
	        		'old_pic' => parse_url(url('uploads/thumbs/'.$filename))['path']
        		];

    	});

    	return response()->json($res);
        
    }

    public function password()
    {
    	return view('frontend.profile.password');
    }

    public function checkPassword(Request $request)
    {
    	if ($request->ajax()) {

    		$user = User::find(auth()->user()->id);
    		if (Hash::check($request->old_password, $user->password)) {
    			return response()->json(true);
    		} else {
    			return response()->json(false);
    		}

    	}
    }

    public function changePasswd(Request $request)
    {
    	$user = User::find(auth()->user()->id);
    	$user->password = Hash::make($request->new_password);
    	$user->save();

    	return redirect()
    			->back()
    			->with('alert', ['type' => 'success', 'title' => 'Success', 'message' => 'Password changed successfully!']);
    }
}
