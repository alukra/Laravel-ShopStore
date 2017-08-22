<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

  public function getProfile(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Perfil";
    return view('auth.profile')->with($data);
  }
}
