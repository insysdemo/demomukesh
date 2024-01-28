    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('role.store') }}" method="POST"
                                redirect="{{ route('role.index') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ trans('app.Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" autofocus="autofocus"
                                        placeholder="{{ trans('app.Role name') }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ trans('app.Submit') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/admin/formsubmit.js') }}"></script>
