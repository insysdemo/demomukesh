@extends('admin.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('/public/assets/intlTelInput/intlTelInput.css') }}">
    <style>
        .iti--separate-dial-code {
            width: 100%;
        }
    </style>
@endsection
@section('title', '  - Admin | Create Employee')

@section('nav-link')
    <a href="#" class="nav-link disabled">{{ trans('app.Add ') }}</a>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('app.Add User') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('user.store', app()->getLocale()) }}" method="post"
                            redirect="{{ route('user.index', app()->getLocale()) }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="emp_name">{{ trans('app.Name') }}</label>
                                    <input type="text" name="name" class="form-control" id="emp_name"
                                    autocomplete="off" autofocus="autofocus" onkeypress="handleKeyPress(event, this)" tabindex="1"  placeholder="{{ trans('app.Enter Name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ trans('app.Email') }}</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                    onkeypress="handleKeyPress(event, this)" tabindex="2" placeholder="{{ trans('app.Enter Email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="w-100">{{ trans('app.Phone') }}</label>
                                    <input type="hidden" name="country_code" id="country_code" value="91">
                                    <input type="tel" class="form-control" id="phone"
                                    onkeypress="handleKeyPress(event, this)" tabindex="3"  oninput="this.value = this.value.replace(/[^0-9]/, '')" name="phone"
                                        value="">
                                </div>


                                <div class="form-group">
                                    <label for="password">{{ trans('app.Password') }}</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                    onkeypress="handleKeyPress(event, this)" tabindex="4" placeholder="{{ trans('app.Enter Password') }}">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">{{ trans('app.Confirm Password') }}</label>
                                    <input type="password" name="confirm_password" class="form-control"
                                    onkeypress="handleKeyPress(event, this)" tabindex="5"  id="confirm_password" placeholder="{{ trans('app.Enter Confirm Password') }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="image"
                                        class="block font-medium text-gray-700">{{ trans('app.Upload Image') }}</label>
                                    <div class="flex-wrap" id="uploaded_image" style="display: none;"></div>
                                    <div class="mt-1 custom-file">
                                        <input type="file" class="custom-file-input" tabindex="11" id="image"
                                            name="image" accept="image/*" onchange="updateFileName()">
                                        <label class="custom-file-label"
                                            id="image-label">{{ trans('app.Choose file') }}</label>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-xs text-muted">
                                            {{ trans('app.PNG, JPG, JPEG') }}
                                        </p>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" tabindex="6"> {{ trans('app.Submit') }}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@section('script')
    <script src="{{ asset('public/admin/common.js') }}"></script>
    <script src="{{ asset('public/admin/formsubmit.js') }}"></script>
    <script src="{{ asset('/public/assets/intlTelInput/intlTelInput.js') }}"></script>


@endsection
