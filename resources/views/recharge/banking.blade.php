@extends('layouts.app')

@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title"><span class="font-weight-normal text-muted ml-2">Nạp ATM</span></h4>
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
    <div class="row">
        <div class="col-lg-6 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-6">
                        <a href="#" class="btn btn-primary btn-block py-2">Chuyển khoản</a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('recharge.cards') }}" class="btn btn-outline-primary btn-block py-2">Thẻ cào</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    - Bạn vui lòng chuyển khoản chính xác nội dung để được cộng tiền nhanh nhất.<br>
                                    - Nếu sau 10 phút từ khi tiền trong tài khoản của bạn bị trừ mà vẫn chưa được cộng tiền
                                    vui liên hệ Admin để được hỗ trợ. <br>
                                    - Vui lòng không nạp từ bank khác qua bank này (tránh lỗi).
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        @foreach ($bank_list as $item)
                        <div class="col-xl-6">
                            <div class="card bg-info text-white">
                                <div class="card-header text-center allgin-item-center">
                                    <img src="{{ $item->logo }}" style="width: 80px" alt="">
                                </div>
                                <div class="card-body">
                                    <p class="mt-1">Số tài khoản:
                                        <a href="javascript:;" onclick="coppy('stk{{ $item->id }}');">
                                            <b class="text-white" id="stk{{ $item->id }}">{{ $item->number }}</b>
                                            <i class="fa fa-clone"></i></a></h4>
                                    </p>
                                    <p class="mt-1">Chủ tài khoản:
                                        <span class="badge badge-danger"> {{ $item->name }} </span> </p>
                                    <p class="mt-1">Nạp tối thiểu: <span class="badge badge-warning">{{ number_format($item->min_bank) }}</span> </p>
                                        <p class="mt-1">Chú ý: {{ $item->notice }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mt-1">
                        <h5 class="card-title" id="code" code="hahah2">Nội dung chuyển khoản</h5>
                        <div class="alert text-white bg-info" role="alert">
                            <h4 class="text-white bg-heading font-weight-semi-bold text-center py-3">
                                <a href="javascript:;" onclick="coppy('transfer_code');">
                                    <b id="transfer_code">{{ Auth::user()->transfer_code }}</b>
                                    <i class="fa fa-clone"></i></a>
                            </h4>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <h6 class="card-title">- Cố tình nạp dưới mức nạp không hỗ trợ <br>
                                    - Nạp sai cú pháp, sai số tài khoản, sai ngân hàng sẽ bị trừ 20% phí giao dịch. Vd: nạp 100k sai nội dung sẽ chỉ nhận được 80k coin và phải liên hệ admin để cộng tay.</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('script')
@endsection
