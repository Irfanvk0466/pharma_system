@extends('layout.navigation.master')

@section('title', 'Pharma System')

@section('content-header')
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Update Job Report</h3>
    </div>
    <form action="{{ route('jobreports.update', $jobReport->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card-body">
        <div class="form-group">
            <label for="content">Content</label>
            <input type="text" class="form-control" id="content" name="content" placeholder="Enter content" value="{{ $jobReport->content }}">
        </div>
        <div class="form-group">
            <label for="file">File Input</label>
            <div class="input-group">
                <input type="file" class="form-control" id="file" name="file">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
    </form>
</div>
@endsection
