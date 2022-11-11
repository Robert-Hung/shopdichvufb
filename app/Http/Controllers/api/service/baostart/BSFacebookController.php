<?php

namespace App\Http\Controllers\api\service\baostart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class BSFacebookController extends Controller
{

    public function __construct()
    {
        $this->middleware('XSS');
        $this->middleware('auth');
    }

    public function likegiare(){
        $url = "https://dichvu.baostar.pro/api/facebook-like-gia-re/buy";
        $api_key = "MTUzODI3bm93Y2QwOTUzOTEzZGIzZTJlYmRlY2I1MTg0ZQ==";
        $client = new Client();
        $response = $client->request('POST', $url, [
            'headers' => [
                'Api-Key' => $api_key,
                'Content-Type' => 'application/json',
            ],
            'form_params' => [
                'package_name' => 'facebook_like',
                'object_id' => '100009087244981',
                'quantity' => 100,
            ],
        ]);
        return $response;
    }
}
