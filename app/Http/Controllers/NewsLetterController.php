<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsLetter;

class NewsLetterController extends Controller
{
    public function save(Request $request)
    {
    	$newsletter = new NewsLetter;
    	$newsletter->email = $request->email;
    	$newsletter->save();

    	return redirect()
    			->back();
    }

    public function check(Request $request)
    {
    	$newsletter = NewsLetter::where('email', $request->email)
    					->count();

    	if ($newsletter > 0) {
    		$res = false;
    	} else {
    		$res = true;
    	}

    	return response()->json($res);

    }
}
