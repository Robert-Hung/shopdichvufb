<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<!-- Title -->
		<title>Đăng nhâp tài khoản</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | {{ url('') }}" />
        <meta name="keywords" content="like, sub, share, vip like, buff mắt, tăng follow, mua like, mua sub, sub rẻ, hack like, hack sub, hack follow, tăng like, tăng follow, tăng share, tăng comment, chéo like, chéo sub, shop sub" />
        <meta property="og:description" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | {{ url('') }}" />
        <meta name="copyright" content="" />
        <meta name="robots" content="index, follow" />
        <meta name='revisit-after' content='1 days' />
        <meta http-equiv="content-language" content="vi" />
        <meta property="og:url" content="{{ url('') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | {{ url('') }}" />
        <meta property="og:locale" content="vi_VN" />
        <meta property="og:image" content="/assets/images/home-banner.jpg">
        <meta property="fb:app_id" content="" />
        <meta name="twitter:title" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | {{ url('') }}">
        <meta name="twitter:description" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | {{ url('') }}">
      
        <!--Favicon -->
		<link rel="icon" href="{{ asset('') }}assets/images/brand/favicon.ico" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{ asset('') }}assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="{{ asset('') }}assets/css/style.css" rel="stylesheet" />
		<link href="{{ asset('') }}assets/css/dark.css" rel="stylesheet" />
		<link href="{{ asset('') }}assets/css/skin-modes.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{ asset('') }}assets/plugins/animated/animated.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{ asset('') }}assets/plugins/icons/icons.css" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="{{ asset('') }}assets/plugins/select2/select2.min.css" rel="stylesheet" />

		<!-- P-scroll bar css-->
		<link href="{{ asset('') }}assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

        

        <!-- INTERNAL Switcher css -->
		<link href="{{ asset('') }}assets/switcher/css/switcher.css" rel="stylesheet"/>
		<link href="{{ asset('') }}assets/switcher/demo.css" rel="stylesheet"/>

	</head>

	<body>

		<div class="page login-bg">
			<div class="page-single">
				<div class="container">
					<div class="row">
						<div class="col mx-auto">
							<div class="row justify-content-center">
								<div class="col-md-7 col-lg-5">
									<div class="card">
										<div class="p-4 pt-6 text-center">
											<h1 class="mb-2">Đăng nhập</h1>
											<p class="text-muted">Đăng nhập tài khoản của bạn</p>
											@if(session('errors'))
												<div class="alert alert-danger" role="alert"><button  class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ session('errors') }}</div>
											@elseif (session('success'))
												<div class="alert alert-success" role="alert"><button  class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ session('success') }}</div>
											@endif
										</div>
										<form class="card-body pt-3" action="{{ route('auth.login.post') }}" method="POST">
											<div id="callback"></div>
											<div class="form-group">
												<label class="form-label">Tên tài khoản</label>
												<input class="form-control form-control-lg" name="username" placeholder="Nhập tên tài khoản của bạn" type="text">
											</div>
											<div class="form-group">
												<label class="form-label">Mật khẩu</label>
												<input class="form-control form-control-lg" name="password" placeholder="Nhập mật khẩu của bạn" type="password">
											</div>
											<div class="submit">
												<button type="submit" class="btn btn-primary mb-1 btn-block btn-lg" callback="rescallback" >Đăng nhập</button>
											</div>
											<div class="text-center mt-3">
												<p class="mb-2"><a href="{{ route('auth.forgot-password') }}">Bạn quên mật khẩu</a></p>
												<p class="text-dark mb-0">Bạn chưa có tài khoản?<a class="text-primary ml-1" href="{{ route('auth.register') }}">Đăng kí</a></p>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


        <!-- Jquery js-->
		<script src="{{ asset('') }}assets/plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap4 js-->
		<script src="{{ asset('') }}assets/plugins/bootstrap/popper.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        

		<!-- Select2 js -->
		<script src="{{ asset('') }}assets/plugins/select2/select2.full.min.js"></script>

		<!-- P-scroll js-->
		<script src="{{ asset('') }}assets/plugins/p-scrollbar/p-scrollbar.js"></script>

		<!-- Custom js-->
		<script src="{{ asset('') }}assets/js/custom.js"></script>

        <!-- Switcher js -->
		<script src="{{ asset('') }}assets/switcher/js/switcher.js"></script>
		<script src="{{ asset('assets/js/function.js?lbd=') }}{{ time() }}"></script>
	</body>
</html>
