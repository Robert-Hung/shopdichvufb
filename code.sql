-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 13, 2022 lúc 03:15 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `code`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_bank` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notice` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `client_orders`
--

CREATE TABLE `client_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soluong` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_order` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_money` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prices` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_order` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `server_order` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reaction` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_order` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_order` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ghichu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_service` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_bank`
--

CREATE TABLE `history_bank` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_type` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_price` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thucnhan` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tranid` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ip_blocks`
--

CREATE TABLE `ip_blocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login_history`
--

CREATE TABLE `login_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log_site`
--

CREATE TABLE `log_site` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notice_sys`
--

CREATE TABLE `notice_sys` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_server`
--

CREATE TABLE `service_server` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_server` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `server_service` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate_server` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_server` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notice` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_server` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_server` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reaction` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_server` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_server` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `site_admin`
--

CREATE TABLE `site_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `site_options`
--

CREATE TABLE `site_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `site_options`
--

INSERT INTO `site_options` (`id`, `key`, `value`) VALUES
(1, 'domain', 'localhost'),
(2, 'transfer_code', 'lbd'),
(3, 'token_baostart', 'null'),
(4, 'token_subgiare', 'eyJpdiI6IkNjTklCd2U5MERYWWFiNnA4RTc5U3c9PSIsInZhbHVlIjoiWlg3U1B0STVRNG1RemY3QXVKNXBidXdlYTArYzRHdmFZbHZBOHlGdHc2dWpmajFJcGJWeis4UWZVUzcyWWgvUiIsIm1hYyI6IjI0YzY2MDA2MGUyZmZjMjMxY2E2NzQzYzNlZmNiYTkwOWZmOGJlYWY0ZjZjOGEzZDFmZGZkODMwNzBiZTUyNTAiLCJ0YWciOiIifQ'),
(5, 'parther_id', 'null'),
(6, 'parther_key', 'null'),
(7, 'thongbao', 'chào bạn đến với website của tôi'),
(8, 'status_web', 'ON'),
(9, 'describe', 'viplikesubs - Hỗ Trợ Kinh Doanh Online Với Đội Ngũ Giàu Kinh Nghiệm. Bảo Hành Khi Sử Dụng. Dịch vụ uy tín được đánh giá tốt trong năm 2022'),
(10, 'key_word', 'muasubngon , muasubviet, Tăng like Facebook, tuongtaccheo, traodoisub, tăng like, tăng follow facebook, tiktok, instagram, miễn phí, tương tác chéo, trao đổi sub. Hệ thống mua like uy tín, Tăng like giá rẻ , Dịch vụ tăng like tăng sub giá rẻ, tăng view vi'),
(11, 'favicon_web', 'none'),
(12, 'send_mail', 'true'),
(13, 'intro_img', 'none'),
(14, 'token_facebook', 'sss'),
(15, 'api_telegram_bot', 'ss'),
(16, 'id_chat_tel', 'ON'),
(17, 'charge_level_TV', '5'),
(18, 'charge_level_CTV', '200000'),
(19, 'charge_level_DL', '1500000'),
(20, 'charge_level_NPP', '20000000'),
(21, 'discount_TV', '5'),
(22, 'discount_CTV', '5'),
(23, 'discount_DL', '5'),
(24, 'discount_NPP', '0'),
(25, 'card_discount', '5'),
(26, 'admin_name', 'Lương Bình Dương'),
(27, 'facebook_admin', 'https://www.facebook.com/luongbinhduong.mOzil'),
(28, 'zalo_admin', 'https://zalo.me/0963725258'),
(29, 'uid_admin', '123456789'),
(30, 'send_mail', 'false');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_money` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_charge` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_minus` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banned` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_banned` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_code` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `client_orders`
--
ALTER TABLE `client_orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `history_bank`
--
ALTER TABLE `history_bank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ip_blocks`
--
ALTER TABLE `ip_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `log_site`
--
ALTER TABLE `log_site`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notice_sys`
--
ALTER TABLE `notice_sys`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`(768));

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `service_server`
--
ALTER TABLE `service_server`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `site_admin`
--
ALTER TABLE `site_admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `site_options`
--
ALTER TABLE `site_options`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `client_orders`
--
ALTER TABLE `client_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `history_bank`
--
ALTER TABLE `history_bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ip_blocks`
--
ALTER TABLE `ip_blocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `log_site`
--
ALTER TABLE `log_site`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `notice_sys`
--
ALTER TABLE `notice_sys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `service_server`
--
ALTER TABLE `service_server`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `site_admin`
--
ALTER TABLE `site_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `site_options`
--
ALTER TABLE `site_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
