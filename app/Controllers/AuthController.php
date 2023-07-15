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

    public function processLogin()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session = session();
                $session->set('id_level', $user['id_level']);
                $session->set('username', $user['username']);

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

    public function logout()
    {
        // Hapus data sesi pengguna
        session()->destroy();
        // Redirect ke halaman login atau halaman lain sesuai kebutuhan
        return redirect()->to('/login')->with('success', 'Logout berhasil');
    }
}