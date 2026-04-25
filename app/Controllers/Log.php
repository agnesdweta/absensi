<?php

namespace App\Controllers;

use App\Models\LogModel;

class Log extends BaseController
{
    public function index()
    {
        $log = new LogModel();

        $data['log'] = $log->orderBy('id','DESC')->findAll();

        return view('log', $data);
    }
}