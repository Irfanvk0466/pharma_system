<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobReport extends Model
{
    protected $fillable = [
        'employee_id',
        'content',
        'file_path',
    ];

    /**
     * Define a relationship: A JobReport belongs to a User.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    /**
     * Retrieve employees of a specific department.
     *
     * @param int $departmentId
     * @return Collection
     */
    public static function getEmployees($departmentId)
    {
        return User::where('role', User::EMPLOYEE)
            ->where('department_id', $departmentId)
            ->get();
    }

    /**
     * Retrieve job reports for a set of employees.
     *
     * @param \Illuminate\Support\Collection|array $employees
     * @param int|null $employeeId
     * @return collection
     */
    public static function getReports($employees, $employeeId = null)
    {
        $employeeIds = $employees->pluck('id');
        $query = JobReport::whereIn('employee_id', $employeeIds)
            ->with('user:id,name,email');
        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }
        return $query->paginate(10);
    }

    /**
     * Calculate the number of job reports for each employee.
     *
     * @param array $employees
     * @return array
     */
    public static function getJobReportCounts($employees)
    {
        $jobReportsByEmployee = [];
        foreach ($employees as $employee) {
            $jobReportsByEmployee[$employee->id] = self::where('employee_id', $employee->id)->count();
        }
        return $jobReportsByEmployee;
    }
}
