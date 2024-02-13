<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        switch (Auth::user()->role_id == 1) {
            case true:
                return redirect((route('admin.dashboard')));
                break;
            default:
                return redirect(route('student.dashboard'));
                break;
        }
    }
}
