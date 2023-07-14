<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        // Tampilkan halaman login
        return view('login');
    }

    public function register()
    {
        // Tampilkan halaman register
        return view('register');
    }

    // public function processLogin()
    // {
    //     // Proses login pengguna
    //     // Ambil data pengguna dari form login dan lakukan verifikasi

    //     // Contoh validasi sederhana (harap sesuaikan dengan kebutuhan Anda)
    //     $username = $this->request->getVar('username');
    //     $password = $this->request->getVar('password');

    //     // Cek apakah username dan password sesuai
    //     $userModel = new UserModel();
    //     $user = $userModel->where('username', $username)->first();

    //     if ($user && password_verify($password, $user['password'])) {
    //         // Berhasil login
    //         // Simpan data login ke sesi atau lakukan tindakan lain yang diinginkan

    //         return redirect()->to('users/index'); // Ganti '/dashboard' dengan halaman setelah login yang diinginkan
    //     } else {
    //         // Gagal login
    //         // Redirect kembali ke halaman login dengan pesan error

    //         return redirect()->back()->with('error', 'Username atau password salah');
    //     }
    // }

    public function processLogin()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session = Services::session();
                $session->set('id_level', $user['id_level']);

                if ($user['id_level'] == 1) {
                    return redirect()->to('/admin');
                } else if ($user['id_level'] == 2) {
                    return redirect()->to('/pengguna');
                }
            }
        }

        return redirect()->to('/login')->with('error', 'Username atau password salah');
    }

    public function processRegister()
    {
        // Proses registrasi pengguna
        // Ambil data pengguna dari form register dan lakukan validasi

        // Contoh validasi sederhana (harap sesuaikan dengan kebutuhan Anda)
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data pengguna ke database
        $userModel = new UserModel();
        $userModel->insert([
            'username' => $username,
            'password' => $hashedPassword,
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login');
    }
}
