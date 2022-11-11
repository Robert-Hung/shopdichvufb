<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok</title>
  <meta name="csrf-token" name="{{ csrf_token() }}">
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


  <!-- Favicons -->
  <link href="{{ asset('') }}landing/assets/img/favicon.png" rel="icon">
  <link href="{{ asset('') }}landing/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('') }}landing/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset('') }}landing/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('') }}landing/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('') }}landing/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('') }}landing/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset('') }}landing/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('') }}landing/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('') }}landing/assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">VIPLIKESUB</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="{{ asset('') }}landing/assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Trang chủ</a></li>
          <li class="dropdown"><a href="#"><span>Dịch vụ nổi bật</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Instagram</a></li>
              <li><a href="#">Tiktok</a></li>
              <li><a href="#">Youtube</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Liên hệ hỗ trợ</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#" onclick="window.open('https://www.facebook.com/luongbinhduong.mOzil')">Facebook</a></li>
              <li><a href="#" onclick="window.open('https://zalo.me/0963725258')">Zalo</a></li>
            </ul>
          </li>
          <li><a class="getstarted scrollto" href="{{ route('auth.login') }}">Đăng nhập</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Tạo hiệu ứng cho sự nổi tiếng của bạn</h1>
          <h2>Hệ thống chuyên cung cấp các dịch vụ tăng Like, Follow, Share, Comment, View Video,... cho các Mạng xã hội như Facebook, Instagram, Tiktok...</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="{{ route('auth.login') }}" class="btn-get-started scrollto">Bắt đầu ngay</a>
            <a href="{{ route('auth.register') }}" class="glightbox btn-watch-video"><span>Đăng kí</span></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="{{ asset('') }}landing/assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </d
iv>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div clas"container" data-aos="fade-up">

        <div class="section-title">
          <h2>Cấp bậc ưu đãi khách hàng</h2>
        </div>

        <div class="row">
          <div class="col-xl-4 col-md-12 align-items-center mt-4 mt-md-0 text-center" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <h4><a href="">Thành viên</a></h4>
              <h4 class="badge badge-danger mt-3 text-danger">0 Đ</h4>
              <p class="mt-3">Không có ưu đãi</p>
            </div>
          </div>


          <div class="col-xl-4 col-md-12 align-items-center mt-4 mt-md-0 text-center" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <h4><a href="">Cộng tác viên</a></h4>
              <h4 class="badge badge-danger mt-3 text-danger">200,000 Đ</h4>
              <p class="mt-3">Có ưu đãi giá dịch vụ cộng tác viên</p>
            </div>
          </div>
          <div class="col-xl-4 col-md-12 align-items-center mt-4 mt-md-0 text-center" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <h4><a href="">Đại lý</a></h4>
              <h4 class="badge badge-danger mt-3 text-danger">20,000,000 Đ</h4>
              <p class="mt-3">Có rất nhiều ưu đãi giá dịch vụ đại lý</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Lương Bình Dương</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('') }}landing/assets/vendor/aos/aos.js"></script>
  <script src="{{ asset('') }}landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('') }}landing/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset('') }}landing/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('') }}landing/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('') }}landing/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="{{ asset('') }}landing/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('') }}landing/assets/js/main.js"></script>

</body>

</html>
