<?php

namespace App\Http\Controllers;

use App\Models\JobReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $jobDetails = JobReport::where('employee_id', $userId)->paginate(10);
        return view('employee.index', compact('jobDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'string|max:255',
            'file' => 'mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);
        $userId = Auth::id();
        $filePath = $this->fileUploads($request);
        JobReport::create([
            'content' => $request->content,
            'file_path' => $filePath,
            'employee_id' => $userId
        ]);
        return redirect()->route('jobreports.index')->with('success', 'Jobreport submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobReport = JobReport::findOrFail($id);
        return view('employee.edit', compact('jobReport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jobReport = JobReport::findOrFail($id);
        $request->validate([
            'content' => 'string|max:255',
            'file' => 'mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);
        $filePath = $this->fileUploads($request);
        $jobReport->content = $request->content;
        if ($filePath) {
            $jobReport->file_path = $filePath;
        }
        $jobReport->save();
        return redirect()->route('jobreports.index')->with('success', 'Jobreport updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobReport = JobReport::findOrFail($id);
        if ($jobReport->file_path && file_exists(public_path('storage/' . $jobReport->file_path))) {
            unlink(public_path('storage/' . $jobReport->file_path));
        }
        $jobReport->delete();
        return redirect()->route('jobreports.index')->with('success', 'Jobreport deleted successfully!');
    }

    /**
     * Handle file uploads for the job report.
     * 
     * @param Request $request
     * @return string|null
     * 
     */
    private function fileUploads($request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            return $filePath;
        } else {
            return null;
        }
    }
}
