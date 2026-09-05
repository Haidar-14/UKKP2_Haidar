@extends('layouts.app')

@section('title', 'Kelola User')
@section('page-title', 'Kelola User')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar User</span>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUser">
            <i class="bi bi-plus-circle"></i> Tambah User
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Role</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->no_telp ?? '-' }}</td>
                        <td><span class="badge bg-primary">{{ $user->role }}</span></td>
                        <td>
                            <button class="btn btn-warning btn-sm btn-edit"
                                    data-id="{{ $user->id }}"
                                    data-nama="{{ $user->nama }}"
                                    data-email="{{ $user->email }}"
                                    data-no_telp="{{ $user->no_telp }}"
                                    data-role="{{ $user->role }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalUser">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4">Belum ada user</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah/Edit User -->
<div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formUser" action="{{ route('admin.user.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="POST">

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telp</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            @if (Auth::user()->role === 'admin')
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                <option value="user">User</option>
                            @elseif (Auth::user()->role === 'petugas')
                                <option value="user">User</option>
                            @endif
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const modalUser = document.getElementById('modalUser');
    const formUser = document.getElementById('formUser');
    const modalTitle = document.getElementById('modalTitle');
    const methodField = document.getElementById('methodField');
    const updateBaseUrl = "{{ url('admin/user') }}/";

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            modalTitle.textContent = 'Edit User';
            formUser.action = updateBaseUrl + id;
            methodField.value = 'PUT';

            document.getElementById('nama').value = this.dataset.nama;
            document.getElementById('email').value = this.dataset.email;
            document.getElementById('no_telp').value = this.dataset.no_telp;
            document.getElementById('role').value = this.dataset.role;
            document.getElementById('password').value = '';
            document.getElementById('password').required = false;
        });
    });

    modalUser.addEventListener('hidden.bs.modal', function() {
        modalTitle.textContent = 'Tambah User';
        formUser.action = "{{ route('admin.user.store') }}";
        methodField.value = 'POST';
        formUser.reset();
        document.getElementById('password').required = true;
    });
</script>
@endpush