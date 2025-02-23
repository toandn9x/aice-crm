<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Services\Helper;

class CustomerController extends Controller
{

    // Hiển thị danh sách khách hàng
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    // Hiển thị chi tiết một khách hàng
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show', compact('customer'));
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
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Cập nhật khách hàng thành công.');
    }

    // Xóa khách hàng
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Xóa khách hàng thành công.');
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
