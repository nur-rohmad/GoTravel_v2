<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = User::where('role', 'pelanggan')->get();

        return view('admin.pelanggan.index', compact('pelanggan'));
    }
}
