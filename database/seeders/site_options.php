<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class site_options extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_options')-> insert([
            ['key' => 'domain', 'value' => 'localhost'],
            ['key' => 'transfer_code', 'value' => 'vls'],
            ['key' => 'token_baostart' , 'value' => 'null'],
            ['key' => 'token_subgiare' , 'value' => 'null'],
            ['key' => 'parther_id' , 'value' => 'null'],
            ['key' => 'parther_key' , 'value' => 'null'],
            ['key' => 'thongbao', 'value' => 'chào bạn đến với website của tôi'],
            ['key' => 'status_web', 'value' => 'ON'],
            ['key' => 'describe', 'value' => 'viplikesubs - Hỗ Trợ Kinh Doanh Online Với Đội Ngũ Giàu Kinh Nghiệm. Bảo Hành Khi Sử Dụng. Dịch vụ uy tín được đánh giá tốt trong năm 2022'],
            ['key' => 'key_word', 'value' => 'muasubngon , muasubviet, Tăng like Facebook, tuongtaccheo, traodoisub, tăng like, tăng follow facebook, tiktok, instagram, miễn phí, tương tác chéo, trao đổi sub. Hệ thống mua like uy tín, Tăng like giá rẻ , Dịch vụ tăng like tăng sub giá rẻ, tăng view vi'],
            ['key' => 'favicon_web', 'value' => 'none'],
            ['key' => 'send_mail' , 'value' => 'true'],
            ['key' => 'intro_img', 'value' => 'none'],
            ['key' => 'token_facebook', 'value' => 'sss'],
            ['key' => 'api_telegram_bot', 'value' => 'ss'],
            ['key' => 'id_chat_tel', 'value' => 'ON'],
            ['key' => 'charge_level_TV', 'value' => '5'],
            ['key' => 'charge_level_CTV', 'value' => '5'],
            ['key' => 'charge_level_DL', 'value' => '5'],
            ['key' => 'charge_level_NPP', 'value' => '5'],
            ['key' => 'discount_TV', 'value' => '5'],
            ['key' => 'discount_CTV', 'value' => '5'],
            ['key' => 'discount_DL', 'value' => '5'],
            ['key' => 'discount_NPP', 'value' => '0'],
            ['key' => 'card_discount', 'value' => '5'],
            ['key' => 'admin_name', 'value' => 'Lương Bình Dương'],
            ['key' => 'facebook_admin', 'value' => 'https://www.facebook.com/luongbinhduong.mOzil'],
            ['key' => 'zalo_admin', 'value' => 'https://zalo.me/0963725258'],
            ['key' => 'uid_admin', 'value' => '123456789'],
            ['key' => 'send_mail', 'value' => 'false']
        ]);
    }
}
