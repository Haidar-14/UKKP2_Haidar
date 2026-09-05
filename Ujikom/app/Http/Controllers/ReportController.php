<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan milik user.
     */
    public function myReports(Request $request)
    {
        $namaPelapor = Auth::user()->nama;

        // Ambil laporan milik user, urutkan terbaru
        $reports = Report::where('nama_pelapor', $namaPelapor)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.laporan', compact('reports'));
    }

    /**
     * Menyimpan laporan baru.
     * Email & no_telp otomatis dari user login.
     */
    public function store(Request $request)
    {
        $request->validate([
            'keterangan'  => 'required|string|min:5',
            'file_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/reports', $fileName, 'public');
        }

        Report::create([
            'nama_pelapor'    => Auth::user()->nama,
            'email_pelapor'   => Auth::user()->email,
            'no_telp_pelapor' => Auth::user()->no_telp,
            'keterangan'      => $request->keterangan,
            'file_upload'     => $fileName,
        ]);

        return redirect()->route('user.laporan.index')
            ->with('success', 'Laporan berhasil dikirim.');
    }

    /**
     * Menampilkan semua laporan untuk admin.
     */
    public function adminIndex(Request $request)
    {
        $reports = Report::orderBy('created_at', 'desc')->get();

        return view('admin.laporan', compact('reports'));
    }
}