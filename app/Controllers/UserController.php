<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $data =  $this->user->findAll();
        return view('users/pengguna', $data);
    }
    public function dashboard()
    {
        // Cek jika pengguna sudah login
        if (session()->has('id_user')) {
            // Jika sudah login, alihkan ke halaman tujuan
            $idLevel = session()->get('id_level');
            if ($idLevel == 1) {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/users/dashboard');
            }
        }

        // // Memeriksa apakah pengguna sudah login
        // if (!session()->has('id_user')) {
        //     // Jika belum login, redirect ke halaman login
        //     return redirect()->to('/');
        // }

        // // Mengambil data pengguna dari database
        // $userModel = new UserModel();
        // $user = $userModel->find(session()->get('id_user'));

        // // Menampilkan halaman dashboard
        // return view('dashboard', ['user' => $user]);
    }
}
