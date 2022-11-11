@extends('admin.layouts.app')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cấu hình thông tin website</h4>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('admin.setting_website.post') }}" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Trạng thái website</label>
                                </div>
                                <div class="col-9">
                                    <select name="status_web" id="on" class="form-control">
                                        {{-- <option value="ON">Hoạt động</option>
                                        <option value="OFF">Bảo trì</option> --}}
                                        @if ($status_web->value == 'ON')
                                            <option value="ON" selected>Hoạt động</option>
                                            <option value="OFF">Bảo trì</option>
                                            @else
                                            <option value="ON">Hoạt động</option>
                                            <option value="OFF" selected>Bảo trì</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Tên website</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="domain" class="form-control" value="{{ $domain->value }}" placeholder="Nhập tên website của bạn">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">transfer code</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="transfer_code" class="form-control" value="{{ $transfer_code->value }}" placeholder="Nhập tên website của bạn">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Mô tả website</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="describe" class="form-control" value="{{ $describe->value }}" placeholder="Mô tả website của bạn">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Từ khóa tìm kiếm</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="keyword" class="form-control" value="{{ $keyword->value }}" placeholder="Nhập từ khóa tìm kiếm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Favicon web</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="favicon" class="form-control" value="{{ $favicon->value }}" placeholder="Nhập link icon fav website của bạn">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Ảnh giới thiệu</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="intro_img" class="form-control" value="{{ $intro_img->value }}" placeholder="Nhập ảnh giới thiệu website của bạn">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Token facebook(support)</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="token_facebook" class="form-control" value="{{ $token_fb->value }}" placeholder="Nhập token fb">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Token bot telegram</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="token_bot" class="form-control" value="{{ $api_telegram_bot->value }}" placeholder="Nhập token bot tele của bạn">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">ID chat (telegram)</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="id_chat" class="form-control" value="{{ $id_chat_tel->value }}" placeholder="Nhập id chat">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Mức nạp CTV</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="charge_level_CTV" class="form-control" value="{{ $charge_level_CTV->value }}" placeholder="Số tiền CTV">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Mức nạp Đại lý</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="charge_level_DL" class="form-control" value="{{ $charge_level_DL->value }}" placeholder="Số tiền Đai lý">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Mức nạp NPP</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="charge_level_NPP" class="form-control" value="{{ $charge_level_NPP->value }}" placeholder="Số tiền NPP">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Chiết khấu Thành viên</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="discount_TV" class="form-control" value="{{ $discount_TV->value }}" placeholder="Nhập ck">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Chiết khấu CTV</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="discount_CTV" class="form-control" value="{{ $discount_CTV->value }}" placeholder="Nhập ck">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Chiết khấu Đại lí</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="discount_DL" class="form-control" value="{{ $discount_DL->value }}" placeholder="Nhập ck">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Chiết khấu NPP</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="discount_NPP" class="form-control" value="{{ $discount_NPP->value }}" placeholder="Nhập ck">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="on" class="form-label">Chiết khấu thẻ cào</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="card_discount" class="form-control" value="{{ $card_discount->value }}" placeholder="Nhập ck">
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