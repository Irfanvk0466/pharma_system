@extends('layout.navigation.master')

@section('title', 'Pharma System')

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Work Update Details</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Work Update Details</h3>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-tools d-flex">
                    <a href="{{ route('jobreports.create') }}" class="btn btn-primary mr-3">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Content</th>
                            <th>File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($jobDetails as $index => $job)
                    <tr>
                        <td>{{ $index +  1 }}</td>
                        <td>{{ $job->content }}</td>
                        <td>
                            @if ($job->file_path)
                                @php
                                    $fileExtension = pathinfo($job->file_path, PATHINFO_EXTENSION);
                                @endphp
                                @if (in_array(strtolower($fileExtension), ['jpeg', 'jpg', 'png', 'gif']))
                                    <a href="{{ asset('storage/' . $job->file_path) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $job->file_path) }}" alt="File Image" style="max-width: 150px; max-height: 150px;">
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . $job->file_path) }}" download class="btn btn-success btn-sm">
                                        <i class="fas fa-download"></i> Download PDF
                                    </a>
                                @endif
                            @else
                                No File
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('jobreports.edit', $job->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('jobreports.destroy', $job->id) }}" method="POST" style="display:inline-block;">
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
                {{ $jobDetails->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
