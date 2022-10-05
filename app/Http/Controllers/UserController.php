<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function data_one(){
        $users = User::all();
        return view('user.datatable_one')->with('users', $users);
    }
    public function data_two(){
        $users = User::all();
        return view('user.datatable_two')->with('users', $users);
    }
    public function data_tree(){
        $users = User::all();
        return view('user.datatable_tree')->with('users', $users);
    }
}
