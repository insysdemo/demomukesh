@extends('admin.layouts.app')
@section('title', ' - Admin | Roles')

@section('nav-link')
    <a href="#" class="nav-link disabled">{{ trans('app.Roles') }}</a>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/datatables/jquery.dataTables.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Permissions Listing</a></li>
                    @if (Auth::user()->can('Permission create'))
                    <!-- <a href="{{ route('permission.create') }}" class="btn btn-primary" style="margin-left:auto">Add New Permission</a> -->

                    <div class="content__item" style="margin-left:auto">
                        <a href="{{ route('permission.create') }}" class="btn-primary button button--mimas" >
                            <span>Add New Permission</span>
                        </a>
                    </div>
                    @endif
                </ol>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header justify-content-end">
                            {{-- <h4 class="card-title">Basic Datatable</h4> --}}
                            @if (Auth::user()->can('Permission delete'))
                            @include('Admin.common.muldeletebtn', [
                            'url' => route('permission.multidestroy'),
                            ])
                            @endif
                        </div>
                        <div class="pt-0 card-body">
                            <div class="table-responsive">
                                <table id="example" class="display h-100 table-responsive-md" style="width: 1400px;">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" class="w-4 h-4 check-all" />
                                            </th>
                                            <th class="text-capitalize">ID</th>
                                            <th class="text-capitalize">Permission</th>
                                            <th class="text-capitalize">Created At</th>
                                            <th class="text-capitalize">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('script')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/common.js') }}"></script>
    <script src="{{ asset('admin/formsubmit.js') }}"></script>
    <script src="{{ asset('assets/admin/permission/index.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select[name="roles_length"]').addClass('custom-select py-0 m-2 ');

        });
    </script>
@endsection
