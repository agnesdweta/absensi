<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log_aktivitas';
    protected $allowedFields = ['aktivitas', 'user', 'aksi'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}