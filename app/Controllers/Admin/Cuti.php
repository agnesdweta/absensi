<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CutiModel;

class Cuti extends BaseController
{
    public function index()
    {
        $model = new CutiModel();

        $data['cuti'] = $model->findAll();

        return view('admin/cuti', $data);
    }

    public function approve($id)
    {
        $model = new CutiModel();

        $model->update($id, [
            'status' => 'disetujui'
        ]);

        return redirect()->to('/admin/cuti')->with('success', 'Cuti disetujui');
    }

    public function reject($id)
    {
        $model = new CutiModel();

        $model->update($id, [
            'status' => 'ditolak'
        ]);

        return redirect()->to('/admin/cuti')->with('success', 'Cuti ditolak');
    }
}