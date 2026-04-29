<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;

class Absensi extends BaseController
{
    public function index()
    {
        $model = new AbsensiModel();

        $data = [
            'absensi' => $model->orderBy('tanggal', 'DESC')->findAll()
        ];

        return view('admin/absensi', $data);
    }

    public function edit($id)
    {
        $model = new AbsensiModel();

        $data['absensi'] = $model->find($id);

        if (!$data['absensi']) {
            return redirect()->to('/admin/absensi')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('admin/absensi_edit', $data);
    }

    public function update($id)
    {
        $model = new AbsensiModel();

        $model->update($id, [
            'nama_karyawan' => $this->request->getPost('nama_karyawan'),
            'tanggal'       => $this->request->getPost('tanggal'),
            'jam_masuk'     => $this->request->getPost('jam_masuk'),
            'jam_pulang'    => $this->request->getPost('jam_pulang'),
            'status'        => $this->request->getPost('status'),
        ]);

        // LOG AKTIVITAS
        $log = new \App\Models\LogModel();
        $log->tambahLog(
            session()->get('username'),
            'Update absensi ID ' . $id,
            'UPDATE'
        );

        return redirect()->to('/admin/absensi')
            ->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $model = new AbsensiModel();
        $model->delete($id);

        // LOG AKTIVITAS
        $log = new \App\Models\LogModel();
        $log->tambahLog(
            session()->get('username'),
            'Delete absensi ID ' . $id,
            'DELETE'
        );

        return redirect()->to('/admin/absensi')
            ->with('success', 'Data berhasil dihapus');
    }
}