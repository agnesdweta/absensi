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

        $builder = $model->builder();

        // filter tanggal (range)
        if ($start && $end) {
        $builder->where('tanggal_mulai <=', $end);
        $builder->where('tanggal_selesai >=', $start);
    }

        // filter status
        if ($status && $status !== 'all') {
        $builder->where('status', $status);
    }

    $data['cuti'] = $builder->orderBy('id', 'DESC')->get()->getResultArray();
    $data['start']  = $start;
    $data['end']    = $end;
    $data['status'] = $status ?? 'all';

    return view('cuti', $data);
}
    // =========================
    // FORM AJUKAN CUTI
    // =========================
    public function create()
    {
        if(session()->get('role') != 'user'){
            return redirect()->to('/cuti')->with('error','Akses ditolak');
        }
        return view('cuti_create');
    }
    // =========================
    // SIMPAN CUTI
    // =========================
    public function store()
    {
        if(session()->get('role') != 'user'){
            return redirect()->to('/cuti')->with('error','Akses ditolak');
        }
        $cuti = new CutiModel();
        // VALIDASI
        if(!$this->request->getPost('tanggal_mulai') || !$this->request->getPost('tanggal_selesai')){
            return redirect()->back()->with('error','Tanggal wajib diisi');
        }

        $cuti->save([
            'nama_karyawan'   => session()->get('username'),
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'keterangan'      => $this->request->getPost('keterangan'),
            'status'          => 'pending'
        ]);
        return redirect()->to('/cuti')->with('success', 'Pengajuan cuti berhasil');
    }

    // =========================
    // APPROVE CUTI + ABSENSI
    // =========================
    public function approve($id)
    {
        if(session()->get('role') != 'admin'){
        return redirect()->to('/cuti')->with('error','Akses ditolak');
        }

        $cuti = new CutiModel();
        $log  = new LogModel();
        $abs  = new AbsensiModel();

        $data = $cuti->find($id);

        if (!$data) {
        return redirect()->to('/cuti')->with('error', 'Data tidak ditemukan');
        }
        // cegah approve ulang
        if($data['status'] != 'pending'){
            return redirect()->to('/cuti')->with('error','Cuti sudah diproses');
        }
        // update status + info approval
        $cuti->update($id, [
            'status'       => 'disetujui',
            'approved_by'  => session()->get('username'),
            'approved_at'  => date('Y-m-d H:i:s')
        ]);

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
        if(session()->get('role') != 'admin'){
            return redirect()->to('/cuti')->with('error','Akses ditolak');
        }

        $cuti = new CutiModel();
        $log  = new LogModel();

        $data = $cuti->find($id);

        if (!$data) {
            return redirect()->to('/cuti')->with('error', 'Data tidak ditemukan');
        }
        if($data['status'] != 'pending'){
            return redirect()->to('/cuti')->with('error','Cuti sudah diproses');
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