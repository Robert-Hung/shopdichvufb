@extends('layouts.app')

@section('content')
    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Tài khoản của tôi</h4>
        </div>
    </div>
    <!--End Page header-->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-3 col-md-12 col-lg-12">
            <div class="card user-pro-list overflow-hidden">
                <div class="card-body">
                    <div class="text-center">
                        <div class="widget-user-image mx-auto text-center">
                            <img class="avatar avatar-xxl brround" alt="img"
                                src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->username }}">
                        </div>
                        <div class="pro-user mt-3">
                            <h5 class="pro-user-username text-dark mb-1 fs-16">{{ Auth::user()->name }}</h5>
                            <h6 class="pro-user-desc text-muted fs-12">
                                @if (Auth::user()->role == 1)
                                    Thành viên
                                @elseif (Auth::user()->role == 2)
                                    Cộng tác viên
                                @elseif (Auth::user()->role == 3)
                                    Đại lí
                                @endif
                            </h6>
                        </div>
                    </div>
                    <h5 class="mb-2 mt-4 font-weight-semibold">Thông tin cơ bản</h5>
                    <div class="table-responsive">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-md-12 col-lg-12">
            <div class="tab-menu-heading hremp-tabs p-0 ">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="ml-4"><a href="#tab5" class="active" data-toggle="tab">Thông tin tài
                                khoản</a>
                        </li>
                        <li><a href="#tab6" data-toggle="tab">Thay đổi mật khẩu</a></li>
                        <li><a href="#tab7" data-toggle="tab">Bảo mật</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5">
                        <div class="card-body">
                            <h5 class="mb-4 font-weight-semibold">Thông tin của bạn</h5>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="#" class="form-label">Họ tên</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="#" class="form-label">Tài khoản</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ Auth::user()->username }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="#" class="form-label">Cấp độ</label>
                                        <input type="text" class="form-control" disabled
                                            value="@if (Auth::user()->role == 1) Thành viên @elseif (Auth::user()->role == 2) Cộng tác viên @elseif (Auth::user()->role == 3) Đại lí @endif">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="#" class="form-label">Email</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="#" class="form-label">Số dư</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ number_format(Auth::user()->total_money) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="#" class="form-label">Thời gian tham gia</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ Auth::user()->created_at }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                    <div class="card mb-xl-0 box-shadow-0 text-center  bg-secondary-transparent">
                                        <div class="card-body text-center">
                                            <p class=" mb-1">Tổng nạp</p>
                                            <h3 class="mb-1">{{ number_format(Auth::user()->total_topup) }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                    <div class="card mb-xl-0 box-shadow-0 text-center  bg-success-transparent">
                                        <div class="card-body text-center">
                                            <p class=" mb-1">Tổng thanh toán</p>
                                            <h3 class="mb-1">{{ number_format(Auth::user()->paid) }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                    <div class="card mb-xl-0 box-shadow-0 text-center  bg-danger-transparent">
                                        <div class="card-body text-center">
                                            <p class=" mb-1">Tổng trừ</p>
                                            <h3 class="mb-1">{{ number_format(Auth::user()->total_minus) }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab6">
                        <div class="card-body">
                            <h5 class="mb-4 font-weight-semibold">Thay đổi mật khẩu</h5>
                            <form action="{{ route('account.change-password') }}" method="POST" request-ajax="lbd" href="{{ route('auth.login') }}">
                                <div class="form-group">
                                    <label for="#" class="form-label">Mật khẩu cũ</label>
                                    <input type="password" class="form-control" name="old_password"
                                        placeholder="Mật khẩu cũ">
                                </div>
                                <div class="form-group">
                                    <label for="#" class="form-label">Mật khẩu mới</label>
                                    <input type="password" class="form-control" name="new_password"
                                        placeholder="Mật khẩu mới">
                                </div>
                                <div class="form-group">
                                    <label for="#" class="form-label">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" name="confirm_password"
                                        placeholder="Xác nhận mật khẩu">
                                </div>
                                <div class="submit">
                                    <button type="submit" class="btn btn-primary btn-block">Thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab7">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h4>Đang cập nhật</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-12 col-md-12 col-ld-12 mt-3">
            <div class="">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <div class="card-title">Lịch sử đăng nhập</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">ID</th>
                                        <th class="wd-15p border-bottom-0">Thời gian</th>
                                        <th class="wd-20p border-bottom-0">Nội dung</th>
                                        <th class="wd-15p border-bottom-0">Thiết bị</th>
                                        <th class="wd-15p border-bottom-0">Browser</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($login as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->content }}</td>
                                            <td>{{ $item->device }}</td>
                                            <td>{{ $item->browser }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row-->
@endsection
@section('scripts')
		<!-- INTERNAL Data tables -->
		<script src="{{ asset('') }}assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/jszip.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/buttons.html5.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/buttons.print.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/buttons.colVis.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/dataTables.responsive.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/responsive.bootstrap4.min.js"></script>
		<script src="{{ asset('') }}assets/js/datatables.js"></script>
@endsection