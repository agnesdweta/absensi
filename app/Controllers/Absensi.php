<?php

namespace App\Controllers;

use App\Models\AbsensiModel;

class Absensi extends BaseController
{
    public function index()
    {
        $model = new AbsensiModel();
        $data['absensi'] = $model->findAll();

        return view('absensi', $data);
    }

    public function create()
    {
        return view('absensi_create');
    }

    public function store()
    {
        $model = new AbsensiModel();

        $model->save([
            'nama_karyawan' => $this->request->getPost('nama_karyawan'),
            'tanggal'       => $this->request->getPost('tanggal'),
            'status'        => $this->request->getPost('status'),
        ]);

        return redirect()->to('/absensi')->with('success','Data berhasil ditambah');
    }
    public function edit($id)
{
    $model = new AbsensiModel();
    $data['absensi'] = $model->find($id);

    return view('absensi_edit', $data);
}

public function update($id)
{
    $model = new AbsensiModel();

    $model->update($id, [
        'nama_karyawan' => $this->request->getPost('nama_karyawan'),
        'tanggal'       => $this->request->getPost('tanggal'),
        'status'        => $this->request->getPost('status'),
    ]);

    return redirect()->to('/absensi')->with('success', 'Data berhasil diupdate');
}

    public function delete($id)
    {
        $model = new AbsensiModel();
        $model->delete($id);

        return redirect()->to('/absensi')->with('success','Data dihapus');
    }
}