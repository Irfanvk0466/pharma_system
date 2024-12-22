<?php

namespace App\Http\Controllers;

use App\Models\JobReport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the department head's dashboard.
     *
     * @return View
     */
    public function departmentHeadDashboard()
    {
        $user = Auth::user();
        $departmentId = $user->department_id;
        $employees = JobReport::getEmployees($departmentId);
        $jobReportCount = JobReport::getJobReportCounts($employees);
        return view('department_head.dashboard', compact('employees', 'jobReportCount'));
    }

    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function adminDashboard()
    {
        $userId = Auth::id();
        $employees = User::where('role', User::EMPLOYEE)->get();
        $jobReportCount = JobReport::getJobReportCounts($employees);
        return view('admin.dashboard', compact('employees', 'jobReportCount'));
    }
}
