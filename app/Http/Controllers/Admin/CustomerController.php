<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\CustomerAssign;
use App\Models\CustomerInfo;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    // Hiển thị danh sách khách hàng
    public function list()
    {
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('Admin.list', ["customers" => $customers]);
    }

    // Hiển thị chi tiết một khách hàng
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $customer_info = CustomerInfo::where('customer_id', $id)->firstOrFail();
        return view('Admin.customer-show', ["customer" => $customer, "customer_info" => $customer_info]);
    }

    // Lấy thông tin một khách hàng (API JSON)
    public function get($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['error' => 'Khách hàng không tồn tại'], 404);
        }
        return response()->json($customer);
    }

    // Cập nhật thông tin khách hàng
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

    try {
        $customer = Customer::findOrFail($id);
        $customer_info = CustomerInfo::where('customer_id', $id)->firstOrFail();

        // Cập nhật thông tin Customer
        if ($request->type_of_business == 1) {
            $customer->taxcode = $request->tax;
        } else {
            $customer->id_number = $request->tax;
        }
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone_number;
        $customer->email = $request->email;
        $customer->status = 1;
        $customer->type = $request->type_of_business;

        // Lưu Customer
        if ($customer->save()) {
            // Cập nhật thông tin CustomerInfo
            $customer_info->customer_id = $customer->id;
            $customer_info->status = 1;
            $customer_info->creator_id = Auth::user()->id;
            $customer_info->creator_name = Auth::user()->name;
            $customer_info->creator_email = Auth::user()->email;
            $customer_info->representative = $request->representative;
            $customer_info->operating_day = $request->operating_day;
            $customer_info->tax_department = $request->tax_department;
            $customer_info->main_profession = $request->main_profession;
            $customer_info->status_of_business = $request->status_of_business;
            $customer_info->save();
        }
        // Commit transaction nếu không có lỗi
        DB::commit();
        return back()->with('success', 'Cập nhật khách hàng thành công.');

    } catch (\Exception $e) {
        // Rollback nếu có lỗi
        DB::rollBack();
        return back()->with('error', 'Có lỗi xảy ra khi cập nhật thông tin khách hàng!');
        }
    }

    // Xóa khách hàng
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('Admin.index')->with('success', 'Xóa khách hàng thành công.');
    }

    // thêm khách hàng
    public function create(Request $request) {
        // validate
        // create
        $customer = new Customer();
        if ($request->type_of_business == 1) $customer->taxcode = $request->tax;
        else $customer->id_number =  $request->tax;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone_number;
        $customer->email = $request->email;
        $customer->status = 1;
        $customer->type = $request->type_of_business;
        if($customer->save()) {
            $customer_info = new CustomerInfo();
            $customer_info->customer_id = $customer->id;
            $customer_info->status = 1;
            $customer_info->creator_id = Auth::user()->id;
            $customer_info->creator_name = Auth::user()->name;
            $customer_info->creator_email = Auth::user()->email;
            $customer_info->representative = $request->representative;
            $customer_info->operating_day = $request->operating_day;
            $customer_info->tax_department = $request->tax_department;
            $customer_info->main_profession = $request->main_profession;
            $customer_info->status_of_business = $request->status_of_business;
            $customer_info->save();
            // lien hệ
            $customer_contact = new Contact();
            $customer_contact->customer_id = $customer->id;
            $customer_contact->contact_id = Auth::user()->id;
            $customer_contact->contact_name = Auth::user()->name;
            $customer_contact->contact_email = Auth::user()->email;
            $customer_contact->creator = Auth::user()->id;
            $customer_contact->save();
            // cham soc
            $customer_assign = new CustomerAssign();
            $customer_assign->customer_id = $customer->id;
            $customer_assign->user_id = Auth::user()->id;
            $customer_assign->role = 1;
            $customer_assign->creator = Auth::user()->id;
            $customer_assign->save();

            return back()->with("success", "Tạo khách hàng thành công!");
        } else {
            return back()->with("error", "Tạo khách hàng thất bại!");
        }
    }


    // tìm kiếm
    public function gSearch() {
        return view("Admin.search");
    }
    public function pSearch(Request $request) {
        if (Helper::isEmptyOrNull($request->tax)) {
            return back()->with('error', 'Vui lòng nhập MST hoặc CMND để tìm kiếm khách hàng!');
        }
    
        // Tìm trong DB
        $customer = Customer::where('taxcode', $request->tax)->first();
        if ($customer) {
            return view('Admin.search', [
                'customer' => $customer,
                'tax' => $request->tax,
            ]); // Không cần thông báo
        }

        // Tìm bằng API
        $customer = Helper::getByTaxcode2($request->tax);
        return view('Admin.search', [
            'customer' => $customer,
            'tax' => $request->tax,
        ]);
    }
}
