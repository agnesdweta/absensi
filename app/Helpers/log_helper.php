<?php

use App\Models\LogModel;

function simpan_log($aktivitas, $aksi)
{
    $log = new LogModel();

    $log->save([
        'aktivitas' => $aktivitas,
        'aksi'      => $aksi,
        'user'      => session()->get('username')
    ]);
}