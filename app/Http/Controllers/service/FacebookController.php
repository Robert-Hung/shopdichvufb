<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\api\service\baostart\BSFacebookController;

class FacebookController extends Controller
{
    public function __construct()
    {
        $this->middleware('XSS');
        $this->middleware('auth');
    }

    public function likeGiaRe(Request $request){
    }


}
