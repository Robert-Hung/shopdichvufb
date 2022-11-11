<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;


class HistoryService extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('XSS');
    }

    public function FacebookOrder(Request $request)
    {
        $title = $request->service; 
        if($request->service == 'like-post-sale'){
            $type = 'like_post_sale';
        }elseif($request->service == 'like-post-speed'){
            $type = 'like_post_speed';
        }elseif($request->service == 'comment-sale'){
            $type = 'cmt_sale';
        }elseif($request->service == 'comment-speed'){
            $type = 'cmt_speed';
        }elseif($request->service == 'sub-vip'){
            $type = 'sub_vip';
        }elseif($request->service == 'sub-quality'){
            $type = 'sub_quality';
        }elseif($request->service == 'sub-sale'){
            $type = 'sub_sale';
        }elseif($request->service == 'sub-speed'){
            $type = 'sub_speed';
        }elseif($request->service == 'like-page-quality'){
            $type = 'like_page_quality';
        }elseif($request->service == 'like-page-sale'){
            $type = 'like_page_sale';
        }elseif($request->service == 'like-page-speed'){
            $type = 'like_page_speed';
        }elseif($request->service == 'eye-live'){
            $type = 'eyes_live';
        }elseif($request->service == 'share-profile'){
            $type = 'share_profile';
        }elseif($request->service == 'member-group'){
            $type = 'member_group';
        }elseif($request->service == 'view-story'){
            $type = 'view_story';
        }
        $server = DB::table('client_orders')->where([
            'username' => Auth::user()->username,
            'type' => $type,
        ])->get();
        return view('services.history.facebook', compact('title', 'server'));

    }

    public function InstagramOrder(Request $request){
        $title = $request->service;
        if($request->service == 'like-post'){
            $type = 'like_instagram';
        }elseif($request->service == 'sub'){
            $type = 'sub_instagram';
        }
        $server = DB::table('client_orders')->where([
            'username' => Auth::user()->username,
            'type' => $type,
        ])->get();
        return view('services.history.instagram', compact('title', 'server'));
    }

    public function TiktokOrder(Request $request){
        $title = $request->service;
        if($request->service == 'like'){
            $type = 'like_tiktok';
        }elseif($request->service == 'comment'){
            $type = 'cmt_tiktok';
        }elseif($request->service == 'sub'){
            $type = 'sub_tiktok';
        }elseif($request->service == 'share'){
            $type = 'share_tiktok';
        }elseif($request->service == 'view'){
            $type = 'view_tiktok';
        }
        $server = DB::table('client_orders')->where([
            'username' => Auth::user()->username,
            'type' => $type,
        ])->get();
        return view('services.history.tiktok', compact('title', 'server'));
    }

}
