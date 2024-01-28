<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.user.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:1|confirmed',
        ]);

        // Create a new user instance
        $user = new User();

        // Assign values to user attributes
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone_no = $validatedData['phone'];
        $user->password = bcrypt($validatedData['password']); // Hash the password

        // Save the user instance to the database
        $user->save();

        // You can handle the image upload if needed
        // Example: $user->update(['image' => $request->file('image')->store('images')]);

        // Redirect or return a response as needed
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
        $data = new User();


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


    // public function showRegistrationForm()
    // {
    //     return view('admin.user.registration');
    // }

    // public function register(Request $request)
    // {
    //     // Your code to handle registration form submission goes here
    //     // dd($request->all());
    // }


}
