@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Cài đặt thẻ cào (thesieure.com) <p>Link cron: {{ url('') }}/api/callback/tsr</p> </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update_charge') }}" request-ajax="lbd" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Parther id</label>
                                    <input type="text" name="parther_id" class="form-control" placeholder="Parther id" value="{{ $parther_id->value }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Parther key</label>
                                    <input type="text" name="parther_key" class="form-control" placeholder="Parther key" value="{{ $parther_key->value }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block">Lưu ngay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                        <h4 class="card-title">Thêm ngân hàng api(been apigiare)</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.add_charge') }}" request-ajax="lbd" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                       <label for="" class="form-label">Type banking</label>
                                </div>
                                  <div class="col-md-9">
                                     <select name="type_banking" id="" class="form-control">
                                        <option value="">Chọn loại ngân hàng</option>
                                        <option value="momo">Momo</option>
                                        <option value="mbbank">Mbbank</option>
                                        <option value="vcb">Vietcombank</option>
                                        <option value="tsr">Thesieure</option>
                                     </select>
                                  </div>
                            </div>
                        </div>
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-3">
                                      <label for="" class="form-label">Logo ngân hàng</label>
                               </div>
                                 <div class="col-md-9">
                                    <input type="text" name="logo" class="form-control" placeholder="Nhập link logo ngân hàng">
                                 </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-3">
                                      <label for="" class="form-label">Tên chủ tài khoản</label>
                               </div>
                                 <div class="col-md-9">
                                    <input type="text" name="name_account" class="form-control" placeholder="Nhập tên chủ tài khoản">
                                 </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-3">
                                      <label for="" class="form-label">Số tài khoản</label>
                               </div>
                                 <div class="col-md-9">
                                    <input type="text" name="number_account" class="form-control" placeholder="Nhập số tài khoản">
                                 </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-3">
                                      <label for="" class="form-label">Nạp tối thiểu</label>
                               </div>
                                 <div class="col-md-9">
                                    <input type="text" name="min_bank" class="form-control" placeholder="Nhập nạp tối thiểu">
                                 </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-3">
                                      <label for="" class="form-label">Token account</label>
                               </div>
                                 <div class="col-md-9">
                                    <input type="text" name="token" class="form-control" placeholder="Nhập token account or cookie">
                                 </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-3">
                                      <label for="" class="form-label">Thông báo ngắn</label>
                               </div>
                                 <div class="col-md-9">
                                    <input type="text" name="notice_bank" class="form-control" placeholder="VD (Nap tối thiểu 10.000)">
                                 </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <button type="submit" class="btn btn-info btn-block">Thêm ngay</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lịch sử ngân hàng đã tạo</h3>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Logo ngân hàng</th>
                                <th>Tên tài khoản</th>
                                <th>Số tài khoản</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bank_list as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><img src="{{ $item->logo }}" alt="" style="width: 70px"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->number }}</td>
                                <td>
                                    <a href="{{ route('admin.delete_charge', $item->id) }}" class="btn btn-danger">Xóa</a>
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
