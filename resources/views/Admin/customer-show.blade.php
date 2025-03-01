@section('title', 'Chỉnh sửa khách hàng')
@extends('Admin.layout.app')
@section('content')
<div class="row">
    <div class="col-md-12 m-b-30">
        <!-- begin page title -->
        <div class="d-block d-sm-flex flex-nowrap align-items-center">
            <div class="page-title mb-2 mb-sm-0">
                <h1>Chỉnh sửa khách hàng</h1>
            </div>
        </div>
        <!-- end page title -->
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">Thông tin Khách hàng</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('customers.update', $customer->id) }}">
                    <input type="hidden" name="_token" value="7DnUxprcAPcFbny2VLcKLskCEYAuR8FbO3ZCtasU" autocomplete="off">                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mã số thuế / CMND</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Nhập MST/CMND" id="tax" name="tax" class="form-control autonumber" value="{{ $customer->taxcode ?? $customer->id_number }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên doanh nghiệp</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Nhập tên doanh nghiệp" id="name" name="name" class="form-control autonumber" value="{{ $customer->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Địa chỉ</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Nhập địa chỉ" id="address" name="address" class="form-control autonumber" value="{{ $customer->address }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Người đại diện</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Nhập người đại diện" id="representative" name="representative" class="form-control autonumber" value="{{ $customer_info->representative }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Nhập số điện thoại" id="phone_number" name="phone_number" class="form-control autonumber" value="{{ $customer->phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Nhập Email" id="email" name="email" class="form-control autonumber" value="{{ $customer->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ngày hoạt động</label>
                        <div class="col-sm-10">
                            <input type="date" placeholder="Chọn ngày hoạt động" id="operating_day" name="operating_day" class="form-control autonumber" value="{{ $customer_info->operating_day }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Cơ quan thuế</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Nhập cơ quan thế" id="tax_department" name="tax_department" class="form-control autonumber" value="{{ $customer_info->tax_department }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Loại hình DN</label>
                        <div class="col-sm-10">
                            <select class="form-control" placeholder="Chọn loại hình doanh nghiệp" id="type_of_business" name="type_of_business">
                                <option value="1" @selected($customer->type == NULL OR $customer->type == 1)>Doanh nghiệp</option>
                                <option value="2" @selected($customer->type == 2)>Cá nhân</option>
                                <option value="3" @selected($customer->type == 3)>Cá nhân thuộc doanh nghiệp</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ngành nghề chính</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="" id="main_profession" name="main_profession" class="form-control autonumber" value="{{ $customer_info->main_profession }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tình trạng</label>
                        <div class="col-sm-10">
                            <select class="form-control" placeholder="Cập nhật tình trạng" id="status_of_business" name="status_of_business">
                                <option value="1" @selected($customer->status == 1)>Đang hoạt động</option>
                                <option value="2" @selected($customer->status == 0)>Ngừng hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@stop