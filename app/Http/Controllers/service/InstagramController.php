<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\service\subgiare\SGRInstagramController;
use Carbon\Carbon;

class InstagramController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('XSS');
    }

    public function likePost(Request $request){
        $validator = Validator::make($request->all(), [
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:100',
            'note' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'link_post.string' => 'Link post phải là chuỗi',
            'server_order.required' => 'Server order không được để trống',
            'server_order.string' => 'Server order phải là chuỗi',
            'amount.required' => 'Số tiền không được để trống',
            'amount.numeric' => 'Số tiền phải là số',
            'amount.min' => 'Số tiền phải lớn hơn 100',
            'note.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'like_instagram',
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
                    'message' => 'Server order đang bảo trì',
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
                            'message' => 'Tài khoản của bạn không đủ tiền để thực hiện giao dịch này',
                        ]);
                    }else{
                        $tongtien = $check_server->rate_server * $request->amount;
                        $tongtru = $check_user->total_money - $tongtien;
                        $sgr = new SGRInstagramController();
                        $payOut = $check_user->total_money - $tongtien;
                        $link_post = $request->link_post;
                        $note = $request->note;
                        $amount = $request->amount;
                        $server_order = $check_server->server_service;
                        $likePost = $sgr->likePost($link_post, $server_order, $amount, $note);
                        if($likePost['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $likePost['message'],
                            ]);
                        }elseif($likePost['status'] == true){
                            $link_post = $likePost['data']['link_post'];
                            $code_order = $likePost['data']['code_order'];
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'instagram' . 'like_instagram';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payOut,
                                'total_minus' => $check_user->total_minus + $tongtien
                            ]);

                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã mua Like post Instagram từ server " . $server_order . " với số tiền " . $tongtien . " VNĐ",
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'like_instagram',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server_order,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $note,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $likePost['message'],
                            ]);
                        }else{
                            return response()->json([
                                'status' => false,
                                'message' => 'Null',
                            ]);
                        }
                    }
                }
            }
        }
    }
    
    public function sub(Request $request){
        $validator = Validator::make($request->all(), [
            'link_post' => 'required|string',
            'server_order' => 'required|string',
            'amount' => 'required|numeric|min:100',
            'note' => 'string',
        ],[
            'link_post.required' => 'Link post không được để trống',
            'link_post.string' => 'Link post phải là chuỗi',
            'server_order.required' => 'Server order không được để trống',
            'server_order.string' => 'Server order phải là chuỗi',
            'amount.required' => 'Số tiền không được để trống',
            'amount.numeric' => 'Số tiền phải là số',
            'amount.min' => 'Số tiền phải lớn hơn 100',
            'note.string' => 'Ghi chú phải là chuỗi',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'sub_instagram',
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
                    'message' => 'Server order đang bảo trì',
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
                            'message' => 'Tài khoản của bạn không đủ tiền để thực hiện giao dịch này',
                        ]);
                    }else{
                        $tongtien = $check_server->rate_server * $request->amount;
                        $tongtru = $check_user->total_money - $tongtien;
                        $sgr = new SGRInstagramController();
                        $payOut = $check_user->total_money - $tongtien;
                        $link_post = $request->link_post;
                        $note = $request->note;
                        $amount = $request->amount;
                        $server_order = $check_server->server_service;
                        $subPost = $sgr->sub($link_post, $server_order, $amount, $note);
                        if($subPost['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $subPost['message'],
                            ]);
                        }elseif($subPost['status'] == true){
                            $link_post = $subPost['data']['username'];
                            $code_order = $subPost['data']['code_order'];
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'instagram' . 'sub_instagram';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payOut,
                                'total_minus' => $check_user->total_minus + $tongtien
                            ]);

                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã mua Sub post Instagram từ server " . $server_order . " với số tiền " . $tongtien . " VNĐ",
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'sub_instagram',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server_order,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $note,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $subPost['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }   

}
