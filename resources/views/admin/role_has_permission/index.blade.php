@extends('admin.layouts.app')
@section('title', 'Admin | Roles')

@section('nav-link')
    <a href="#" class="nav-link disabled">{{ trans('app.Roles') }}</a>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/datatables/jquery.dataTables.min.css') }}">
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="ml-auto">{{ trans('app.Roles') }}</h3>

                        @if (Auth::user()->can('Rolehaspermission create'))
                        <a href="{{ route('role-has-permission.create') }}" class="btn btn-outline-primary"
                           style="margin-left:auto">Add New Access</a>
                        @endif

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example" class="table table-striped">
                            <thead>
                                <tr class="text-uppercase">
                                    <th class="text-capitalize">Role</th>
                                    <th class="text-capitalize">Permission</th>
                                    <th class="text-capitalize">Last Modified</th>
                                    <th class="text-capitalize">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

@endsection

@section('script')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/common.js') }}"></script>
    <script src="{{ asset('admin/formsubmit.js') }}"></script>
    <script src="{{ asset('assets/admin/Role_has_permission/index.js') }}"></script>
@endsection

