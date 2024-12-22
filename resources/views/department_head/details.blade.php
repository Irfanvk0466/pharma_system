@extends('layout.navigation.master')

@section('title', 'Pharma System')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Jobreport Details</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Jobreport Details</h3>
                <div class="card-tools d-flex">
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Name</th>
                            <th>Report Content</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($jobReports) > 0)
                            @foreach($jobReports as $index => $report)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $report->user->name }}</td>
                                    <td>{{ $report->content }}</td>
                                    <td>
                                        @if ($report->file_path)
                                            @php
                                                $fileExtension = pathinfo($report->file_path, PATHINFO_EXTENSION);
                                            @endphp
                                            @if (in_array(strtolower($fileExtension), ['jpeg', 'jpg', 'png', 'gif']))
                                                <img src="{{ asset('storage/' . $report->file_path) }}" alt="File Image" style="max-width: 150px; max-height: 150px;">
                                            @elseif (strtolower($fileExtension) === 'pdf')
                                                <a href="{{ asset('storage/' . $report->file_path) }}" download class="btn btn-success btn-sm">
                                                    <i class="fas fa-download"></i> Download PDF
                                                </a>
                                            @endif
                                        @else
                                            No File
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">No Job Reports Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $jobReports->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

