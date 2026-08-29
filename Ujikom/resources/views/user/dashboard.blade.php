@extends('layouts.app')

@section('title', 'Dashboard User')
@section('page-title', 'Dashboard Pelanggan')

@section('content')
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Laporan Saya</h6>
                        <h3 class="mb-0">{{ $totalLaporanSaya }}</h3>
                    </div>
                    <i class="bi bi-file-earmark-text fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection