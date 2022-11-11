@extends('layouts.app')

@section('content')
    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title"><span class="font-weight-normal text-muted ml-2">Trang chủ</span></h4>
        </div>
        <div class="page-rightheader ml-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
                <div class="d-flex">
                    <div class="header-datepicker mr-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="feather feather-clock"></i>
                                </div>
                            </div><!-- input-group-prepend -->
                            <input id="tpBasic" type="text" placeholder="{{ date('H:i:s') }}"
                                class="form-control input-small">
                        </div>
                    </div><!-- wd-150 -->
                </div>
            </div>
        </div>
    </div>
    <!--End Page header-->

    <!--Row-->
    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-left"> <span class="fs-14 font-weight-semibold"> Số dư </span>
                                        <h3 class="mb-0 mt-1 mb-2">{{ number_format(Auth::user()->total_money) }} Đ</h3>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="icon1 bg-success my-auto  float-right"> <i
                                            class="feather feather-dollar-sign"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-left"> <span class="fs-14 font-weight-semibold">Tổng nạp</span>
                                        <h3 class="mb-0 mt-1 mb-2">{{ number_format(Auth::user()->total_charge) }} Đ</h3>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="icon1 bg-primary my-auto  float-right"> <i
                                            class="feather feather-credit-card"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-left"> <span class="fs-14 font-weight-semibold">Tổng trừ</span>
                                        <h3 class="mb-0 mt-1  mb-2">{{ number_format(Auth::user()->total_minus) }} Đ</h3>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="icon1 bg-secondary brround my-auto  float-right"> <i
                                            class="feather feather-shopping-cart"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-md-12 col-lg-12">
            <div class="mb-3">
                <div class="card-header border-bottom-0 pt-2 pl-0">
                    <h4 class="card-title">Hệ thống thông báo</h4>
                </div>
                <ul class="list-group lg-alt chat-conatct-list" id="ChatList">
                    @foreach ($thongbao as $item)
                    <li class="list-group-item media p-4 border-top border-2 mt-2">
                        <div class="float-left pr-2">
                            <span class="avatar avatar-md brround" style="background-image: url({{ asset('images/users/logo.jpg') }})">
                                <span class="avatar-status bg-green"></span>
                            </span>
                        </div>
                        <div class="media-body">
                            <div class="list-group-item-heading  font-weight-semibold">Lương Bình Dương</div>
                            <h5 class="mt-4 list-group-item-text text-muted">{{ $item->content }}</h4>
                        </div>
                        <span class="chat-time text-muted">{{ $item->created_at }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-xl-4 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <h4 class="card-title">Nạp tiền tài khoản</h4>
                </div>
                <div class="card-body">
                    <div class="align-item-center text-center">
                        <img src="{{ asset('images/client/piggy-bank.svg') }}" class="rouned w-25" alt="">
                        <div class="mt-5">
                            <h5>Bạn sẽ nhận được nhiều ưu hơn hơn như: giảm giá dịch vụ ...</h5>
                        </div>
                        <a href="#" class="btn btn-primary">Nạp tiền ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_show">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Hệ thống thông báo</h6><button aria-label="Close" class="close"
                        data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h6>{{ $modal_notice->value }}</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Tôi đã đọc</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection
