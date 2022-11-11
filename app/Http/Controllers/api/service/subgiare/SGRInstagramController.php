<?php

namespace App\Http\Controllers\api\service\subgiare;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class SGRInstagramController extends Controller
{
    public function __construct()
    {
        $this->middleware('XSS');
        $token = DB::table('site_options')->where('key', 'token_subgiare')->first();
        $this->token = $token->value;
    }

    public function likePost($link_post, $server_order, $amount, $note = null){
        $url = "https://thuycute.hoangvanlinh.vn/api/service/instagram/like-post/order";
        $client = new Client();

        $response = $client->request('POST', $url, [
            'headers' => $this->headers(),
            'form_params' => [
                'link_post' => $link_post,
                'server_order' => 'sv'.$server_order,
                'amount' => $amount,
                'note' => $note,
            ],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }

    public function sub($username, $server, $amount, $note = null){
        $url = "https://thuycute.hoangvanlinh.vn/api/service/instagram/sub/order";
        $client = new Client();

        $response = $client->request('POST', $url, [
            'headers' => $this->headers(),
            'form_params' => [
                'username' => $username,
                'server_order' => 'sv' .$server,
                'amount' => $amount,
                'note' => $note,
            ],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }

    public function headers(){
        $headers = [
            'Accept' => '*/*',
            'Api-token' => $this->token,
            'Content-Type' => 'application/x-www-form-urlencoded',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36',
        ];
        return $headers;
    }
}
