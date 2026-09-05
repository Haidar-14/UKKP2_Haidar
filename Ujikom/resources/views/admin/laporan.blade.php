@extends('layouts.app')

@section('title', 'Semua Laporan')
@section('page-title', 'Semua Laporan')

@section('content')
<div class="card">
    <div class="card-header">Daftar Laporan</div>
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelapor</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Keterangan</th>
                    <th>File</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $index => $report)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $report->nama_pelapor }}</td>
                        <td>{{ $report->email_pelapor ?? '-' }}</td>
                        <td>{{ $report->no_telp_pelapor ?? '-' }}</td>
                        <td>{{ $report->keterangan }}</td>
                        <td>
                            @if ($report->file_upload)
                                <a href="{{ asset('storage/uploads/reports/' . $report->file_upload) }}" target="_blank"
                                    class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-file-earmark"></i> Lihat
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-4">Belum ada laporan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection