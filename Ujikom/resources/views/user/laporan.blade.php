@extends('layouts.app')

@section('title', 'Laporan Saya')
@section('page-title', 'Laporan Saya')

@section('content')
    <!-- Tombol Buat Laporan -->
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLaporan">
            <i class="bi bi-plus-circle"></i> Buat Laporan
        </button>
    </div>

    <!-- Tabel Riwayat Laporan -->
    <div class="card">
        <div class="card-header">Riwayat Laporan</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>File</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->keterangan }}</td>
                            <td>{{ $report->email_pelapor ?? '-' }}</td>
                            <td>{{ $report->no_telp_pelapor ?? '-' }}</td>
                            <td>
                                @if ($report->file_upload)
                                    <a href="{{ asset('storage/uploads/reports/' . $report->file_upload) }}" target="_blank"
                                        class="btn btn-sm btn-info">
                                        <i class="bi bi-file-earmark"></i> Lihat
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada laporan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Buat Laporan -->
    <div class="modal fade" id="modalLaporan" tabindex="-1" aria-labelledby="modalLaporanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLaporanLabel"><i class="bi bi-plus-circle"></i> Buat Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user.laporan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Data pelapor otomatis dari user login -->
                        <div class="mb-3">
                            <label for="nama_pelapor" class="form-label">Nama Pelapor</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->nama }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="email_pelapor" class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="no_telp_pelapor" class="form-label">No Telp</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->no_telp ?? '-' }}" disabled>
                        </div>

                        <!-- Isi laporan -->
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan / Isi Laporan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="5"
                                required>{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- Upload bukti opsional -->
                        <div class="mb-3">
                            <label for="file_upload" class="form-label">Upload Bukti (opsional, JPG/PNG/PDF, maks 2MB)</label>
                            <input type="file" name="file_upload" id="file_upload" class="form-control"
                                accept=".jpg,.jpeg,.png,.pdf">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Kirim Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Jika ada error validasi, buka modal secara otomatis
        @if ($errors->any())
            var modalLaporan = new bootstrap.Modal(document.getElementById('modalLaporan'));
            modalLaporan.show();
        @endif
    </script>
@endpush