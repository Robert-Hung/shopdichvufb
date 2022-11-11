@extends('layouts.app')

@section('content')
    
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">{{ $title }}</h4>
    </div>
</div>
<div class="row">
    
    <div class="col-xl-12 col-md-12 col-ld-12 mt-3">
        <div class="">
            <div class="card">
                <div class="card-header border-bottom-0">
                    <div class="row">
                        <div class="col-xl-6">
                            <a href="{{ url('service/tiktok') }}/{{ $title }}/buy" class="btn btn-outline-primary">Thêm đơn</a>
                        </div>
                        <div class="col-xl-6">
                            <a href="{{ route('service.tiktok.order', $title) }}" class="btn btn-primary btn-block">Lịch sử</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">ID</th>
                                    <th class="wd-15p border-bottom-0">Thời gian</th>
                                    <th class="wd-20p border-bottom-0">Mã đơn</th>
                                    <th class="wd-20p border-bottom-0">Link buff</th>
                                    <th class="wd-20p border-bottom-0">Máy chủ</th>
                                    <th class="wd-20p border-bottom-0">Số lượng</th>
                                    <th class="wd-20p border-bottom-0">Giá</th>
                                    <th class="wd-20p border-bottom-0">Tổng tiền</th>
                                    <th class="wd-20p border-bottom-0">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($server as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->id_order }}</td>
                                        <td>{{ $item->link_order }}</td>
                                        <td>{{ $item->server_order }}</td>
                                        <td>{{ $item->soluong }}</td>
                                        <td>{{ $item->prices }}</td>
                                        <td>{{ $item->total_money }}</td>
                                        <td>
                                            @if ($item->status == 'Start')
                                                <span class="badge badge-success">Hoạt động</span>
                                            @elseif ($item->status == 'Pending')
                                                <span class="badge badge-warning">Chờ xử lý</span>
                                            @elseif ($item->status == 'Cancel')
                                                <span class="badge badge-danger">Đã hủy</span>
                                            @elseif ($item->status == 'Success')
                                                <span class="badge badge-primary">Hoàn thành </span>
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
    </div>
</div>
@endsection

@section('scripts')
		<!-- INTERNAL Data tables -->
		<script src="{{ asset('') }}assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/jszip.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/buttons.html5.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/buttons.print.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/js/buttons.colVis.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/dataTables.responsive.min.js"></script>
		<script src="{{ asset('') }}assets/plugins/datatable/responsive.bootstrap4.min.js"></script>
		<script src="{{ asset('') }}assets/js/datatables.js"></script>
@endsection