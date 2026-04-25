<?php

namespace App\Controllers;

use App\Models\M_user;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function auth()
{
    $model = new M_user();

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $user = $model->where('username', $username)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Username tidak ditemukan');
    }

    if ($password != $user['password']) {
        return redirect()->back()->with('error', 'Password salah');
    }

    session()->set([
        'login'    => true,
        'username' => $user['username'],
        'role'     => $user['role']
    ]);

    return redirect()->to('/dashboard');
}
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}