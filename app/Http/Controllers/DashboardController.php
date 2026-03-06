<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
     public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('administration')) {
            return redirect()->route('administration.dashboard');
        }

        if ($user->hasRole('teacher')) {
            return redirect()->route('teacher.dashboard');
        }

        if ($user->hasRole('student')) {
            return redirect()->route('student.dashboard');
        }

        abort(403, 'Role tidak dikenali.');
    }
    public function dashboard(){
        return view('administration.dashboard');
    }
}
