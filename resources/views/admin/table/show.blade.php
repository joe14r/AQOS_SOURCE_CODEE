@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tables.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong>
            {{ $data->title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {{ $data->description }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{ asset('storage/' . $data->image) }}" alt="Uploaded Image" width="200">
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>QR Code:</strong>
            <img src="{{ $qr_code }}" alt="QR Code" width="200">

            <p>Order URL: <a href="{{ url('/menu-table/' . $data->tid) }}" target="_blank">{{ url('/menu-table/' . $data->tid) }}</a></p>

            <p>Scan to visit: <a href="{{ url('/admin/table/' . $data->tid) }}" target="_blank">{{ url('/admin/table/' . $data->tid) }}</a></p>
        </div>
    </div>
</div>
@endsection
