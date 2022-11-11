@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chỉnh sửa thông báo đẩy</h4>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.update_notice_modal') }}" method="POST">
                        <div class="form-group">
                            <label for="">Tiêu đề</label>
                            <input type="text" class="form-control" name="notice_modal" value="{{ $notice_modal->value }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Nhập thông báo</h4>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.update_notice') }}" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Nhập thông báo</label>
                                </div>
                                <div class="col-9">
                                    <textarea name="notice" id="" cols="30" rows="5" class="form-control" placeholder="Nhập thông báo của bạn"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách thông báo</h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Người đăng</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notice as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <textarea name="" id="" cols="20" rows="2" class="form-control" disabled>{{ $item->content }}</textarea>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td><a href="{{ route('admin.delete_notice', $item->id) }}" class="btn btn-danger">Xóa</a></td>
                                </tr>
                            @endforeach
                    </table>
                </div>

            </div>

        </div>
    </div>
@endsection