@extends('layouts.app')

@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title"><span class="font-weight-normal text-muted ml-2">Nạp ATM</span></h4>
        </div>
        <div class="page-rightheader ml-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
                <div class="d-flex">
                    <div class="header-datepicker mr-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="feather feather-clock"></i>
                                </div>
                            </div><!-- input-group-prepend -->
                            <input id="tpBasic" type="text" placeholder="{{ date('H:i:s') }}"
                                class="form-control input-small">
                        </div>
                    </div><!-- wd-150 -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-6">
                        <a href="{{ route('recharge.banking') }}" class="btn btn-outline-primary btn-block py-2">Chuyển khoản</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-primary btn-block py-2">Thẻ cào</a>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Tỷ giá: 1 VNĐ = 1 coin</h6>
                    <form class="mt-3" request-ajax="lbd" action="{{ route('recharge.cards.post') }}" method="POST">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Loại thẻ</label>
                                    <select name="card_type" id="" class="form-control">
                                        <option value="">-- Chọn loại thẻ --</option>
                                        <option value="VIETTEL">Viettel ({{ $carddiscount->value }}%) </option>
                                        <option value="MOBIFONE">Mobifone ({{ $carddiscount->value }}%)</option>
                                        <option value="VINAPHONE">Vinaphone ({{ $carddiscount->value }}%)</option>
                                        <option value="VNMOBI">Vietnammobi ({{ $carddiscount->value }}%)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Mệnh giá</label>
                                    <select name="card_price" id="" class="form-control">
                                        <option value="">-- Chọn mệnh giá --</option>
                                        <option value="10000">10.000</option>
                                        <option value="20000">20.000</option>
                                        <option value="50000">50.000</option>
                                        <option value="100000">100.000</option>
                                        <option value="200000">200.000</option>
                                        <option value="500000">500.000</option>
                                        <option value="1000000">1.000.000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Số seri</label>
                                    <input type="text" name="serial" class="form-control" placeholder="Nhập số seri">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Mã thẻ</label>
                                    <input type="text" name="code" class="form-control" placeholder="Nhập mã thẻ">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block py-2">Nạp ngay</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0"> card type </th>
                                    <th class="wd-15p border-bottom-0"> Card prices</th>
                                    <th class="wd-20p border-bottom-0">Serial</th>
                                    <th class="wd-20p border-bottom-0">Code</th>
                                    <th class="wd-20p border-bottom-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($server as $item)
                                <tr>
                                    <td>{{ $item->card_type }}</td>
                                    <td>{{ $item->card_price }}</td>
                                    <td>{{ $item->serial }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>
                                        @if($item->status == 1)
                                            <span class="badge badge-success">Success</span>
                                            @elseif ($item->status == 2)
                                            <span class="badge badge-danger">Failed</span>
                                            @else
                                            <span class="badge badge-warning">Pending</span>
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
    <!--End Page header-->
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
