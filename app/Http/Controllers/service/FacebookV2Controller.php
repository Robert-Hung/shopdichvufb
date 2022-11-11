<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Http\Controllers\api\service\subgiare\SGRFacebookController;

class FacebookV2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('XSS');
    }

    public function likePostSale(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'reaction' => 'string',
            'amount' => 'required|numeric|min:100',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'link_post.string' => 'Link post phải là chuỗi',
            'server_order.required' => 'Server order không được để trống',
            'server_order.string' => 'Server order phải là chuỗi',
            'reaction.string' => 'Cam xuc phải là chuỗi',
            'amount.required' => 'Amount không được để trống',
            'amount.numeric' => 'Amount phải là số',
            'amount.min' => 'Amount phải lớn hơn 200',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'like_post_sale',
                'server_service' => $request->server_order, 
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }
            else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }elseif($check_server->status_server == 0){
                        return response()->json([
                            'status' => false,
                            'message' => 'Server đang bảo trì',
                        ]);
                    }
                    else{
                        $tongtien = $check_server->rate_server * $request->amount; 
                        $tongtru = $check_user->total_money - $tongtien;
                        $sgr = new SGRFacebookController();
                        $payout = $check_user->total_money - $tongtien;
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $camxuc = $request->reaction;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $likepost = $sgr->likePostSale($link_post, $server, $camxuc, $amount, $ghichu);
                        if($likepost['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $likepost['message'],
                            ]);
                        }elseif($likepost['status'] == true){

                            $link_post = $likepost['data']['link_post'];
                            $code_order = $likepost['data']['code_order'];
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'facebook' . 'like_post_sale';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng like post sale với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'like_post_sale',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'reaction' => $camxuc,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $likepost['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function likePostSpeed(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'reaction' => 'string',
            'speed' => 'required',
            'amount' => 'required|numeric|min:100',
            'ghichu' => 'string',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'like_post_speed',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $tongtien = $check_server->rate_server * $request->amount; 
                        $tongtru = $check_user->total_money - $tongtien;
                        $sgr = new SGRFacebookController();
                        $payout = $check_user->total_money - $tongtien;
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $camxuc = $request->reaction;
                        $speed = $request->speed;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $likepost = $sgr->likePostSpeed($link_post, $server, $camxuc, $speed, $amount, $ghichu);
                        if($likepost['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $likepost['message'],
                            ]);
                        }elseif($likepost['status'] == true){

                            $link_post = $likepost['data']['idpost'];
                            $code_order = $likepost['data']['code_order'];
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'facebook' . 'like_post_speed';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng like post speed với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'like_post_speed',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'reaction' => $camxuc,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $likepost['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function commentSale(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'comment' => 'required|string',
            'amount' => 'required|numeric|min:50',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'comment.required' => 'Comment không được để trống',
            'amount.required' => 'Số lượng không được để trống',
            'amount.min' => 'Số lượng không được nhỏ hơn 50',
            'amount.numeric' => 'Số lượng phải là số',
            'comment.string' => 'Comment phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'cmt_sale',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $tongtien = $check_server->rate_server * $request->amount; 
                        $tongtru = $check_user->total_money - $tongtien;
                        $sgr = new SGRFacebookController();
                        $payout = $check_user->total_money - $tongtien;
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $comment = $request->comment;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $cmt = $sgr->commentSale($link_post, $server, $comment, $amount, $ghichu);
                        if($cmt['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $cmt['message'],
                            ]);
                        }elseif($cmt['status'] == true){
                            $link_post = $cmt['data']['link_post'];
                            $code_order = $cmt['data']['code_order'];
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'facebook' . 'cmt_sale';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng comment sale với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'cmt_sale',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'comment' => $comment,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $cmt['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function commentSpeed(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'comment' => 'required|string',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'comment.required' => 'Comment không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'comment.string' => 'Comment phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'cmt_speed',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $comment = $request->comment;
                        $ghichu = $request->ghichu;
                        $cmt = $sgr->commentSpeed($link_post, $server, $comment, $ghichu);
                        if($cmt['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $cmt['message'],
                            ]);
                        }elseif($cmt['status'] == true){
                            $link_post = $cmt['data']['idpost'];
                            $code_order = $cmt['data']['code_order'];
                            $amount = $cmt['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount; 
                            $tongtru = $check_user->total_money - $tongtien;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'facebook' . 'cmt_speed';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng comment speed với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'cmt_speed',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'comment' => $comment,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $cmt['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function subVip(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 1000',
            'comment.string' => 'Comment phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'sub_vip',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $subvip = $sgr->subVip($link_post, $server, $amount, $ghichu);
                        if($subvip['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $subvip['message'],
                            ]);
                        }elseif($subvip['status'] == true){
                            $link_post = $subvip['data']['idfb'];
                            $code_order = $subvip['data']['code_order'];
                            $amount = $subvip['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount; 
                            $tongtru = $check_user->total_money - $tongtien;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'facebook' . 'sub_vip';

                            DB::table('users')->where('username', Auth::
                            user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng sub vip với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'sub_vip',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $subvip['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function subQuality(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 1000',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'sub_quality',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $subquality = $sgr->subQuality($link_post, $server, $amount, $ghichu);
                        if($subquality['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $subquality['message'],
                            ]);
                        }elseif($subquality['status'] == true){
                            $link_post = $subquality['data']['idfb'];
                            $code_order = $subquality['data']['code_order'];
                            $amount = $subquality['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'facebook' . 'sub_quality';

                            DB::table('users')->where('username', Auth::
                            user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng sub quality với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'sub_quality',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $subquality['message'],
                            ]);
                        }
                    }
                }
            }
        }               
    }

    public function subSale(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 1000',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'sub_sale',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $subsale = $sgr->subSale($link_post, $server, $amount, $ghichu);
                        if($subsale['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $subsale['message'],
                            ]);
                        }elseif($subsale['status'] == true){
                            $link_post = $subsale['data']['idfb'];
                            $code_order = $subsale['data']['code_order'];
                            $amount = $subsale['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'facebook' . 'sub_sale';

                            DB::table('users')->where('username', Auth::
                            user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng sub sale với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'sub_sale',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $subsale['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }
    
    public function subSpeed(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 1000',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'sub_speed',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $subspeed = $sgr->subSpeed($link_post, $server, $amount, $ghichu);
                        if($subspeed['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $subspeed['message'],
                            ]);
                        }elseif($subspeed['status'] == true){
                            $link_post = $subspeed['data']['idfb'];
                            $code_order = $subspeed['data']['code_order'];
                            $amount = $subspeed['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'facebook' . 'sub_speed';

                            DB::table('users')->where('username', Auth::
                            user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng sub speed với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'sub_speed',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $subspeed['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function likePageQuality(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 1000',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'like_page_quality',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $likepagequality = $sgr->likePageQuality($link_post, $server, $amount, $ghichu);
                        if($likepagequality['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $likepagequality['message'],
                            ]);
                        }elseif($likepagequality['status'] == true){
                            $link_post = $likepagequality['data']['idpage'];
                            $code_order = $likepagequality['data']['code_order'];
                            $amount = $likepagequality['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'likepagequality' . 'facebook' . 'like_page_quality';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng like page quality với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'like_page_quality',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $likepagequality['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function likePageSale(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 1000',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'like_page_sale',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $likepagesale = $sgr->likePageSale($link_post, $server, $amount, $ghichu);
                        if($likepagesale['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $likepagesale['message'],
                            ]);
                        }elseif($likepagesale['status'] == true){
                            $link_post = $likepagesale['data']['idpage'];
                            $code_order = $likepagesale['data']['code_order'];
                            $amount = $likepagesale['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'likepagesale' . 'facebook' . 'like_page_sale';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng like page sale với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'like_page_sale',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $likepagesale['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function likePageSpeed(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 1000',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'like_page_speed',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $likepagespeed = $sgr->likePageSpeed($link_post, $server, $amount, $ghichu);
                        if($likepagespeed['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $likepagespeed['message'],
                            ]);
                        }elseif($likepagespeed['status'] == true){
                            $link_post = $likepagespeed['data']['idpage'];
                            $code_order = $likepagespeed['data']['code_order'];
                            $amount = $likepagespeed['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'likepagespeed' . 'facebook' . 'like_page_speed';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng like page speed với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'like_page_speed',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $likepagespeed['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function eyeLive(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'eye_amount' => 'required|numeric|min:50',
            'amount' => 'required|numeric|min:50',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'eye_amount.numeric' => 'Số lượng phải là số',
            'eye_amount.min' => 'Số lượng phải lớn hơn 50',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 50',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'eyes_live',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $eye_amount = $request->eye_amount;
                        $ghichu = $request->ghichu;
                        $eyeslive = $sgr->eyeLive($link_post, $server, $eye_amount, $amount, $ghichu);
                        if($eyeslive['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $eyeslive['message'],
                            ]);
                        }elseif($eyeslive['status'] == true){
                            $link_post = $eyeslive['data']['idpost'];
                            $code_order = $eyeslive['data']['code_order'];
                            $amount = $eyeslive['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'eyeslive' . 'facebook' . 'eyes_live';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng eye live với số lượng ".$amount." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'eyes_live',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $eyeslive['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function shareProfile(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:100',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 100',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'share_profile',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $share_profile = $sgr->shareProfile($link_post, $server, $amount, $ghichu);
                        if($share_profile['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $share_profile['message'],
                            ]);
                        }elseif($share_profile['status'] == true){
                            $link_post = $share_profile['data']['idpost'];
                            $code_order = $share_profile['data']['code_order'];
                            $amount = $share_profile['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'share_profile' . 'facebook' . 'share_profile';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng share profile với số lượng ".$amount. " Tổng tiền ".$tongtien." vào lúc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'share_profile',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $share_profile['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }
    
    public function memberGroup(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:100',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 100',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'member_group',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $member_group = $sgr->memberGroup($link_post, $server, $amount, $ghichu);
                        if($member_group['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $member_group['message'],
                            ]);
                        }elseif($member_group['status'] == true){
                            $link_post = $member_group['data']['idgroup'];
                            $code_order = $member_group['data']['code_order'];
                            $amount = $member_group['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'member_group' . 'facebook' . 'member_group';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Ban da dat don hang member group với số lượng ".$amount. " Tổng tiền ".$tongtien." vao luc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'member_group',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $member_group['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function viewStory(Request $request){
        $validator = Validator::make($request->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:100',
            'ghichu' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'server_order.required' => 'Server order không được để trống',
            'amount.numeric' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 100',
            'ghichu.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'view_story',
                'server_service' => $request->server_order,
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server order không tồn tại',
                ]);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang bảo trì',
                ]);
            }else{
                $check_user = DB::table('users')->where('username', Auth::user()->username)->first();
                if(!$check_user){
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    if($check_user->total_money < $check_server->rate_server){
                        return response()->json([
                            'status' => false,
                            'message' => 'Số dư không đủ để thực hiện giao dịch',
                        ]);
                    }else{
                        $sgr = new SGRFacebookController();
                        $link_post = $request->link_post;
                        $server = $check_server->server_service;
                        $amount = $request->amount;
                        $ghichu = $request->ghichu;
                        $view_story = $sgr->viewStory($link_post, $server, $amount, $ghichu);
                        if($view_story['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $view_story['message'],
                            ]);
                        }elseif($view_story['status'] == true){
                            $link_post = $view_story['data']['link_story'];
                            $code_order = $view_story['data']['code_order'];
                            $amount = $view_story['data']['amount'];
                            $tongtien = $check_server->rate_server * $amount;
                            $payout = $check_user->total_money - $tongtien;
                            $id_order = random_int(1, 9999999);
                            $type_service = 'view_story' . 'facebook' . 'view_story';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payout,
                                'total_minus' => $check_user->total_minus + $tongtien,
                            ]);
                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã đặt đơn hàng view story với số lượng ".$amount. " Tổng tiền ".$tongtien." vao luc ".date('H:i:s d/m/Y'),
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'view_story',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $ghichu,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $view_story['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }


}
