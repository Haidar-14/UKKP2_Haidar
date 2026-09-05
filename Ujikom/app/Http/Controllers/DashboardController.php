<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard Admin
    public function admin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $totalLaporan  = Report::count();
        $totalUser     = User::count();

        return view('admin.dashboard', compact('totalLaporan', 'totalUser'));
    }

    // Dashboard Petugas
    public function petugas()
    {
        if (Auth::user()->role !== 'petugas') {
            abort(403);
        }

        $totalUserBiasa = User::where('role', 'user')->count();
        $totalLaporan   = Report::count();

        return view('petugas.dashboard', compact('totalUserBiasa', 'totalLaporan'));
    }

    // Dashboard User
    public function user()
    {
        if (Auth::user()->role !== 'user') {
            abort(403);
        }

        $namaPelapor = Auth::user()->nama;
        $totalLaporanSaya = Report::where('nama_pelapor', $namaPelapor)->count();

        return view('user.dashboard', compact('totalLaporanSaya'));
    }
}