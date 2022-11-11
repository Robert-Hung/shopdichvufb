@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chỉnh sửa dịch vụ</h4>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.service.update') }}" method="POST">
                            <input type="text" name="id_service" value="{{ $service->id }}" hidden>
                            <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Loại dịch vụ </label>
                                </div>
                                <div class="col-9">
                                    <input type="text" value="{{ $service->code_server }} - {{ $type_server }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Server Dịch vụ </label>
                                </div>
                                <div class="col-9">
                                    <input type="number" value="{{ $service->server_service }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        @if ($service->api_server == 'baostart')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="" class="form-label">Package Name </label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="package_name" value="{{ $service->server_name }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Giá dịch vụ </label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="rate" value="{{ $service->rate_server }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class="form-label">Thông báo dịch vụ </label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="note" value="{{ $service->title_server }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
