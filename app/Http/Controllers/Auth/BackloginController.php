<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackloginController extends Controller
{
  public function __construct()
  {
      $this->middleware('guest')->except('logout');
  }


  public function showLoginForm()
  {
      return view('auth.backlogin');
  }
}
