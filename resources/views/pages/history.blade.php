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
                    <div class="card-title">Lịch sử tài khoản</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">ID</th>
                                    <th class="wd-15p border-bottom-0">Thời gian</th>
                                    <th class="wd-20p border-bottom-0">Nội dung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->note }}</td>
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