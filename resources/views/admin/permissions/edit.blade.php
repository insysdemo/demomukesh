<form method="post" action="{{ route('permission.update', $data->id) }}">
    @csrf
    @method('put')
    <div class="modal-body pre-scrollable">

        <div class="form-group">
            <input type="text" class="form-control input-rounded" placeholder="Enter roles" name="name"
                value="{{ $data->name }}">
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger light" data-dismiss="modal" onclick="hideDiv(this)">Close</button>
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
<script src="{{ asset('public/assets/dist/admin/formsubmit.js') }}"></script>
