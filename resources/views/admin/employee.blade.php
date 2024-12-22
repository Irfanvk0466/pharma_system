@extends('layout.navigation.master')

@section('title', 'Pharma System')

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Employees</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Employees</h3>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <!-- Table -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($employees as $index => $employee)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>
                            <a href="{{ route('departments.employee-assign', $employee->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Assign Dept
                            </a>                       
                        </td>
                    </tr>
                    @endforeach
                </tbody>

                </table>
            </div>
            <!-- Pagination -->
            <div class="card-footer">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
