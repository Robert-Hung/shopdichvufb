<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\recharge\banking\MomoController;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('XSS');
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function DoSettingWebsite(Request $request){
        $validator = Validator::make($request->all(),[
            'status_web' => 'required|string',
            'domain'  => 'required|string',
            'transfer_code' => 'required|string',
            'describe' => 'required|string',
            'keyword' => 'required|string',
            'favicon' => 'required|string',
            'intro_img' => 'required|string',
            'token_facebook' => 'required|string',
            'token_bot' => 'required|string',
            'id_chat' => 'required|string',
            'charge_level_CTV' => 'required',
            'charge_level_DL' => 'required',
            'charge_level_NPP' => 'required',
            'discount_TV' => 'required',
            'discount_CTV' => 'required',
            'discount_DL' => 'required',
            'discount_NPP' => 'required',
            'card_discount' => 'required',
        ],[
            'status_web.required' => 'Vui lòng nhập trạng thái website',
            'domain.required' => 'Vui lòng nhập tên miền',
            'transfer_code.required' => 'Vui lòng nhập mã chuyển khoản',
            'describe.required' => 'Vui lòng nhập mô tả website',
            'keyword.required' => 'Vui lòng nhập keyword website',
            'favicon.required' => 'Vui lòng nhập favicon',
            'intro_img.required' => 'Vui lòng nhập ảnh giới thiệu',
            'token_facebook.required' => 'Vui lòng nhập token facebook',
            'token_bot.required' => 'Vui lòng nhập token bot',
            'id_chat.required' => 'Vui lòng nhập id chat',
            'charge_level_CTV.required' => 'Vui lòng nhập mức phí của CTV',
            'charge_level_DL.required' => 'Vui lòng nhập mức phí của DL',
            'charge_level_NPP.required' => 'Vui lòng nhập mức phí của NPP',
            'discount_TV.required' => 'Vui lòng nhập giảm giá cho TV',
            'discount_CTV.required' => 'Vui lòng nhập giảm giá cho CTV',
            'discount_DL.required' => 'Vui lòng nhập giảm giá cho DL',
            'discount_NPP.required' => 'Vui lòng nhập giảm giá cho NPP',
            'card_discount.required' => 'Vui lòng nhập giảm giá cho thẻ',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            //check number if not number return false
            if(!is_numeric($request->charge_level_CTV) || !is_numeric($request->charge_level_DL) || !is_numeric($request->charge_level_NPP) || !is_numeric($request->discount_TV) || !is_numeric($request->discount_CTV) || !is_numeric($request->discount_DL) || !is_numeric($request->discount_NPP) || !is_numeric($request->card_discount)){
                return response()->json([
                    'status' => false,
                    'message' => 'Định dạng dữ liệu không đúng',
                ]);
            }else{
                DB::table('site_options')->where('key', 'domain')->update(['value' => $request->domain]);
                DB::table('site_options')->where('key', 'transfer_code')->update(['value' => $request->transfer_code]);
                DB::table('site_options')->where('key', 'status_web')->update(['value' => $request->status_web]);
                DB::table('site_options')->where('key', 'describe')->update(['value' => $request->describe]);
                DB::table('site_options')->where('key', 'key_word')->update(['value' => $request->keyword]);
                DB::table('site_options')->where('key', 'favicon_web')->update(['value' => $request->favicon]);
                DB::table('site_options')->where('key', 'intro_img')->update(['value' => $request->intro_img]);
                DB::table('site_options')->where('key', 'token_facebook')->update(['value' => $request->token_facebook]);
                DB::table('site_options')->where('key', 'api_telegram_bot')->update(['value' => $request->token_bot]);
                DB::table('site_options')->where('key', 'id_chat_tel')->update(['value' => $request->id_chat]);
                DB::table('site_options')->where('key', 'charge_level_CTV')->update(['value' => $request->charge_level_CTV]);
                DB::table('site_options')->where('key', 'charge_level_DL')->update(['value' => $request->charge_level_DL]);
                DB::table('site_options')->where('key', 'charge_level_NPP')->update(['value' => $request->charge_level_NPP]);
                DB::table('site_options')->where('key', 'discount_TV')->update(['value' => $request->discount_TV]);
                DB::table('site_options')->where('key', 'discount_CTV')->update(['value' => $request->discount_CTV]);
                DB::table('site_options')->where('key', 'discount_DL')->update(['value' => $request->discount_DL]);
                DB::table('site_options')->where('key', 'discount_NPP')->update(['value' => $request->discount_NPP]);
                DB::table('site_options')->where('key', 'card_discount')->update(['value' => $request->card_discount]);
                return response()->json([
                    'status' => true,
                    'message' => 'Cập nhật thành công',
                ]);
            }
        }
    }

    public function updateUser(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'username' => 'required|string|exists:users,username',
            'money' => 'required|numeric',
        ],[
            'type.required' => 'Vui lòng chọn loại tài khoản',
            'username.required' => 'Vui lòng nhập tên tài khoản',
            'username.exists' => 'Tài khoản không tồn tại',
            'money.required' => 'Vui lòng nhập số tiền',
            'money.numeric' => 'Số tiền phải là số',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            if($request->type == 'add'){
                $type = "cộng";
                DB::table('users')->where('username', $request->username)->increment('total_money', $request->money);
            }elseif($request->type == 'minus'){
                DB::table('users')->where('username', $request->username)->decrement('total_money', $request->money);
                $type = "trừ";
            }
            if($request->note == null){
                $note = 'Admin đã ' . $type . ' ' . number_format($request->money) . 'Đ vào tài khoản ' . $request->username;
            }
            else{
                $note = $request->note;
            }
            DB::table('log_site')->insert([
                'username' => Auth::user()->username,
                'note' => $note,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
            DB::table('site_admin')->insert([
                'username' => Auth::user()->username,
                'note' => $note,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thành công',
            ]);
        }
    }

    public function deleteUser(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'numeric|exists:users,id',
        ],[
            'id.numeric' => 'ID tài khoản phải là số',
            'id.exists' => 'Tài khoản không tồn tại',
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error', $validator->errors()->first());
        }else{
            DB::table('users')->where('id', $request->id)->delete();
            DB::table('site_admin')->insert([
                'username' => Auth::user()->username,
                'note' => 'Admin đã xóa tài khoản ' . $request->id,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
            return redirect()->back()->with('success', 'Xóa tài khoản thành công');
        }
    }

    public function updateNoticeModal(Request $request){
        $validator = Validator::make($request->all(), [
            'notice_modal' => 'required|string',
        ],[
            'notice_modal.required' => 'Vui lòng nhập nội dung thông báo',
            'notice_modal.string' => 'Nội dung thông báo phải là chuỗi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            DB::table('site_options')->where('key', 'thongbao')->update(['value' => $request->notice_modal]);
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thành công',
            ]);
        }
    }
    public function updateNotice(){
        $validator = Validator::make(request()->all(),[
            'notice' => 'required|string',
        ],[
            'notice.required' => 'Vui lòng nhập nội dung thông báo',
            'notice.string' => 'Nội dung thông báo phải là chuỗi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            DB::table('notice_sys')->insert([
                'title' => Auth::user()->username,
                'content' => request()->notice,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thành công',
            ]);
        }
    }
    public function deleteNotice(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'numeric|exists:notice_sys,id',
        ],[
            'id.numeric' => 'ID thông báo phải là số',
            'id.exists' => 'Thông báo không tồn tại',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else{
            DB::table('notice_sys')->where('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Xóa thông báo thành công');
        }
    }
    public function updateAdmin(Request $request){
        $validator = Validator::make($request->all(),[
            'admin_name' => 'required|string',
            'facebook_admin' => 'required|string',
            'zalo_admin' => 'required|string',
            'uid_admin' => 'required|numeric',
            'token_subgiare' => 'required|string',
        ],[
            'admin_name.required' => 'Vui lòng nhập tên admin',
            'admin_name.string' => 'Tên admin phải là chuỗi',
            'facebook_admin.required' => 'Vui lòng nhập facebook admin',
            'facebook_admin.string' => 'Facebook admin phải là chuỗi',
            'zalo_admin.required' => 'Vui lòng nhập zalo admin',
            'zalo_admin.string' => 'Zalo admin phải là chuỗi',
            'uid_admin.required' => 'Vui lòng nhập UID admin',
            'uid_admin.numeric' => 'UID admin phải là số',
            'token_subgiare.required' => 'Vui lòng nhập token subgiare',
            'token_subgiare.string' => 'Token subgiare phải là chuỗi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            DB::table('site_options')->where('key', 'admin_name')->update(['value' => $request->admin_name]);
            DB::table('site_options')->where('key', 'facebook_admin')->update(['value' => $request->facebook_admin]);
            DB::table('site_options')->where('key', 'zalo_admin')->update(['value' => $request->zalo_admin]);
            DB::table('site_options')->where('key', 'uid_admin')->update(['value' => $request->uid_admin]);
            DB::table('site_options')->where('key', 'token_subgiare')->update(['value' => $request->token_subgiare]);
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thành công',
            ]);
        }
    }

    public function successOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'numeric|exists:client_orders,id',
        ],[
            'id.numeric' => 'ID đơn hàng phải là số',
            'id.exists' => 'Đơn hàng không tồn tại',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else{
            DB::table('client_orders')->where('id', $request->id)->update(['status' => 'Start']);
            return redirect()->back()->with('success', 'Cập nhật thành công');
        }
    }

    public function cancerOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'numeric|exists:client_orders,id',
        ],[
            'id.numeric' => 'ID đơn hàng phải là số',
            'id.exists' => 'Đơn hàng không tồn tại',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else{
            DB::table('client_orders')->where('id', $request->id)->update(['status' => 'cancel']);
            DB::table('site_admin_log')->insert([
                'username' => Auth::user()->username,
                'note' => 'Admin đã hủy 1 đơn hàng',
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
            return redirect()->back()->with('success', 'Hủy đơn hàng thành công');
        }
    }

    public function updateCharge(Request $request){
        $validator = Validator::make($request->all(), [
            'parther_id' => 'required|string',
            'parther_key' => 'required|string',
        ],[
            'parther_id.required' => 'Vui lòng nhập ID đối tác',
            'parther_id.string' => 'ID đối tác phải là chuỗi',
            'parther_key.required' => 'Vui lòng nhập key đối tác',
            'parther_key.string' => 'Key đối tác phải là chuỗi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            DB::table('site_options')->where('key', 'parther_id')->update(['value' => $request->parther_id]);
            DB::table('site_options')->where('key', 'parther_key')->update(['value' => $request->parther_key]);
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thành công',
            ]);
        }
    }

    public function addCharge(Request $request){
        $validator = Validator::make($request->all(), [
            'type_banking' => 'required|string',
            'logo' => 'required|string',
            'name_account' => 'required|string',
            'number_account' => 'required|string',
            'min_bank' => 'required|string',
            'token' => 'string',
            'notice_bank' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            //check type banking exist
            $check = DB::table('bank_accounts')->where('type', $request->type_banking)->first();
            if($check){
                return response()->json([
                    'status' => false,
                    'message' => 'Loại ngân hàng đã tồn tại',
                ]);
            }else{
                DB::table('bank_accounts')->insert([
                    'type' => $request->type_banking,
                    'name' => $request->name_account,
                    'number' => $request->number_account,
                    'min_bank' => $request->min_bank,
                    'token' => $request->token,
                    'notice' => $request->notice_bank,
                    'logo' => $request->logo,
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Thêm thành công',
                ]);
            }
        }
    }
    public function deleteCharge(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'numeric|exists:bank_accounts,id',
        ],[
            'id.numeric' => 'ID phải là số',
            'id.exists' => 'Tài khoản không tồn tại',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else{
            DB::table('bank_accounts')->where('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        }
    }

    public function blockIp(Request $request){
        $validator = Validator::make($request->all(), [
            'ip_address' => 'required|string',
            'reason' => 'required|string',
        ],[
            'ip_address.required' => 'Vui lòng nhập địa chỉ IP',
            'ip_address.string' => 'Địa chỉ IP phải là chuỗi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            //check ip exist
            $check = DB::table('ip_blocks')->where('ip_address', $request->ip_address)->first();
            if($check){
                return response()->json([
                    'status' => false,
                    'message' => 'Địa chỉ IP đã tồn tại',
                ]);
            }else{
                DB::table('ip_blocks')->insert([
                    'ip_address' => $request->ip_address,
                    'reason' => $request->reason,
                    'created_at' => Carbon::now()->toDateTimeString(),
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Thêm thành công',
                ]);
            }
        }
    }

}
