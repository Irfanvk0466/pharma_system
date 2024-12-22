@extends('layout.navigation.master')

@section('title', 'Pharma System')

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Departments</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Departments</h3>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-tools d-flex">
                    <a href="{{ route('departments.create') }}" class="btn btn-primary mr-3">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Department Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($departments as $index => $department)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $department->name }}</td>
                        <td>
                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('departments.assign',$department->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Assign Head
                            </a>
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

                </table>
            </div>
            <!-- Pagination -->
            <div class="card-footer">
                {{ $departments->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
