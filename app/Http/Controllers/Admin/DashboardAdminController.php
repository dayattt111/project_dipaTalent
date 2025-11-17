<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // $pendaftaran = Pendaftaran::with(['user', 'beasiswa'])->get();
        return view('admin.dashboard');
    }
}
