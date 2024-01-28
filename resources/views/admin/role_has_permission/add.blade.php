@extends('Admin.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('role-has-permission.index') }}">Access  Listing</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add New Access </a></li>

            </ol>
        </div>
        <!-- row -->



        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add New Access</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="POST" action="{{ route('role-has-permission.store') }}" enctype="multipart/form-data">
@csrf
                        <div class="form-group">
                            <label>Select Role (select one):</label>
                            <select class="form-control" id="sel1" tabindex="-98" name="role">
                                @foreach($Role as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select permission</label>
                            <select class="form-control" id="sel1" tabindex="-98" name="permission">
                                @foreach($Permission as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>

                                @endforeach
                            </select>
                        </div>

                        <button type="submite" class="btn btn-rounded btn-outline-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
        {{--  <script src="{{ asset('public/dist/admin/formsubmit.js') }}"></script>  --}}
@endsection
