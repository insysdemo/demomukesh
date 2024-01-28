<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view("admin.permissions.index");
    }

    public function create()
    {
        return view('Admin.permissions.add');
    }

    public function store(Request $request)
    {
        $request->validate(['permission' => ['required', 'min:3', 'unique:permissions,name']]);
        // 'email' => 'required|string|email|unique:users,email',

        $permission = new Permission();
        $permission->name = $request->permission;
        $permission->guard_name = "admin";
        $get_first = explode(' ', trim($request->permission));
        $permission->role_name = $get_first[0];
        $permission->save();
        $Role = Role::where('id', 1)->first();
        $Role->givePermissionTo($request->permission);
        if ($permission) {
            return redirect()->route('permission.index')->with('success', 'Permission created successfully.');
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $data = Permission::where('id', $id)->first();
        $html = (string)view('admin.permissions.edit', compact('data'));
        return response()->json($html);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $data = Permission::where('id', $id)->first();
        $data->update(['name' => $request->name]);
        if (isset($data)) {
            return redirect()->route('permission.index')->with('success', "Permission update successfully.");

        } else {
            return $this->sendResponse('Something want wrong. Please try later.', 404);
        }
    }


    public function destroy($id)
    {
        Permission::where('id', $id)->delete();
        return redirect()->route('permission.index')->with('success', 'Permission deleted successfully.');
    }

    public function list(Request $request)
    {

        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));

        $columns = array(
            0 => 'id',
            1 => 'permissions',
            2 => 'created_at',
            3 => 'created_at',
        );

        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;
        $data = new Permission();
        $jsonArray['recordsTotal'] = $data->count();
        if ($request->search['value']) {
            $search = $request->search['value'];
            $data = $data->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%{$search}%");
            });
        }
        $jsonArray['recordsFiltered'] = $data->count();
        $data = $data->orderby($column, $dir)->offset($offset)->limit($limit)->get();
        $jsonArray['data'] = array();
        foreach ($data as $r) {
            $delete = "";
            $edit = "";
            if (Auth::user()->can('Permission delete')) {
                $delete = (string)view("Admin.common.deletebtn", ["url" => route('permission.destroy', $r->id)]);
            }
            if (Auth::user()->can('Permission edit')) {
                $edit = '<a  onclick="editpermission( this, ' . $r->id . ')" data-target="commonModal" class="btn btn-primary shadow btn-xs sharp mr-1 fa fa-pencil"></a>';
            }
            $name = ucfirst($r->name);
            if (Auth::user()->can('Permission edit')) {
                $name = '<a type="button" class="p-1 px-2 mr-1 underline" onclick="editpermission( this, ' . $r->id . ')" data-target="commonModal" style="color: blue; ">' . $r->name . '</a>';
            }
            $jsonObject = array();
            $jsonObject[] = '<input type="checkbox" name="checkid[]" class="all_del check-item w-4 h-4" value="' . $r->id . '"/>';
            $jsonObject[] = $r->id;
            $jsonObject[] = $name;
            $jsonObject[] = $r->created_at->format('Y-m-d H:i:s');
            $jsonObject[] = $delete . $edit;
            $jsonArray['data'][] = $jsonObject;
        }
        return json_encode($jsonArray);
    }

    public function multidestroy(Request $request)
    {
        if (isset($request->ids)) {
            foreach ($request->ids as $id) {
                $role = Permission::where('id', $id)->first();
                $role->delete();
            }
            return $this->sendResponse('Permissions deleted successfully.', 200);
        } else {
            return $this->sendResponse('Please select record you want to Delete.', 404);
        }
    }
}
