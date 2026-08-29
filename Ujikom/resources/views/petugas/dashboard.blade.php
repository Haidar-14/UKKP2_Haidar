@extends('layouts.app')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

@section('content')
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total User</h6>
                        <h3 class="mb-0">{{ $totalUserBiasa }}</h3>
                    </div>
                    <i class="bi bi-people fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Laporan</h6>
                        <h3 class="mb-0">{{ $totalLaporan }}</h3>
                    </div>
                    <i class="bi bi-file-earmark-text fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection