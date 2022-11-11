@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Đơn hàng facebook</h5>
                </div>
                <div class="card-body">
                    
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Loại</th>
                                <th>Giá tiền</th>
                                <th>Tổng tiền</th>
                                <th>Link buff</th>
                                <th>Máy chủ</th>
                                <th>Note</th>
                                <th>Trạng thái</th>
                                <th>Id code</th>
                                <th>Ngày mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->prices }}</td>
                                <td>{{ $item->total_money }}</td>
                                <td>{{ $item->link_order }}</td>
                                <td>{{ $item->server_order }}</td>
                                <td>
                                    Cảm xúc : {{ $item->reaction }} <br>
                                    Comment : {{ $item->comment }}
                                </td>
                                <td>
                                    @if ($item->status == 'Start')
                                        <span class="badge badge-success">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Success')
                                        <span class="badge badge-success">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Fail')
                                        <span class="badge badge-danger">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Cancel')
                                        <span class="badge badge-danger">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Pending')
                                        <span class="badge badge-warning">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->id_order }}</td>
                                <td>{{ $item->created_at }}</td>
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
                    <h5 class="card-header-text">Đơn hàng facebook chưa duyệt</h5>
                </div>
                <div class="card-body">
                    
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Loại</th>
                                <th>Giá tiền</th>
                                <th>Tổng tiền</th>
                                <th>Link buff</th>
                                <th>Máy chủ</th>
                                <th>Note</th>
                                <th>Trạng thái</th>
                                <th>Id code</th>
                                <th>Ngày mua</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders_pendding as $item)
                            <tr>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->prices }}</td>
                                <td>{{ $item->total_money }}</td>
                                <td>{{ $item->link_order }}</td>
                                <td>{{ $item->server_order }}</td>
                                <td>
                                    Cảm xúc : {{ $item->reaction }} <br>
                                    Comment : {{ $item->comment }}
                                </td>
                                <td>
                                    @if ($item->status == 'Start')
                                        <span class="badge badge-success">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Success')
                                        <span class="badge badge-success">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Fail')
                                        <span class="badge badge-danger">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Cancel')
                                        <span class="badge badge-danger">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Pending')
                                        <span class="badge badge-warning">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->id_order }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.success-order', $item->id) }}" class="btn btn-success btn-sm">Duyệt</a>
                                    <a href="{{ route('admin.cancer-order', $item->id) }}" class="btn btn-danger btn-sm">Hủy</a>
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
@section('scripts')
        <script>
            @if (session('success'))
                    Swal.fire({
                        title: 'Thành công!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                @elseif (session('error'))
                    Swal.fire({
                        title: 'Thất bại!',
                        text: '{{ session('error') }}',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                @endif
        </script>
@endsection
