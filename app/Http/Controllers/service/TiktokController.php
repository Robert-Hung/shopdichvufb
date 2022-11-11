<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\service\subgiare\SGRTiktokController;


class TiktokController extends Controller
{
    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function likeTiktok(Request $request){
        $validator = Validator::make($request->all(), [
            'link_post' => 'required|string',
            'server_order' => 'required|numeric',
            'amount' => 'required|numeric|min:100',
            'note' => 'string',
        ],[
            'link_post.required' => 'Bạn chưa nhập link post',
            'server_order.required' => 'Bạn chưa chọn server',
            'amount.required' => 'Bạn chưa nhập số tiền',
            'amount.min' => 'Số tiền phải lớn hơn 100',
            'note.string' => 'Bạn chưa nhập ghi chú',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'like_tiktok',
                'server_service' => $request->server_order, 
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server không tồn tại',
                ], 200);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang tạm ngưng hoạt động',
                ], 200);
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
                        $sgr = new SGRTiktokController();
                        $payOut = $check_user->total_money - $tongtien;
                        $link_post = $request->link_post;
                        $note = $request->note;
                        $amount = $request->amount;
                        $server_order = $check_server->server_service;
                        $like = $sgr->like($link_post, $server_order, $amount, $note);
                        if($like['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $like['message'],
                            ]);
                        }elseif($like['status'] == true){
                            $link_post = $like['data']['link_video'];
                            $code_order = $like['data']['code_order'];
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'tiktok' . 'like_tiktok';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payOut,
                                'total_minus' => $check_user->total_minus + $tongtien
                            ]);

                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã mua Like Tiktok từ server " . $server_order . " với số tiền " . $tongtien . " VNĐ",
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'like_tiktok',
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
                                'message' => $like['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function commentTiktok(Request $requets){
        $validator = Validator::make($requets->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|numeric',
            'comment' => 'required|string',
            'amount' => 'required|numeric|min:100', 
            'note' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'cmt_tiktok',
                'server_service' => $requets->server_order, 
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server không tồn tại',
                ], 200);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang tạm ngưng hoạt động',
                ], 200);
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
                        $tongtien = $check_server->rate_server * $requets->amount;
                        $tongtru = $check_user->total_money - $tongtien;
                        $sgr = new SGRTiktokController();
                        $payOut = $check_user->total_money - $tongtien;
                        $link_post = $requets->link_post;
                        $comments = $requets->comment;
                        $amount = $requets->amount;
                        $note = $requets->note;
                        $server_order = $check_server->server_service;
                        $comment = $sgr->comment($link_post, $server_order, $amount, $comments, $requets->note);
                        if($comment['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $comment['message'],
                            ]);
                        }elseif($comment['status'] == true){
                            $link_post = $comment['data']['link_video'];
                            $code_order = $comment['data']['code_order'];
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'tiktok' . 'cmt_tiktok';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payOut,
                                'total_minus' => $check_user->total_minus + $tongtien
                            ]);

                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã mua Comment Tiktok từ server " . $server_order . " với số tiền " . $tongtien . " VNĐ",
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'cmt_tiktok',
                                'soluong' => $amount,
                                'time_order' => time(),
                                'total_money' => $tongtien,
                                'prices' => $check_server->rate_server,
                                'link_order' => $link_post,
                                'server_order' => $server_order,
                                'comment' => $comments,
                                'status' => 'Start',
                                'code_order' => $code_order,
                                'id_order' => $id_order,
                                'type_service' => md5($type_service),
                                'ghichu' => $note,
                                'created_at' => Carbon::now()->toDateTimeString(),
                            ]);
                            return response()->json([
                                'status' => true,
                                'message' => $comment['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function shareTiktok(Request $requets){
        $validator = Validator::make($requets->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|numeric',
            'amount' => 'required|numeric|min:100', 
            'note' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'share_tiktok',
                'server_service' => $requets->server_order, 
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server không tồn tại',
                ], 200);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang tạm ngưng hoạt động',
                ], 200);
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
                        $tongtien = $check_server->rate_server * $requets->amount;
                        $tongtru = $check_user->total_money - $tongtien;
                        $sgr = new SGRTiktokController();
                        $payOut = $check_user->total_money - $tongtien;
                        $link_post = $requets->link_post;
                        $amount = $requets->amount;
                        $note = $requets->note;
                        $server_order = $check_server->server_service;
                        $share = $sgr->share($link_post, $server_order, $amount, $requets->note);
                        if($share['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $share['message'],
                            ]);
                        }elseif($share['status'] == true){
                            $link_post = $share['data']['link_video'];
                            $code_order = $share['data']['code_order'];
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'tiktok' . 'share_tiktok';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payOut,
                                'total_minus' => $check_user->total_minus + $tongtien
                            ]);

                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã mua Share Tiktok từ server " . $server_order . " với số tiền " . $tongtien . " VNĐ",
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'share_tiktok',
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
                                'message' => $share['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function subTiktok(Request $requets){
        $validator = Validator::make($requets->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|numeric',
            'amount' => 'required|numeric|min:100', 
            'note' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'sub_tiktok',
                'server_service' => $requets->server_order, 
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server không tồn tại',
                ], 200);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang tạm ngưng hoạt động',
                ], 200);
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
                        $tongtien = $check_server->rate_server * $requets->amount;
                        $tongtru = $check_user->total_money - $tongtien;
                        $sgr = new SGRTiktokController();
                        $payOut = $check_user->total_money - $tongtien;
                        $link_post = $requets->link_post;
                        $amount = $requets->amount;
                        $note = $requets->note;
                        $server_order = $check_server->server_service;
                        $sub = $sgr->sub($link_post, $server_order, $amount, $requets->note);
                        if($sub['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $sub['message'],
                            ]);
                        }elseif($sub['status'] == true){
                            $link_post = $sub['data']['username'];
                            $code_order = $sub['data']['code_order'];
                            $id_order = random_int(1, 9999999);
                            $type_service = 'subgiare' . 'tiktok' . 'sub_tiktok';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payOut,
                                'total_minus' => $check_user->total_minus + $tongtien
                            ]);

                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã mua Sub Tiktok từ server " . $server_order . " với số tiền " . $tongtien . " VNĐ",
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'sub_tiktok',
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
                                'message' => $sub['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function viewTiktok(Request $requets){
        $validator = Validator::make($requets->all(),[
            'link_post' => 'required|string',
            'server_order' => 'required|numeric',
            'amount' => 'required|numeric|min:1000', 
            'note' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }else{
            $check_server = DB::table('service_server')->where([
                'code_server' => 'view_tiktok',
                'server_service' => $requets->server_order, 
                'api_server' => 'subgiare'
            ])->first();
            if(!$check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server không tồn tại',
                ], 200);
            }elseif($check_server->status_server == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đang tạm ngưng hoạt động',
                ], 200);
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
                        $tongtien = $check_server->rate_server * $requets->amount;
                        $tongtru = $check_user->total_money - $tongtien;
                        $sgr = new SGRTiktokController();
                        $payOut = $check_user->total_money - $tongtien;
                        $link_post = $requets->link_post;
                        $amount = $requets->amount;
                        $note = $requets->note;
                        $server_order = $check_server->server_service;
                        $view = $sgr->view($link_post, $server_order, $amount, $requets->note);
                        if($view['status'] == false){
                            return response()->json([
                                'status' => false,
                                'message' => $view['message'],
                            ]);
                        }elseif($view['status'] == true){
                            $link_post = $view['data']['link_video'];
                            $code_order = $view['data']['code_order'];
                            $id_order = random_int(1, 9999999);
                            $type_service = 'viewgiare' . 'tiktok' . 'view_tiktok';

                            DB::table('users')->where('username', Auth::user()->username)->update([
                                'total_money' => $payOut,
                                'total_minus' => $check_user->total_minus + $tongtien
                            ]);

                            DB::table('log_site')->insert([
                                'username' => Auth::user()->username,
                                'note' => "Bạn đã mua View Tiktok từ server " . $server_order . " với số tiền " . $tongtien . " VNĐ",
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);

                            DB::table('client_orders')->insert([
                                'username' => Auth::user()->username,
                                'type' => 'view_tiktok',
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
                                'message' => $view['message'],
                            ]);
                        }
                    }
                }
            }
        }
    }

}
