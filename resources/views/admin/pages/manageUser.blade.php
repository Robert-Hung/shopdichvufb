@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách thành viên</h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                    @endif
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
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>
                                        @if ($item->role == 1)
                                            <span class="badge badge-success">Thành viên</span>
                                        @elseif ($item->role == 2)
                                            <span class="badge badge-warning">Cộng tác viên</span>
                                        @elseif ($item->role == 3)
                                            <span class="badge badge-danger">Đại lí</span>
                                        @elseif ($item->role == 4)
                                            <span class="badge badge-info">Nhà phân phối</span>
                                        @else
                                            <span class="badge badge-primary">Quản trị viên</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->total_money) }}</td>
                                    <td>{{ number_format($item->total_charge) }}</td>
                                    <td>{{ number_format($item->total_minus) }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.delete.user', $item->id) }}" class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cộng/Trừ tiền</h4>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.update.user') }}" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Type</label>
                                </div>
                                <div class="col-9">
                                    <select name="type" id="" class="form-control">
                                        <option value="add">Cộng</option>
                                        <option value="minus">Trừ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Username</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="username" class="form-control" placeholder="Nhập username">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Số tiền</label>
                                </div>
                                <div class="col-9">
                                    <input type="numbeer" name="money" class="form-control" placeholder="Nhập số tiền">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Nội dung</label>
                                </div>
                                <div class="col-9">
                                    <textarea name="note" class="form-control" id="" cols="10" rows="4" placeholder="Admin cộng tiền"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-plus"></i>
                                Thực hiện
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
