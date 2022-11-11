@extends('layouts.app')

@section('content')

    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h5 class="page-title"><span class="font-weight-normal text-muted ml-2">{{ $title }} - Facebook v-2</span></h5>
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
    <!--End Page header-->
    <div class="row">
        <div class="col-lg-6 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xl-6">
                            <a href="#" class="btn btn-primary btn-block">Thêm đơn</a>
                        </div>
                        <div class="col-xl-6">
                            <a href="{{ route('service.facebook-v2.order', 'comment-sale') }}" class="btn btn-outline-primary btn-block">Lịch sử</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form request-ajax="lbd" action="{{ route('service.facebook-v2.comment-sale.post') }}" method="POST">
                        <div id="msg"></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="link_post" class="form-label">Link bài viết</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="link_post" name="link_post"
                                        placeholder="Nhập link bài viết">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="server" class="form-label">Máy chủ</label>
                                </div>
                                <div class="col-9">
                                    @foreach ($server as $item)
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" prices="{{ $item->rate_server }}" name="server_order" value="{{ $item->server_service }}" notice="{{ $item->notice }}" reaction="true">
                                                <span class="custom-control-label">Máy chủ {{ $item->server_service }}
                                                    ({{ $item->title_server }})
                                                    <span class="badge badge-success bg-success">{{ $item->rate_server }} Đ / 1</span> <small
                                                        class="text-warning">(
                                                        @if ($item->status_server == 1)
                                                            Hoạt động
                                                            @else
                                                            Bảo trì
                                                        @endif)</small> </span>
                                            </label>
                                        </div>
                                    @endforeach
                                    <div class="form-group mt-3">
                                        <div id="noticeServer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="camxuc" class="form-label">Bình luận</label>
                                </div>
                                <div class="col-9">
                                    <textarea name="comment" class="form-control" id="camxuc" cols="15" rows="3" placeholder="Nhập nội dung bạn muốn bình luận"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="amount" class="form-label">Số lượng</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="amount" id="amount" value="50" class="form-control">
                                    <div class="mt-5">
                                        <div class="alert alert-primary text-center">
                                            <h4 class="text-white">Tổng tiền = (Số lượng) * (Giá)</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="ghichu" class="form-label">Ghi chú</label>
                                </div>
                                <div class="col-9">
                                    <textarea name="ghichu" id="ghichu" cols="15" rows="3" placeholder="Nhập ghi chú nếu cần" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="alert text-white bg-success text-center" role="alert">
                                <h3 class="font-bold">Tổng thanh toán: <span class="bold green"><span id="total_payment" class="text-danger">0</span> coin</span></h3>
                                </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" show="Bạn vui lòng nhập đúng đường dẫn bài viết nếu sai chúng tôi sẽ không hoàn tiền cho bạn" class="btn btn-primary btn-block py-3">
                                <i class="fa fa-plus"></i> Mua ngay
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lưu ý</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        - Nghiêm cấm buff các đơn có nội dung vi phạm pháp luật, chính trị, đồ trụy... Nếu cố tình buff bạn
                        sẽ bị trừ hết tiền và ban khỏi hệ thống vĩnh viễn, và phải chịu hoàn toàn trách nhiệm trước pháp
                        luật.
                        - Nếu đơn đang chạy trên hệ thống mà bạn vẫn mua ở các hệ thống bên khác, nếu có tình trạng hụt,
                        thiếu số lượng giữa 2 bên thì sẽ không được xử lí.
                        - Đơn cài sai thông tin hoặc lỗi trong quá trình tăng hệ thống sẽ không hoàn lại tiền.
                        - Nếu gặp lỗi hãy nhắn tin hỗ trợ phía bên phải góc màn hình hoặc vào mục liên hệ hỗ trợ để được hỗ
                        trợ tốt nhất.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            //check id reaction0 if checked show alert
            $('#reaction0').click(function(){
                $('#showicon').html('<img src="https://subgiare.vn/assets/images/fb-reaction/like.png" width="50px" height="50px">');
            });
            //check id reaction1 if checked show alert
            $('#reaction1').click(function(){
                $('#showicon').html('<img src="https://subgiare.vn/assets/images/fb-reaction/love.png" width="50px" height="50px">');
            });
            //check id reaction2 if checked show alert
            $('#reaction2').click(function(){
                $('#showicon').html('<img src="https://subgiare.vn/assets/images/fb-reaction/care.png" width="50px" height="50px">');
            });
            //check id reaction3 if checked show alert
            $('#reaction3').click(function(){
                $('#showicon').html('<img src="https://subgiare.vn/assets/images/fb-reaction/haha.png" width="50px" height="50px">');
            });
            //check id reaction4 if checked show alert
            $('#reaction4').click(function(){
                $('#showicon').html('<img src="https://subgiare.vn/assets/images/fb-reaction/wow.png" width="50px" height="50px">');
            });
            //check id reaction5 if checked show alert
            $('#reaction5').click(function(){
                $('#showicon').html('<img src="https://subgiare.vn/assets/images/fb-reaction/sad.png" width="50px" height="50px">');
            });
            //check id reaction6 if checked show alert
            $('#reaction6').click(function(){
                $('#showicon').html('<img src="https://subgiare.vn/assets/images/fb-reaction/angry.png" width="50px" height="50px">');
            });
        });
    </script>
@endsection
