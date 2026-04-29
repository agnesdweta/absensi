<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogModel;

class Log extends BaseController
{
    public function index()
    {
        $model = new LogModel();

        $data['log'] = $model
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('admin/log', $data);
    }
}