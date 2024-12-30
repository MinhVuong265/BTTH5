<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::with('department')->get(); // Eager load department
        return view('staffs.index', compact('staff'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('staffs.create', compact('departments'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'nullable|max:255',
            'academic_rank' => 'nullable|max:255',
            'degree' => 'nullable|max:255',
            'phone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);
        Staff::create($validatedData);

        return redirect()->route('staffs.index')->with('success', 'Staff created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        return view('staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        $departments = Department::all();
        return view('staffs.edit', compact('staff', 'departments'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'nullable|max:255',
            'academic_rank' => 'nullable|max:255',
            'degree' => 'nullable|max:255',
            'phone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);
        $staff->update($validatedData);

        return redirect()->route('staffs.index')->with('success', 'Staff updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('staffs.index')->with('success', 'Staff deleted successfully.');

    }
    public function editMyProfile()
    {
        $user = Auth::user();
        $staff = $user->staff;
        // dd($staff); // Để debug xem thử $staff có dữ liệu không
        if (!$staff) {
            abort(403, 'Bạn chưa được gán với thông tin nhân viên nào. Vui lòng liên hệ quản trị viên.');
        }

        return view('staffs.editMyProfile', compact('staff'));
    }

    public function updateMyProfile(Request $request)
    {
        $user = Auth::user();
        $staff = $user->staff;

        if (!$staff) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'phone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255|unique:staff,email,'.$staff->id,
        ]);

        $staff->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Your profile updated successfully!');
    }

}
