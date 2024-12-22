<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\JobReport;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of all departments with pagination.
     */
    public function index()
    {
        $departments = Department::paginate(10);
        return view('admin.index', compact('departments'));
    }

    /**
     * Show the form for creating a new department.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created department in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);
        Department::create([
            'name' => $request->name,
        ]);
        return redirect()->route('departments.index')->with('success', 'Department created successfully!');
    }

    /**
     * Display the job reports for employees in a department.
     */
    public function show(string $id)
    {
        $jobReports = JobReport::where('employee_id', $id)->paginate(10);
        return view('admin.details',compact('jobReports'));
    }

    /**
     * Show the form for editing a department.
     */
    public function edit(string $id)
    {
        $department = Department::findOrFail($id);
        return view('admin.edit', compact('department'));
    }

    /**
     * Update the specified department in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $id,
        ]);
        $department = Department::findOrFail($id);
        $department->update(['name' => $request->name]);
        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }

    /**
     * Remove the specified department from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully!');
    }

    /**
     * Assign a department head to a department.
     */
    public function assignHead(string $id)
    {
        $department = Department::findOrFail($id);
        $users = User::where('role', User::DEPARTMENT_HEAD)->get();
        return view('admin.assign', compact('department', 'users'));
    }

    /**
     * Designate a department head.
     */
    public function designateHead(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $user = User::findOrFail($request->user_id);
        $user->department_id = $request->department_id;
        $user->save();
        return redirect()->route('departments.index')->with('success', 'Department head assigned successfully!');
    }

    /**
     * List all employees with pagination.
     */
    public function employeeList()
    {
        $employees = User::where('role', User::EMPLOYEE)->with('department')->paginate(10);
        return view('admin.employee', compact('employees'));
    }

    /**
     * Show the form for assigning a department to an employee.
     */
    public function assignEmployee(string $id)
    {
        $employee = User::findOrFail($id);
        $departments = Department::all();
        return view('admin.employee-assign', compact('employee', 'departments'));
    }

    /**
     * Designate a department for an employee.
     */
    public function designateEmployee(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
        ]);
        $employee = User::findOrFail($request->employee_id);
        $employee->department_id = $request->department_id;
        $employee->save();
        return redirect()->route('departments.employee')->with('success', 'Employee assigned successfully!');
    }

    /**
     * Get job reports for employees, optionally filtering by a specific employee.
     */
    public function employeeJobs(Request $request)
    {
        $employeeId = $request->employee_id;
        $employees = User::where('role', User::EMPLOYEE)->with('jobReports')->get();
        $jobList = JobReport::getReports($employees, $employeeId);
        return view('admin.employee-jobs', compact('jobList', 'employees'));
    }
}
