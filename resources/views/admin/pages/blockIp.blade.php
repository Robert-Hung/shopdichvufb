@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Block IP</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.block_ip.post') }}" request-ajax="lbd" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="ip" class="form-label">IP cần block</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" id="ip" name="ip_address" placeholder="Nhập ip cần chặn" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="reason" class="form-label">Lý do</label>
                                </div>
                                <div class="col-9">
                                    <textarea name="reason" id="reason" placeholder="Nhập lý do bạn chặn" class="form-control" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Chặn ip này</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lịch sử ip bạn đã chặn</h3>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>IP</th>
                                <th>Lí do</th>
                                <th>Ngày chặn</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection