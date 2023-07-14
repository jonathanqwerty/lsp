<?php

namespace App\Controllers;

use App\Models\TagihanModel;
use App\Models\PembayaranModel;
use App\Models\UserModel;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        // Halaman admin
        return view('admin/admin');
    }

    public function tagihan()
    {
        // Mengambil data tagihan dari database
        $tagihanModel = new TagihanModel();
        $tagihan = $tagihanModel->findAll();

        // Menampilkan data tagihan
        return view('tagihan', ['tagihan' => $tagihan]);
    }

    public function pembayaran()
    {
        // Mengambil data pembayaran dari database
        $pembayaranModel = new PembayaranModel();
        $pembayaran = $pembayaranModel->findAll();

        // Menampilkan data pembayaran
        return view('pembayaran', ['pembayaran' => $pembayaran]);
    }

    public function konfirmasiPembayaran($id_pembayaran)
    {
        // Konfirmasi pembayaran
    }

    public function dashboard()
    {
        // Memeriksa apakah pengguna sudah login
        if (!session()->has('id_user')) {
            // Jika belum login, redirect ke halaman login
            return redirect()->to('/login');
        }

        // Mengambil data pengguna dari database
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('id_user'));

        // Menampilkan halaman dashboard admin
        return view('admin_dashboard', ['user' => $user]);
    }
}
