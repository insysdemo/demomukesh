<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Traits\ApiResponse;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Role_has_permission;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use DB;

class RoleHasPermissionController extends Controller
{
    use ApiResponse ,HasRoles;

    public function index()
    {
        return view("admin.role_has_permission.index");
    }

    public function create()
    {
        $Role = Role::get();
        $Permission = Permission::get();
        return view('admin.role_has_permission.add', compact(['Role', 'Permission']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $role = $request->role;
        $validated = $request->validate(['role' => ['required'], 'permission' => ['required']]);
        $Role = Role::where('id', $request->role)->first();
        $permission = Permission::where('id', $request->permission)->first();
        $Role->givePermissionTo($request->permission);
        return view('admin.role_has_permission.index');
    }


    public function show($id)
    {
    }

    public function edit($id)
    {
        $data = Role_has_permission::select('permission_id')->where('role_id', $id)->get();
        $Permission = Permission::orderBy('name')->get()->groupBy('role_name');
        $arrayid = [];
        foreach ($data as $permission_id) {
            $arrayid[] = $permission_id->permission_id;
        }
        // dd($arrayid);
        $html = (string)view('admin.role_has_permission.edit', compact(['arrayid', 'Permission', 'id']));
        return response()->json($html);
    }

    public function update(Request $request, $id)
    {
        $role = $id;
        $Role = Role::where('id', $id)->first();
        $Role->revokePermissionTo(Permission::all());
        $data =[];
        if (isset($request->permisssion)) {
            // foreach ($request->permisssion as $give_permission) {

            //     $Role = Role::where('id', $role)->first();
            //     Permission::where('id', $request->permisssion)->first();

            //     $Role->givePermissionTo($give_permission);
            // }
            foreach($request->permisssion as $give_permission){
                $data['role_id'] =  $role;
                 $data['permission_id']  =$give_permission;
                 DB::table('role_has_permissions')->insert($data);
            }
        }
        return redirect()->back()->with('success', 'Access updated successfully.');
    }

    public function destroy($id)
    {
    }

    public function list(Request $request)
    {

        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));

        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'updated_at',
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
            $Role_has_permission = Role_has_permission::where('role_id', $r->id)->get();
            $array = [];
            foreach ($Role_has_permission as $permission) {
                $permission_name = Permission::where('id', $permission->permission_id)->first();
                $array[] = $permission_name->name;
            }
            $final_str = implode(",", $array);

            $edit = "";
            if (Auth::user()->can('Rolehaspermission edit')) {
                $edit = '<a  onclick="editrolehaspermission( this, ' . $r->id . ')" data-target="commonModal" class="btn btn-primary shadow btn-xs sharp mr-1 fa fa-pencil"></a>';
            }
            $jsonObject = array();
            $jsonObject[] = ucfirst($r->name);
            $jsonObject[] = $final_str;
            $jsonObject[] = $r->updated_at->format('Y-m-d H:i:s');
            $jsonObject[] = $edit;
            $jsonArray['data'][] = $jsonObject;
        }
        return json_encode($jsonArray);
    }
}
