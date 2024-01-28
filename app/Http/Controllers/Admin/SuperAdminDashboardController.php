<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminDashboardController extends Controller
{
    public function Dashboard(){

        return view('admin.dashboard.index');
    }
}
