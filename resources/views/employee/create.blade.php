@extends('layout.navigation.master')

@section('title', 'Pharma System')

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Job Report</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create Job Report</h3>
    </div>
    <form action="{{ route('jobreports.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="content">Content</label>
            <input type="text" class="form-control" id="content" name="content" placeholder="Enter content" required>
        </div>
        <div class="form-group">
    <label for="file">File Input</label>
    <div class="input-group">
        <input type="file" class="form-control" id="file" name="file" required>
    </div>
</div>
      
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>
@endsection
