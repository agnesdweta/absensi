<?php

namespace App\Controllers;

use App\Models\CutiModel;
use App\Models\AbsensiModel;

class User extends BaseController
{
    public function dashboard()
    {
        // ambil username dari session
        $username = session()->get('username');

        $cuti = new CutiModel();
        $absen = new AbsensiModel();

        // ===== DATA CUTI USER =====
        $data['total_cuti'] = $cuti->where('nama_karyawan', $username)->countAllResults();

        $data['pending'] = $cuti->where('nama_karyawan', $username)
                                ->where('status','pending')
                                ->countAllResults();

        $data['disetujui'] = $cuti->where('nama_karyawan', $username)
                                  ->where('status','disetujui')
                                  ->countAllResults();

        $data['ditolak'] = $cuti->where('nama_karyawan', $username)
                                ->where('status','ditolak')
                                ->countAllResults();

        // ===== ABSENSI HARI INI =====
        $today = date('Y-m-d');

        $data['hadir'] = $absen->where('nama_karyawan', $username)
                               ->where('tanggal', $today)
                               ->where('status','hadir')
                               ->countAllResults();

        $data['tidak_hadir'] = $absen->where('nama_karyawan', $username)
                                    ->where('tanggal', $today)
                                    ->where('status','tidak_hadir')
                                    ->countAllResults();

        return view('user/dashboard', $data);
    }
}