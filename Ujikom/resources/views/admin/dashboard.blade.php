@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="row">
    <!-- Kartu Total Laporan -->
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Total Laporan</h6>
                    <h3 class="mb-0">{{ $totalLaporan }}</h3>
                </div>
                <i class="bi bi-file-earmark-text fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Kartu Total User -->
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Total User</h6>
                    <h3 class="mb-0">{{ $totalUser }}</h3>
                </div>
                <i class="bi bi-people fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Kartu Menu Navigasi -->
</div>
@endsection