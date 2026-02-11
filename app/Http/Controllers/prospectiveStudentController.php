<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Models\User;

class prospectiveStudentController extends Controller
{
 
    public function biodata(){
        return view('prospectiveStudent.biodata');
    }
}
