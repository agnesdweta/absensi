<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user',
        'aktivitas',
        'aksi',
        'created_at'
    ];

    // AUTO TIMESTAMP
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    // ❌ JANGAN PAKAI string kosong
    protected $updatedField  = 'updated_at';

    // =======================
    // OOP METHOD (REUSABLE)
    // =======================
    public function tambahLog($user, $aktivitas, $aksi)
    {
        return $this->insert([
            'user'      => $user,
            'aktivitas' => $aktivitas,
            'aksi'      => $aksi
        ]);
    }
}