@extends('layouts.app')

@section('content')
    
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">{{ $title }}</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thành viên</h4>
            </div>
            <div class="card-body">
               <h3> Số dư 0 VNĐ</h3>

                <span class="text-danger">Không có ưu đãi</span>
                <div class="mt-2 text-center">
                    <a href="#" class="btn btn-primary">Nâng cấp</a>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cộng tác viên</h4>
            </div>
            <div class="card-body">
               <h3> Số dư {{ $CTV->value }} VNĐ</h3>

                <span class="text-warning"> Cấp bậc này sẽ được giảm giá các dịch vụ và có thể tạo website riêng.</span>
                <div class="mt-2 text-center">
                    <a href="#" class="btn btn-primary">Nâng cấp</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Nhà phân phối</h4>
            </div>
            <div class="card-body">
               <h3> Số dư {{ $NPP->value }} VNĐ</h3>

                <span class="text-success">Cấp bậc này sẽ được giảm giá dịch vụ, tạo website riêng, hỗ trợ riêng, ...</span>
                <div class="mt-2 text-center">
                    <a href="#" class="btn btn-primary">Nâng cấp</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection