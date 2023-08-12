<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardManagerController extends Controller
{
    public function index()
    {
        return view('manager/dashboard/index');
    }

}
