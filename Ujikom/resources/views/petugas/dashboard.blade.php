@extends('layouts.app')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

@section('content')
<div class="row">
    <!-- Kartu Total User Biasa -->
    <div class="col-md-6 mb-3">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Total User</h6>
                    <h3 class="mb-0">{{ $totalUserBiasa }}</h3>
                </div>
                <i class="bi bi-people fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Kartu Total Laporan -->
    <div class="col-md-6 mb-3">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Total Laporan</h6>
                    <h3 class="mb-0">{{ $totalLaporan }}</h3>
                </div>
                <i class="bi bi-file-earmark-text fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>
@endsection