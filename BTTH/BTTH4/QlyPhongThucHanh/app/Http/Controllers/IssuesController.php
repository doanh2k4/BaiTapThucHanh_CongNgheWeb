<?php

namespace App\Http\Controllers;

use App\Models\Issues;
use App\Models\Computers;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    // Hiển thị danh sách các vấn đề (có phân trang)
    public function index()
    {
        // Sử dụng paginate để phân trang
        $issues = Issues::with('computer')->paginate(10);
        return view('issues.index', compact('issues'));
    }

    // Hiển thị form tạo vấn đề mới
    public function create()
    {
        $computers = Computers::all(); // Lấy danh sách máy tính để chọn
        return view('issues.create', compact('computers'));
    }

    // Lưu vấn đề mới
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào (validation)
        $request->validate([
            'computer_id' => 'required|exists:computers,id', // Kiểm tra máy tính tồn tại
            'computer_name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'reported_by' => 'required|string|max:255',
            'reported_date' => 'required|date',
            'urgency' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        // Lưu vấn đề vào cơ sở dữ liệu
        Issues::create($request->all());    

        // Điều hướng trở lại trang danh sách vấn đề
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được thêm thành công!');
    }

    // Hiển thị form chỉnh sửa vấn đề
    public function edit($id)
{
    // Retrieve the issue from the database
    $issue = Issues::findOrFail($id);

    // Pass the issue to the edit view
    return view('issues.edit', compact('issue'));
}

    // Cập nhật thông tin vấn đề
    public function update(Request $request, $id)
    {
        // Kiểm tra dữ liệu đầu vào (validation)
        $request->validate([
            'computer_id' => 'required|exists:computers,id', // Kiểm tra máy tính tồn tại
            'computer_name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'reported_by' => 'required|string|max:255',
            'reported_date' => 'required|date',
            'urgency' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        // Tìm và cập nhật vấn đề
        $issue = Issues::findOrFail($id);
        $issue->update($request->all());

        // Điều hướng trở lại trang danh sách vấn đề với thông báo thành công
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được cập nhật thành công!');
    }

    // Xóa vấn đề
    public function destroy($id)
    {
        $issue = Issues::findOrFail($id); // Tìm vấn đề theo ID
        $issue->delete(); // Xóa vấn đề

        // Điều hướng trở lại trang danh sách vấn đề với thông báo thành công
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được xóa thành công!');
    }
}
