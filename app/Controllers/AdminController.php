<?php

namespace App\Controllers;

use App\Models\TagihanModel;
use App\Models\PembayaranModel;
use App\Models\UserModel;

use App\Controllers\BaseController;
use App\Models\TarifModel;

class AdminController extends BaseController
{
    public function index()
    {
        // Halaman admin
        return view('admin/admin');
    }

    public function filter()
    {
        $userModel = new UserModel();
        $filteruser = $userModel->where('id_level', '2')->findAll();
        $users['users'] = $filteruser;
        return view('admin/list', $users);
    }

    public function tarif()
    {
        $tarifModel = new TarifModel();
        $tarif['tarif'] = $tarifModel->findAll();

        return view('admin/tarif', $tarif);
    }

    public function tagihan()
    {
        // Mengambil data tagihan dari database
        $tagihanModel = new TagihanModel();
        $tagihan = $tagihanModel->findAll();

        // Menampilkan data tagihan
        return view('admin/tagihan', ['tagihan' => $tagihan]);
    }

    public function pembayaran()
    {
        // Mengambil data pembayaran dari database
        $pembayaranModel = new PembayaranModel();
        $pembayaran = $pembayaranModel->findAll();

        // Menampilkan data pembayaran
        return view('admin/pembayaran', ['pembayaran' => $pembayaran]);
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
