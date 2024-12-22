@extends('layout.navigation.master')

@section('title', 'Pharma System')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Admin Dashboard</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    @foreach($employees as $employee)
        <div class="col-md-4 col-lg-3 mb-4">
            <a href="{{ route('departments.show', $employee->id) }}" class="card-link" style="text-decoration: none;">
                <div class="card shadow-lg border-0 h-100 clickable-card">
                    <div class="card-header bg-gradient-primary text-white">
                        <h5 class="card-title text-center mb-0">Employee Details</h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text">
                            <strong>Name:</strong> {{ $employee['name'] }}<br>
                            <strong>Job Reports Count:</strong> {{ $jobReportCount[$employee['id']] ?? 0 }}
                        </p>
                    </div>
                    <div class="card-footer bg-light text-center">
                        <span class="text-primary font-weight-bold">View Details</span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection
<style>
    .card-link {
        color: inherit;
    }
    .clickable-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .clickable-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
</style>
