<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function likeGiaRe(Request $request = null)
    {
        $title = "Like Giá rẻ";
        $server = DB::table('service_server')->where('code_server', 'like-gia-re')->where('api_server', 'baostart')->get();
        return view('services.facebook.like-gia-re', compact('title', 'server'));
    }

    #Facebook V2

    public function likePostSale(){
        $title = "Like bài viết sale";
        $server = DB::table('service_server')->where('code_server', 'like_post_sale')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.like-post-sale', compact('title', 'server'));
    }

    public function likePostSpeed(){
        $title = "Like bài viết speed";
        $server = DB::table('service_server')->where('code_server', 'like_post_speed')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.like-post-speed', compact('title', 'server'));
    }

    public function commentSale(){
        $title = "Comment bài viết sale";
        $server = DB::table('service_server')->where('code_server', 'cmt_sale')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.comment-sale', compact('title', 'server'));
    }

    public function commentSpeed(){
        $title = "Comment bài viết speed";
        $server = DB::table('service_server')->where('code_server', 'cmt_speed')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.comment-speed', compact('title', 'server'));
    }

    public function subVip(){
        $title = "Tăng sub vip";
        $server = DB::table('service_server')->where('code_server', 'sub_vip')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.sub-vip', compact('title', 'server'));
    }

    public function subQuality(){
        $title = "Tăng sub quanlity";
        $server = DB::table('service_server')->where('code_server', 'sub_quality')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.sub-quality', compact('title', 'server'));
    }

    public function subSale(){
        $title = "Tăng sub sale";
        $server = DB::table('service_server')->where('code_server', 'sub_sale')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.sub-sale', compact('title', 'server'));
    }

    public function subSpeed(){
        $title = "Tăng sub speed";
        $server = DB::table('service_server')->where('code_server', 'sub_speed')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.sub-speed', compact('title', 'server'));
    }

    public function likePageQuality(){
        $title = "Like page quanlity";
        $server = DB::table('service_server')->where('code_server', 'like_page_quality')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.like-page-quality', compact('title', 'server'));
    }

    public function likePageSale(){
        $title = "Like page sale";
        $server = DB::table('service_server')->where('code_server', 'like_page_sale')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.like-page-sale', compact('title', 'server'));
    }

    public function likePageSpeed(){
        $title = "Like page speed";
        $server = DB::table('service_server')->where('code_server', 'like_page_speed')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.like-page-speed', compact('title', 'server'));
    }

    public function eyeLive(){
        $title = "Eye Live";
        $server = DB::table('service_server')->where('code_server', 'eyes_live')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.eye-live', compact('title', 'server'));
    }

    public function shareProfile(){
        $title = "Share profile";
        $server = DB::table('service_server')->where('code_server', 'share_profile')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.share-profile', compact('title', 'server'));
    }

    public function memberGroup(){
        $title = "Member group";
        $server = DB::table('service_server')->where('code_server', 'member_group')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.member-group', compact('title', 'server'));
    }

    public function viewStory(){
        $title = "View story";
        $server = DB::table('service_server')->where('code_server', 'view_story')->where('api_server', 'subgiare')->get();
        return view('services.facebook-v2.view-story', compact('title', 'server'));
    }

    //instagram
    public function likePost(){
        $title = "Like bài viết";
        $server = DB::table('service_server')->where('code_server', 'like_instagram')->where('api_server', 'subgiare')->get();
        return view('services.instagram.like-post', compact('title', 'server'));
    }

    public function sub(){
        $title = "Tăng sub";
        $server = DB::table('service_server')->where('code_server', 'sub_instagram')->where('api_server', 'subgiare')->get();
        return view('services.instagram.sub', compact('title', 'server'));
    }

    //tiktok
    public function likeTiktok(){
        $title = "Thả tim tiktok";
        $server = DB::table('service_server')->where('code_server', 'like_tiktok')->where('api_server', 'subgiare')->get();
        return view('services.tiktok.like', compact('title', 'server'));
    }

    public function commentTiktok(){
        $title = "Comment tiktok";
        $server = DB::table('service_server')->where('code_server', 'cmt_tiktok')->where('api_server', 'subgiare')->get();
        return view('services.tiktok.comment', compact('title', 'server'));
    }

    public function shareTiktok(){
        $title = "Share tiktok";
        $server = DB::table('service_server')->where('code_server', 'share_tiktok')->where('api_server', 'subgiare')->get();
        return view('services.tiktok.share', compact('title', 'server'));
    }

    public function subTiktok(){
        $title = "Tăng sub tiktok";
        $server = DB::table('service_server')->where('code_server', 'sub_tiktok')->where('api_server', 'subgiare')->get();
        return view('services.tiktok.sub', compact('title', 'server'));
    }

    public function viewTiktok(){
        $title = "Xem tiktok";
        $server = DB::table('service_server')->where('code_server', 'view_tiktok')->where('api_server', 'subgiare')->get();
        return view('services.tiktok.view', compact('title', 'server'));
    }
}
