<?php

namespace App\Models;

use CodeIgniter\Model;

class CutiModel extends Model
{
    protected $table = 'cuti';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_karyawan',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
        'status'
    ];
}