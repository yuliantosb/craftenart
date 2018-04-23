<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

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
    	return view('backend.user.create', compact(['roles']));
    }
}
