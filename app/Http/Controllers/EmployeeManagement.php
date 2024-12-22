<?php 

namespace App\Http\Controllers;

use App\Models\JobReport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EmployeeManagement extends Controller
{
    /**
     * Display the job reports for employees in the department.
     *      * 
     * @param Request
     * @return View
     */
    public function jobList(Request $request)
    {
        $user = Auth::user();
        $departmentId = $user->department_id;
        $employees = JobReport::getEmployees($departmentId);
        $employeeId = $request->employee_id;
        $jobReports = JobReport::getReports($employees, $employeeId);
        return view('department_head.index', compact('jobReports', 'employees', 'employeeId'));
    }

    /**
     * Display detailed job reports for a specific employee.
     *      * 
     * @param string $employee id
     * @return View
     */
    public function show(string $id)
    {
        $jobReports = JobReport::where('employee_id', $id)->paginate(10);
        return view('department_head.details', compact('jobReports'));
    }
}
