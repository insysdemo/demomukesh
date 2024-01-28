@extends('admin.layouts.app')
@section('title', 'Admin | Roles')

@section('nav-link')
    <a href="#" class="nav-link disabled">{{ trans('app.Roles') }}</a>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/datatables/jquery.dataTables.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">

                                @include('admin.common.muldeletebtn', [
                                    'url' => route('role.multidestroy'),
                                ])
                            <h3 class="ml-auto">{{ trans('app.Roles') }}</h3>

                                <button type="button" class="btn btn-primary ml-auto" onclick="createRole(this)"
                                    data-target="commonModal">{{ trans('app.Create') }}</button>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="roles" class="table table-striped">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>
                                            <input type="checkbox" class="w-2 h-2 check-all" />
                                        </th>
                                        <th>{{ trans('app.Name') }}</th>
                                        {{-- <th>{{ trans('app.Visibility') }}</th> --}}
                                        <th>{{ trans('app.Created Date') }}</th>
                                        <th>{{ trans('app.Action') }}</th>
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
    <!-- /.content -->
@endsection

@section('script')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/common.js') }}"></script>
    <script src="{{ asset('admin/formsubmit.js') }}"></script>
    <script src="{{ asset('assets/admin/roles/index.js') }}"></script>
@endsection
