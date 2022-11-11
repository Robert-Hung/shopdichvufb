@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.update_admin') }}" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="#" class="form-label">Tên admin</label>
                                    <input type="text" class="form-control" name="admin_name" value="{{ $admin_name->value }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="#" class="form-label">Facebook admin</label>
                                    <input type="text" class="form-control" name="facebook_admin" value="{{ $facebook_admin->value }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="#" class="form-label">Zalo admin</label>
                                    <input type="text" class="form-control" name="zalo_admin" value="{{ $zalo_admin->value }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="#" class="form-label">UID(fb) admin</label>
                                    <input type="number" class="form-control" name="uid_admin" value="{{ $uid->value }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="#" class="form-label">Token subgiare.vn</label>
                                    <input type="text" class="form-control" name="token_subgiare" value="{{ $token_subgiare->value }}">
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
</div>
@endsection
