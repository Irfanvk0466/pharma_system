@extends('layout.navigation.master')

@section('title', 'Pharma System')

@section('content-header')
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Assign Employee</h3>
    </div>
    <form action="{{ route('departments.assignDepartment') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="employee_id" value="{{ $employee->id }}">

        <div class="card-body">
            <div class="form-group">
                <label for="department_id">Select Department</label>
                <select class="form-control" id="department_id" name="department_id" required>
                    <option value="">Select a Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" 
                            {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>
@endsection
