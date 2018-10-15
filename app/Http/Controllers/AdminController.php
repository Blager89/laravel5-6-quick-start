<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $user = User::all();
        return $user;
    }
}
