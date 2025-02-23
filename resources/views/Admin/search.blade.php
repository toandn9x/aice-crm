@section('title', 'Tra cứu thông tin')
@section('content')
@extends('Admin.layout.app')
<div class="row">
    <div class="col-xl-4">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">Tra cứu thông tin khách hàng</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('customers.psearch') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="tax" name="tax" value="{{ old('tax', $tax ?? '') }}" placeholder="Nhập MST hoặc CMND">
                    </div>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">Thông tin Khách hàng</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mã số thuế / CMND</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="" id="Spanish" class="form-control autonumber" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Địa chỉ</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="" id="Spanish" class="form-control autonumber" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Người đại diện</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="" id="Spanish" class="form-control autonumber" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="" id="Spanish" class="form-control autonumber" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ngày hoạt động</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="" id="Spanish" class="form-control autonumber" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Cơ quan thuế</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="" id="Spanish" class="form-control autonumber" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Loại hình DN</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="" id="Spanish" class="form-control autonumber" value="">
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@stop