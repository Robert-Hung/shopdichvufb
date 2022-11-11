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
                    <h4 class="card-title">Thêm Dịch vụ facebook (api subgiare)</h4>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.service.facebook.add') }}" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Loại dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <select name="type_service_facebook" id="" class="form-control">
                                        <option value="">--Chọn dịch vụ--</option>
                                        <option value="like_post_sale">Like bài viết (sale) </option>
                                        <option value="like_post_speed">Like bài viết (speed) </option>
                                        <option value="cmt_sale">Bình luận (sale) </option>
                                        <option value="cmt_speed">Bình luận (speed) </option>
                                        <option value="sub_vip">Sub (vip)</option>
                                        <option value="sub_quality">Sub (quality)</option>
                                        <option value="sub_sale">Sub (sale)</option>
                                        <option value="sub_speed">Sub (speed)</option>
                                        <option value="like_page_quality">Like page (Quality)</option>
                                        <option value="like_page_sale">Like page (sale)</option>
                                        <option value="like_page_speed">Like page (Speed)</option>
                                        <option value="eyes_live">Mắt live</option>
                                        <option value="share_profile">Share (profile)</option>
                                        <option value="member_group">Thành viên nhóm</option>
                                        <option value="view_story">View Story</option>
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
                                    <label for="#" class="form-label">Giá dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="rate_facebook" class="form-control" placeholder="Nhập giá dịch vụ">
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
                    <h4 class="card-title">Thêm Dịch vụ instagram</h4>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.service.instagram.add') }}" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Loại dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <select name="type_service_instagram" id="" class="form-control">
                                        <option value="">--Chọn dịch vụ--</option>
                                        <option value="like_instagram">Like bài viết </option>
                                        <option value="sub_instagram">Theo dõi </option>
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
                                    <label for="#" class="form-label">Giá dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="rate_instagram" class="form-control" placeholder="Nhập giá dịch vụ">
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
                    <form request-ajax="lbd" action="{{ route('admin.service.tiktok.add') }}" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Loại dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <select name="type_service_tiktok" id="" class="form-control">
                                        <option value="">--Chọn dịch vụ--</option>
                                        <option value="like_tiktok">Like (thả tym) </option>
                                        <option value="cmt_tiktok">Bình luận </option>
                                        <option value="share_tiktok">Chia sẻ</option>
                                        <option value="sub_tiktok">Theo dõi</option>
                                        <option value="view_tiktok">Lượt xem</option>
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
                                    <label for="#" class="form-label">Giá dịch vụ</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="rate_tiktok" class="form-control" placeholder="Nhập giá dịch vụ">
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