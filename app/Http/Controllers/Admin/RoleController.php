<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view("admin.roles.index");
    }

    public function create()
    {
        $html = (string)view('admin.roles.create');
        // return $this->sendResponse('Page load successfully.', 200, $html);
        return response()->json($html);
    }

    public function store(Request $request)
    {

        $request->validate(['name' => ['required', 'min:3', 'unique:roles,name']]);
        $roles = new Role();
        $roles->name = $request->name;
        $roles->guard_name = "admin";
        $roles->save();
        if ($roles) {
            return redirect()->route('role.index')->with('success', "Role created successfully.', 200");
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Role::where('id', $id)->first();
        $html = (string)view('Admin.roles.edit', compact('data'));
        return response()->json($html);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);
        $data = Role::where('id', $id)->first();
        $data->update(['name' => $request->name]);
        if (isset($data)) {
            return redirect()->route('role.index')->with('success', "Role update successfully.");
        }
    }


    public function destroy($id)
    {
        Role::where("id", $id)->delete();
        return redirect()->route('role.index')->with('success', "Role deleted successfully");
        // return $this->sendResponse('Role deleted successfully.', 200);
    }



    public function list(Request $request)
    {
        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));

        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'created_at',
            3 => 'created_at',
        );

        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;
        $data = new Role();


        $jsonArray['recordsTotal'] = $data->count();
        if ($request->search['value']) {
            $search = $request->search['value'];
            $data = $data->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%{$search}%");
            });
        }
        $data = $data->where('id', '!=', 1);

        $jsonArray['recordsFiltered'] = $data->count();
        $data = $data->orderby($column, $dir)->offset($offset)->limit($limit)->get();
        $jsonArray['data'] = array();
        foreach ($data as $r) {
            $delete = "";
            $edit = "";
            $name = ucfirst($r->name);
            if (Auth::user()->can('Role delete')) {
                $delete = (string)view("Admin.common.deletebtn", ["url" => route('role.destroy', [$r->id])]);

            }
            if (Auth::user()->can('Role edit')) {
                   $edit = '<a onclick="editRole( this, ' . $r->id . ')" data-target="commonModal" class="btn btn-primary shadow btn-xs sharp mr-1 fa fa-pencil"></a>';

            }
            $jsonObject = array();
            $jsonObject[] = '<input type="checkbox" name="checkid[]" class="all_del check-item w-4 h-4" value="' . $r->id . '"/>';
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
                $role = Role::where('id', $id)->first();
                $role->delete();
            }
            return $this->sendResponse('Roles deleted successfully.', 200);
        } else {
            return $this->sendResponse('Please select record you want to Delete.', 404);
        }
    }

    public function rolevalidation(Request $request)
    {
        $email = Role::where('name',$request->name)->count();

        if ($email != 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

}
