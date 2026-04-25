<?php

namespace App\Controllers;

use App\Models\CutiModel;
use App\Models\LogModel;
use App\Models\AbsensiModel;

class Cuti extends BaseController
{
    // =========================
    // LIST + FILTER CUTI
    // =========================
    public function index()
    {
        $model = new CutiModel();

        $start  = $this->request->getGet('start');
        $end    = $this->request->getGet('end');
        $status = $this->request->getGet('status');

        $query = $model;

        // filter tanggal (range)
        if ($start && $end) {
            $query = $query
                ->where('tanggal_mulai <=', $end)
                ->where('tanggal_selesai >=', $start);
        }

        // filter status
        if ($status && $status !== 'all') {
            $query = $query->where('status', $status);
        }

        $data['cuti']   = $query->orderBy('id', 'DESC')->findAll();
        $data['start']  = $start;
        $data['end']    = $end;
        $data['status'] = $status ?? 'all';

        return view('cuti', $data);
    }

    // =========================
    // APPROVE CUTI + ABSENSI
    // =========================
    public function approve($id)
    {
        $cuti = new CutiModel();
        $log  = new LogModel();
        $abs  = new AbsensiModel();

        $data = $cuti->where('id', $id)->first();

        if (!$data) {
        return redirect()->to('/cuti')->with('error', 'Data tidak ditemukan');
        }

        // validasi tanggal
        if (empty($data['tanggal_mulai']) || empty($data['tanggal_selesai'])) {
        return redirect()->to('/cuti')->with('error', 'Tanggal kosong');
        }

        // update status cuti
        $cuti->update($id, ['status' => 'disetujui']);

        // =========================
        // INTEGRASI ABSENSI
        // =========================
        try {
        $start = new \DateTime((string)$data['tanggal_mulai']);
        $end   = new \DateTime((string)$data['tanggal_selesai']);

        while ($start <= $end) {
                $tgl = $start->format('Y-m-d');

            $exists = $abs->where('nama_karyawan', $data['nama_karyawan'])
                          ->where('tanggal', $tgl)
                              ->first();

            if ($exists) {
                $abs->update($exists['id'], ['status' => 'cuti']);
            } else {
                $abs->insert([
                    'nama_karyawan' => $data['nama_karyawan'],
                    'tanggal'       => $tgl,
                    'status'        => 'cuti'
                ]);
            }

            $start->modify('+1 day');
        }

    } catch (\Exception $e) {
        return redirect()->to('/cuti')->with('error', 'Format tanggal salah');
    }

        // =========================
        // LOG AKTIVITAS
        // =========================
        $log->save([
        'aktivitas' => 'Approve cuti: ' . $data['nama_karyawan'],
        'user'      => session()->get('username'),
        'aksi'      => 'approve'
    ]);

        return redirect()->to('/cuti')->with('success', 'Cuti disetujui & absensi otomatis terisi');
    }

    // =========================
    // REJECT CUTI
    // =========================
    public function reject($id)
    {
        $cuti = new CutiModel();
        $log  = new LogModel();

        $data = $cuti->find($id);

        if (!$data) {
            return redirect()->to('/cuti')->with('error', 'Data tidak ditemukan');
        }

        $cuti->update($id, ['status' => 'ditolak']);

        $log->save([
            'aktivitas' => 'Reject cuti: ' . $data['nama_karyawan'],
            'user'      => session()->get('username'),
            'aksi'      => 'reject'
        ]);

        return redirect()->to('/cuti')->with('success', 'Cuti ditolak');
    }
}