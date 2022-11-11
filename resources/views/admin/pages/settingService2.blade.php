@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                    @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm Dịch vụ facebook (api báo start)</h4>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.service.facebook.add-2') }}" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Loại dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <select name="type_service_facebook" id="" class="form-control">
                                        <option value="">--Chọn dịch vụ--</option>
                                        <option value="like-gia-re">Like giá rẻ </option>
                                        <option value="like-chat-luong">Like chất lượng </option>
                                        <option value="like-binh-luan">Link bình luận </option>
                                        <option value="binh-luan">Tăng bình luận </option>
                                        <option value="follow">Tăng theo dõi</option>
                                        <option value="like-page">Tăng like page</option>
                                        <option value="mem-group">Tăng mem group</option>
                                        <option value="view-video">Tăng view video</option>
                                        <option value="mat-live">Tăng mắt live</option>
                                        <option value="share">Tăng share</option>
                                        <option value="view-story">Tăng view story</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Máy chủ</label>
                                </div>
                                <div class="col-9">
                                    <select name="server_facebook" id="" class="form-control">
                                        <option value="">--Chọn máy chủ--</option>
                                        {{-- for loop server 1 to server 20 --}}
                                        @for($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}">Server {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Nhập package name</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="package_name" class="form-control" placeholder="Nhập package name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Giá dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="rate_facebook" class="form-control" placeholder="Nhập giá dịch vụ">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Tiêu đề dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="title_facebook"  class="form-control" placeholder="Nhập tiêu đề dịch vụ">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Thông báo dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="notice"  class="form-control" placeholder="Nhập thông báo dịch vụ">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Hiện cảm xúc server</label>
                                </div>
                                <div class="col-9">
                                    <select name="reaction" id="" class="form-control">
                                        <option value="">-- Chọn hiện cảm xúc --</option>
                                        <option value="true">Hiện</option>
                                        <option value="false">Ẩn</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><button type="submit" class="btn btn-primary btn-block">Thêm dịch vụ</button></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm Dịch vụ instagram</h4>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.service.instagram.add-2') }}" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Loại dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <select name="type_service_instagram" id="" class="form-control">
                                        <option value="">--Chọn dịch vụ--</option>
                                        <option value="like-instagram">Tăng like </option>
                                        <option value="sub-instagram">Tăng sub </option>
                                        <option value="cmt-instagram">Tăng comment </option>
                                        <option value="view-instagram">Tăng view </option>
                                        <option value="vip-like-instagram">Vip like </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Máy chủ</label>
                                </div>
                                <div class="col-9">
                                    <select name="server_instagram" id="" class="form-control">
                                        <option value="">--Chọn máy chủ--</option>
                                        {{-- for loop server 1 to server 20 --}}
                                        @for($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}">Server {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Package_name</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="package_name" class="form-control" placeholder="Nhập package name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Giá dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="rate_instagram" class="form-control" placeholder="Nhập giá dịch vụ">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Tiêu đề dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="title_instagram"  class="form-control" placeholder="Nhập tiêu đề dịch vụ">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Thông báo dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="notice"  class="form-control" placeholder="Nhập tiêu đề dịch vụ">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><button type="submit" class="btn btn-primary btn-block">Thêm dịch vụ</button></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm Dịch vụ tiktok</h4>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.service.tiktok.add-2') }}" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Loại dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <select name="type_service_tiktok" id="" class="form-control">
                                        <option value="">--Chọn dịch vụ--</option>
                                        <option value="like-tiktok">Tăng like </option>
                                        <option value="follow-tiktok">Tăng follow </option>
                                        <option value="view-tiktok">Tăng view </option>
                                        <option value="cmt-tiktok">Tăng comment </option>
                                        <option value="share-tiktok">Tăng share </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Máy chủ</label>
                                </div>
                                <div class="col-9">
                                    <select name="server_tiktok" id="" class="form-control">
                                        <option value="">--Chọn máy chủ--</option>
                                        {{-- for loop server 1 to server 20 --}}
                                        @for($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}">Server {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Package name</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="package_name" class="form-control" placeholder="Nhập package_name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Giá dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="rate_tiktok" class="form-control" placeholder="Nhập giá dịch vụ">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Tiêu đề dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="title_tiktok"  class="form-control" placeholder="Nhập tiêu đề dịch vụ">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="#" class="form-label">Thông báo dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="notice"  class="form-control" placeholder="Nhập tiêu đề dịch vụ">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><button type="submit" class="btn btn-primary btn-block">Thêm dịch vụ</button></div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-xl-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách dịch vụ facebook</h3>
                </div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Loại dịch vụ</th>
                                <th>Server</th>
                                <th>Giá tiền</th>
                                <th>Tiêu đề</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($service_facebook as $item)
                               <tr>
                                   <td>{{ $item->id }}</td>
                                   <td>{{ $item->code_server }}</td>
                                   <td>{{ $item->server_service }}</td>
                                   <td>{{ $item->rate_server }}</td>
                                   <td>
                                       <textarea name="" id="" cols="17" rows="3" disabled>{{ $item->title_server }}</textarea>
                                   </td>
                                   <td>
                                       @if ($item->status_server == 1)
                                           <span class="badge badge-success">Đang hoạt động</span>
                                        @else
                                            <span class="badge badge-danger">Bảo trì</span>
                                       @endif
                                   </td>
                                   <td>
                                       @if($item->status_server == 1)
                                            <a href="{{ route('admin.service.off', $item->id) }}" class="btn btn-danger">Tắt</a>
                                        @else
                                            <a href="{{ route('admin.service.on', $item->id) }}" class="btn btn-success">Bật</a>
                                        @endif
                                        <a href="{{ route('admin.service.edit', $item->id) }}" class="btn btn-primary">Sửa</a>

                                        <a href="{{ route('admin.service.delete', $item->id) }}" class="btn btn-danger">Xóa</a>
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
                    <h3 class="card-title">Danh sách dịch vụ instagram</h3>
                </div>

                <div class="card-body">

                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Loại dịch vụ</th>
                                <th>Server</th>
                                <th>Giá tiền</th>
                                <th>Tiêu đề</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($service_instagram as $item)
                               <tr>
                                   <td>{{ $item->id }}</td>
                                   <td>{{ $item->code_server }}</td>
                                   <td>{{ $item->server_service }}</td>
                                   <td>{{ $item->rate_server }}</td>
                                   <td>
                                       <textarea name="" id="" cols="17" rows="3" disabled>{{ $item->title_server }}</textarea>
                                   </td>
                                   <td>
                                       @if ($item->status_server == 1)
                                           <span class="badge badge-success">Đang hoạt động</span>
                                        @else
                                            <span class="badge badge-danger">Bảo trì</span>
                                       @endif
                                   </td>

                                   <td>
                                       @if($item->status_server == 1)
                                            <a href="{{ route('admin.service.off', $item->id) }}" class="btn btn-danger">Tắt</a>
                                        @else
                                            <a href="{{ route('admin.service.on', $item->id) }}" class="btn btn-success">Bật</a>
                                        @endif
                                        <a href="{{ route('admin.service.edit', $item->id) }}" class="btn btn-primary">Sửa</a>

                                        <a href="{{ route('admin.service.delete', $item->id) }}" class="btn btn-danger">Xóa</a>
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
                    <h3 class="card-title">Danh sách dịch vụ tiktok</h3>
                </div>

                <div class="card-body">

                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Loại dịch vụ</th>
                                <th>Server</th>
                                <th>Giá tiền</th>
                                <th>Tiêu đề</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($service_tiktok as $item)
                               <tr>
                                   <td>{{ $item->id }}</td>
                                   <td>{{ $item->code_server }}</td>
                                   <td>{{ $item->server_service }}</td>
                                   <td>{{ $item->rate_server }}</td>
                                   <td>
                                       <textarea name="" id="" cols="17" rows="3" disabled>{{ $item->title_server }}</textarea>
                                   </td>
                                   <td>
                                       @if ($item->status_server == 1)
                                           <span class="badge badge-success">Đang hoạt động</span>
                                        @else
                                            <span class="badge badge-danger">Bảo trì</span>
                                       @endif
                                   </td>
                                   <td>
                                       @if($item->status_server == 1)
                                            <a href="{{ route('admin.service.off', $item->id) }}" class="btn btn-danger">Tắt</a>
                                        @else
                                            <a href="{{ route('admin.service.on', $item->id) }}" class="btn btn-success">Bật</a>
                                        @endif
                                        <a href="{{ route('admin.service.edit', $item->id) }}" class="btn btn-primary">Sửa</a>
                                        <a href="{{ route('admin.service.delete', $item->id) }}" class="btn btn-danger">Xóa</a>
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
