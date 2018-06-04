<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Carbon\Carbon;

class LanguageController extends Controller
{
    public function set(Request $request)
    {
    	session()->put('locale', $request->lang);
    	return back();
    }
}
