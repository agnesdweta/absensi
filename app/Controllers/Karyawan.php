<?php

namespace App\Controllers;

use App\Models\KaryawanModel;

class Karyawan extends BaseController
{
    public function index()
    {
        $model = new KaryawanModel();

        $data = [
            'karyawan' => $model->findAll()
        ];

        return view('karyawan/index', $data);
    }

    public function create()
    {
        return view('karyawan/create');
    }

    public function store()
    {
        $model = new KaryawanModel();

        $model->save([
            'nama'    => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'telp'    => $this->request->getPost('telp'),
        ]);

        return redirect()->to('/karyawan');
    }

    public function edit($id)
    {
        $model = new KaryawanModel();

        $data = [
            'karyawan' => $model->find($id)
        ];

        return view('karyawan/edit', $data);
    }

    public function update($id)
    {
        $model = new KaryawanModel();

        $model->update($id, [
            'nama'    => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'telp'    => $this->request->getPost('telp'),
        ]);

        return redirect()->to('/karyawan');
    }

    public function delete($id)
    {
        $model = new KaryawanModel();
        $model->delete($id);

        return redirect()->to('/karyawan');
    }
}