@extends('layout.navigation.master')

@section('title', 'Pharma System')

@section('content-header')
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Assign Department Head</h3>
    </div>
    <form action="{{ route('departments.designate') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" class="form-control" id="name" name="department_name" value="{{ $department->name }}" readonly>
                <input type="hidden" name="department_id" value="{{ $department->id }}">
            </div>

            <div class="form-group">
                <label for="head">Select Department Head</label>
                <select class="form-control" id="head" name="user_id" required>
                    <option value="">Select a Department Head</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>
                            {{ $user->name }}
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
