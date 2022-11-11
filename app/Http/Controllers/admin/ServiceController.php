<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('XSS');
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function addServiceFacebook(Request $request){
        $validator = Validator::make($request->all(), [
            'type_service_facebook' => 'required|string',
            'server_facebook' => 'required|numeric',
            'rate_facebook' => 'required|numeric',
            'title_facebook' => 'required|string',
            'notice' => 'required|string',
        ],[
            'type_service_facebook.required' => 'Vui lòng nhập loại dịch vụ',
            'type_service_facebook.string' => 'Loại dịch vụ phải là chuỗi',
            'server_facebook.required' => 'Vui lòng nhập server',
            'server_facebook.numeric' => 'Số lượng server phải là số',
            'rate_facebook.required' => 'Vui lòng nhập tỷ lệ thuê bao',
            'rate_facebook.numeric' => 'Tỷ lệ thuê bao phải là số',
            'title_facebook.required' => 'Vui lòng nhập tiêu đề',
            'title_facebook.string' => 'Tiêu đề phải là chuỗi',
            'notice' => 'Vui lòng nhập thông báo',
            'notice.string' => 'Thông báo phải là chuỗi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }else{
            //kiểm tra server trong databse của $request->type_service_facebook có tồn tại hay không nếu tồn tại thì trả về false
            $check_server = DB::table('service_server')->where('server_service', $request->server_facebook)->where('code_server', $request->type_service_facebook)->first(); 
            if($check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đã tồn tại'
                ], 200);
            }else{
                DB::table('service_server')->insert([
                    'code_server' => $request->type_service_facebook,
                    'server_service' => $request->server_facebook,
                    'rate_server' => $request->rate_facebook,
                    'title_server' => $request->title_facebook,
                    'notice' => $request->notice,
                    'status_server' => 1,
                    'key_server' =>
                    md5('facebook'.$request->type_service_facebook.$request->server_facebook.$request->rate_facebook),
                    'type_server' => md5('facebook'),
                    'api_server' => 'subgiare',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Thêm dịch vụ thành công'
                ], 200);
            }
        }
    }
    public function addServiceInstagram(Request $request){
        $validator = Validator::make($request->all(), [
            'type_service_instagram' => 'required|string',
            'server_instagram' => 'required|numeric',
            'rate_instagram' => 'required|numeric',
            'title_instagram' => 'required|string',
            'notice' => 'required|string',
        ],[
            'type_service_instagram.required' => 'Vui lòng nhập loại dịch vụ',
            'type_service_instagram.string' => 'Loại dịch vụ phải là chuỗi',
            'server_instagram.required' => 'Vui lòng nhập server',
            'server_instagram.numeric' => 'Số lượng server phải là số',
            'rate_instagram.required' => 'Vui lòng nhập tỷ lệ thuê bao',
            'rate_instagram.numeric' => 'Tỷ lệ thuê bao phải là số',
            'title_instagram.required' => 'Vui lòng nhập tiêu đề',
            'title_instagram.string' => 'Tiêu đề phải là chuỗi',
            'notice.required' => 'Vui lòng nhập thông báo',
            'notice.string' => 'Thông báo phải là chuỗi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }else{
            //kiểm tra server trong databse của $request->type_service_instagram có tồn tại hay không nếu tồn tại thì trả về false
            $check_server = DB::table('service_server')->where('server_service', $request->server_instagram)->where('code_server', $request->type_service_instagram)->first();
            
            if($check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đã tồn tại'
                ], 200);
            }else{
                DB::table('service_server')->insert([
                    'code_server' => $request->type_service_instagram,
                    'server_service' => $request->server_instagram,
                    'rate_server' => $request->rate_instagram,
                    'title_server' => $request->title_instagram,
                    'notice' => $request->notice,
                    'status_server' => 1,
                    'key_server' =>
                    md5('instagram'.$request->type_service_instagram.$request->server_instagram.$request->rate_instagram),
                    'type_server' => md5('instagram'),
                    'api_server' => 'subgiare',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Thêm dịch vụ thành công'
                ], 200);
            }
        }
    }
    public function addServiceTiktok(Request $request){
        $validator = Validator::make($request->all(), [
            'type_service_tiktok' => 'required|string',
            'server_tiktok' => 'required|numeric',
            'rate_tiktok' => 'required|numeric',
            'title_tiktok' => 'required|string',
            'notice' => 'required|string',
        ],[
            'type_service_tiktok.required' => 'Vui lòng nhập loại dịch vụ',
            'type_service_tiktok.string' => 'Loại dịch vụ phải là chuỗi',
            'server_tiktok.required' => 'Vui lòng nhập server',
            'server_tiktok.numeric' => 'Số lượng server phải là số',
            'rate_tiktok.required' => 'Vui lòng nhập giá tiền',
            'rate_tiktok.numeric' => 'Giá tiền phải là số',
            'title_tiktok.required' => 'Vui lòng nhập tiêu đề',
            'title_tiktok.string' => 'Tiêu đề phải là chuỗi',
            'notice.required' => 'Vui lòng nhập thông báo',
            'notice.string' => 'Thông báo phải là chuỗi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }else{
            //kiểm tra server trong databse của $request->type_service_tiktok có tồn tại hay không nếu tồn tại thì trả về false
            $check_server = DB::table('service_server')->where('server_service', $request->server_tiktok)->where('code_server', $request->type_service_tiktok)->first();
            if($check_server){
                return response()->json([
                    'status' => false,
                    'message' => 'Server đã tồn tại'
                ], 200);
            }else{
                DB::table('service_server')->insert([
                    'code_server' => $request->type_service_tiktok,
                    'server_service' => $request->server_tiktok,
                    'rate_server' => $request->rate_tiktok,
                    'title_server' => $request->title_tiktok,
                    'notice' => $request->notice,
                    'status_server' => 1,
                    'key_server' =>
                    md5('tiktok'.$request->type_service_tiktok.$request->server_tiktok.$request->rate_tiktok),
                    'type_server' => md5('tiktok'),
                    'api_server' => 'subgiare',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Thêm dịch vụ thành công'
                ], 200);
            }
        }
    }

    public function offService(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'numeric',
        ],[
            'id.numeric' => 'Id dịch vụ phải là số',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else{
            $check_server = DB::table('service_server')->where('id', $request->id)->first();
            if($check_server){
                DB::table('service_server')->where('id', $request->id)->update([
                    'status_server' => 0,
                    'updated_at' => Carbon::now()
                ]);
                return redirect()->back()->with('success', 'Tắt dịch vụ thành công');
            }else{
                return redirect()->back()->with('error', 'Dịch vụ không tồn tại');
            }
        }
    }

    public function onService(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'numeric',
        ],[
            'id.numeric' => 'Id dịch vụ phải là số',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else{
            $check_server = DB::table('service_server')->where('id', $request->id)->first();
            if($check_server){
                DB::table('service_server')->where('id', $request->id)->update([
                    'status_server' => 1,
                    'updated_at' => Carbon::now()
                ]);
                return redirect()->back()->with('success', 'Bật dịch vụ thành công');
            }else{
                return redirect()->back()->with('error', 'Dịch vụ không tồn tại');
            }
        }
    }
    public function deleteService(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'numeric',
        ],[
            'id.numeric' => 'Id dịch vụ phải là số',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else{
            $check_server = DB::table('service_server')->where('id', $request->id)->first();
            if($check_server){
                DB::table('service_server')->where('id', $request->id)->delete();
                return redirect()->back()->with('success', 'Xóa dịch vụ thành công');
            }else{
                return redirect()->back()->with('error', 'Dịch vụ không tồn tại');
            }
        }
    }

    public function updateService(Request $request){
        $validator = Validator::make($request->all(),[
            'id_service' => 'numeric|exists:service_server,id',
            'rate' => 'required|numeric',
            'package_name' => 'string',
            'note' => 'required|string',
        ],[
            'id_service.numeric' => 'Id dịch vụ phải là số',
            'id_service.exists' => 'Dịch vụ không tồn tại',
            'rate.required' => 'Vui lòng nhập giá tiền',
            'rate.numeric' => 'Giá tiền phải là số',
            'package_name.string' => 'Package name phải là chuỗi',
            'note.required' => 'Vui lòng nhập ghi chú',
            'note.string' => 'Ghi chú phải là chuỗi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }else{
            $check_server = DB::table('service_server')->where('id', $request->id_service)->first();
            if($check_server->api_server == 'baostart'){
                DB::table('service_server')->where('id', $request->id_service)->update([
                    'rate_server' => $request->rate,
                    'title_server' => $request->note,
                    'server_name' => $request->package_name,
                    'updated_at' => Carbon::now()
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Cập nhật dịch vụ thành công'
                ], 200);
            }
            elseif($check_server){
                DB::table('service_server')->where('id', $request->id_service)->update([
                    'rate_server' => $request->rate,
                    'title_server' => $request->note,
                    'updated_at' => Carbon::now()
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Cập nhật dịch vụ thành công'
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Dịch vụ không tồn tại'
                ], 200);
            }
        }
    }



}
