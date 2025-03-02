@section('title', 'Danh sách khách hàng')
@extends('Admin.layout.app')

@section('content')
<div class="row">
    <div class="col-md-12 m-b-30">
        <!-- begin page title -->
        <div class="d-block d-sm-flex flex-nowrap align-items-center">
            <div class="page-title mb-2 mb-sm-0">
                <h1>Danh sách khách hàng</h1>
            </div>
        </div>
        <!-- end page title -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="export-table" class="table table-bordered datatable" tableexport-key="export-table">
                        <caption class="btn-toolbar tableexport-caption" style="caption-side: top;">
                            <button type="button" tableexport-id="5b144a9-xlsx" class="btn btn-default xlsx">Export to xlsx</button>
                            <button type="button" tableexport-id="11ac88c-csv" class="btn btn-default csv">Export to csv</button>
                            <button type="button" tableexport-id="20c9676-txt" class="btn btn-default txt">Export to txt</button>
                        </caption>
                        <thead class="thead-light">
                            <tr>
                                <th>Chỉnh sửa</th> 
                                <th style="white-space: nowrap; width: 0.5%;">STT</th>
                                <th>MST/CMND</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $key => $value)
                            <tr>
                                <td style="white-space: nowrap; width: 1%;">
                                    <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;">
                                            <a href="{{ route('customers.show', $value->id) }}" class="tabledit-edit-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-pencil"></span> EDIT</a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->taxcode ?? $value->id_number }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>{{ $value->address }}</td>
                                <td>{{ $value->status == 1 ? 'Đang hoạt động' : 'Ngừng hoặt động'  }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>{{ $value->updated_at }}</td>
                            @endforeach
                            </tr>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Thêm script DataTables -->
@section('script')
<script>
    $(document).ready(function() {
        // Khởi tạo DataTable
        $('#export-table').DataTable({
            pageLength: 50, // Số bản ghi mặc định trên 1 trang
            lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]], // Tùy chọn số bản ghi (giá trị và hiển thị)
            order: [[0, 'asc']], // Sắp xếp mặc định theo STT
            searching: true, // Bật tìm kiếm
            paging: true, // Bật phân trang
            info: true, // Hiển thị thông tin tổng số bản ghi
            language: {
                search: "Tìm kiếm:", // Đổi nhãn ô tìm kiếm
                info: "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ bản ghi",
                lengthMenu: "Hiển thị _MENU_ bản ghi mỗi trang", // Hiển thị danh sách số
                paginate: {
                    first: "Đầu",
                    last: "Cuối",
                    next: "Tiếp",
                    previous: "Trước"
                }
            },
            columnDefs: [
                {
                    targets: 0, // Cột MST/CMND
                    searchable: false, // Không cho tìm kiếm cột này
                    orderable: false // Không cho sắp xếp cột này
                },
                {
                    targets: 1, // Cột STT
                    searchable: false, // Không cho tìm kiếm cột STT
                    orderable: false, // Không cho sắp xếp cột STT
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; // STT = số thứ tự hàng + offset trang
                    }
                }
            ],
            responsive: true,
        });
    });
</script>
@endsection
@stop