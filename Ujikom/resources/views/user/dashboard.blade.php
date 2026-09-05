@extends('layouts.app')

@section('title', 'Dashboard User')
@section('page-title', 'Dashboard Pelanggan')

@section('content')
<div class="row">
    <!-- Kartu Total Laporan Saya -->
    <div class="col-md-6 mb-3">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Laporan Saya</h6>
                    <h3 class="mb-0">{{ $totalLaporanSaya }}</h3>
                </div>
                <i class="bi bi-file-earmark-text fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>
@endsection