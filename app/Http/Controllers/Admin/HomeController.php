<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::user()->roles_id == 1) {
            return app(SuperAdminDashboardController::class)->Dashboard();
        }else {
            return app(SuperAdminDashboardController::class)->Dashboard();
        }
    }


}
