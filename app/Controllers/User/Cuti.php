<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\CutiModel;

class Cuti extends BaseController
{
    protected $cutiModel;

    public function __construct()
    {
        $this->cutiModel = new CutiModel();
    }

    // =====================
    // READ - LIST CUTI
    // =====================
    public function index()
    {
        $username = session()->get('username');

        if (!$username) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $data = [
            'cuti' => $this->cutiModel
                ->where('nama_karyawan', $username)
                ->orderBy('id', 'DESC')
                ->findAll()
        ];

        return view('user/cuti', $data);
    }

    // =====================
    // CREATE FORM
    // =====================
    public function create()
    {
        return view('user/cuti_create');
    }

    // =====================
    // STORE DATA CUTI
    // =====================
    public function store()
    {
        $username = session()->get('username');

        if (!$username) {
            return redirect()->to('/login')
                ->with('error', 'Session tidak ditemukan');
        }

        // VALIDASI SEDERHANA
        if (!$this->request->getPost('tanggal_mulai') || !$this->request->getPost('tanggal_selesai')) {
            return redirect()->back()
                ->with('error', 'Tanggal cuti wajib diisi');
        }

        $this->cutiModel->insert([
            'nama_karyawan'   => $username,
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'keterangan'      => $this->request->getPost('keterangan'),
            'status'          => 'pending'
        ]);

        return redirect()->to('/cuti')
            ->with('success', 'Cuti berhasil diajukan');
    }
}