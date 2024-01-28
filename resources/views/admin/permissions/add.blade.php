@extends('Admin.layouts.app')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('permission.index') }}">Permissions Listing</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Permissions</a></li>

                </ol>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Permission</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('permission.store') }}"
                            redirect="{{ route('permission.index') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter permission name"
                                    name="permission">
                            </div>

                            <button type="submite" class="btn  btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/assets/dist/admin/formsubmit.js') }}"></script>
@endsection
