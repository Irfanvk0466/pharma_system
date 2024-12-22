@extends('layout.navigation.master')

@section('title', 'Pharma System')

@section('content-header')
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Update Department</h3>
    </div>
    <form action="{{ route('departments.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card-body">
        <div class="form-group">
            <label for="name">Department Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Department" value="{{ $department->name }}">
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
    </form>
</div>
@endsection
