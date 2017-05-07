<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(){
        return view('newpost');
    }

    public function newPost(){
        //dd(Auth::user());

    }
}
