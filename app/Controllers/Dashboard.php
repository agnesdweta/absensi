<?php

namespace App\Controllers;

use App\Models\CutiModel;
use App\Models\LogModel;
use App\Models\KaryawanModel;
use App\Models\AbsensiModel;

class Dashboard extends BaseController
{
    public function index()
{
    $role = session()->get('role');

    // ===== ADMIN =====
    if ($role == 'admin') {

        $cuti = new CutiModel();
        $log  = new LogModel();
        $karyawan = new KaryawanModel();
        $absen = new AbsensiModel();

        // ===== STATISTIK CUTI =====
        $data['total_cuti'] = $cuti->countAll();
        $data['pending']    = (new CutiModel())->where('status','pending')->countAllResults();
        $data['disetujui']  = (new CutiModel())->where('status','disetujui')->countAllResults();
        $data['ditolak']    = (new CutiModel())->where('status','ditolak')->countAllResults();

        // ===== KARYAWAN =====
        $data['total_karyawan'] = $karyawan->countAll();

        // ===== ABSENSI HARI INI =====
        $today = date('Y-m-d');

        $data['hadir'] = (new AbsensiModel())
            ->where('tanggal', $today)
            ->where('status','hadir')
            ->countAllResults();

        $data['tidak_hadir'] = (new AbsensiModel())
            ->where('tanggal', $today)
            ->where('status','tidak_hadir')
            ->countAllResults();

        // ===== GRAFIK =====
        $bulan = [];
        $jumlah = [];

        for ($i=1; $i<=12; $i++) {
            $bulan[] = date('M', mktime(0,0,0,$i,1));
            $jumlah[] = (new CutiModel())
                ->where('MONTH(tanggal_mulai)', $i)
                ->countAllResults();
        }

        $data['bulan'] = json_encode($bulan);
        $data['jumlah'] = json_encode($jumlah);

        // ===== LOG =====
        $data['log'] = $log->orderBy('id','DESC')->findAll(5);

        return view('admin/dashboard', $data);
    }

    // ===== USER =====
    else {

        $username = session()->get('username');

        $cuti = new CutiModel();
        $absen = new AbsensiModel();

        $data['total_cuti'] = $cuti
            ->where('nama_karyawan', $username)
            ->countAllResults();

        $data['pending'] = (new CutiModel())
            ->where('nama_karyawan', $username)
            ->where('status','pending')
            ->countAllResults();

        $data['hadir'] = $absen
            ->where('nama_karyawan', $username)
            ->where('tanggal', date('Y-m-d'))
            ->where('status','hadir')
            ->countAllResults();

        return view('user/dashboard', $data);
    }
}
}

