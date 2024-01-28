<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;

class AdminLoginController extends Controller
{
    //
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function logout(Request $request, $id)
    {
        if (session()->get('login_via_link') && Auth::user()->id != '1') {
            $user = User::find($id);
            // $user->where('id', Auth::user()->id)->update(["year" => NULL]);
            $user = User::find($id);

            Auth::guard('admin')->logout();
            Auth::guard('admin')->login($user);
            return redirect()->to('/admin/login');
        } else {
            $user = User::find($id);
            // $user=$user->where('id', Auth::user()->id)->update(["year" => NULL]);
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->to('/admin/login');
        }
    }
    public function login(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'exists:users,email', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            Auth::user()->update([
                'login_time' => Carbon::now()
            ]);
            return  redirect()->to('/home');
        } else {
            return redirect()->route('login.from')->with('error',  'Oppes! You have entered invalid credential');
        }
    }

    public function loginForm()
    {
        return view('admin.auth.login');
    }
}
