@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách nạp ATM</h3>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>username</th>
                                <th>Cấp bậc</th>
                                <th>Số tiền</th>
                                <th>Tổng nạp</th>
                                <th>Tổng trừ</th>
                                <th>Thờ gian tạo</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>

                    </table>
                </div>

            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách nạp thẻ cào</h3>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>username</th>
                                <th>Loại thẻ</th>
                                <th>Mệnh giá</th>
                                <th>serial</th>
                                <th>code</th>
                                <th>Thực nhận</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thecao as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->card_type }}</td>
                                    <td>{{ $item->card_price }}</td>
                                    <td>{{ $item->serial }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->thucnhan }}</td>
                                    <td>
                                        @if($item->status == 0)
                                            <span class="badge badge-warning">Chờ xử lý</span>
                                        @elseif($item->status == 1)
                                            <span class="badge badge-success">Thẻ đúng</span>
                                        @elseif($item->status == 2)
                                            <span class="badge badge-danger">Thẻ sai</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
