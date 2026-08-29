<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'reports';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_pelapor',
        'email_pelapor',
        'no_telp_pelapor',
        'keterangan',
        'file_upload',
    ];
}