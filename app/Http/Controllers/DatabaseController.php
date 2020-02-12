<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DatabaseController extends Controller
{
    //
    public function index(){
        $user = User::all();
        return $user;
    }
}
