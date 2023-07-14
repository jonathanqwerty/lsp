<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use App\Models\TagihanModel;
use App\Models\PembayaranModel;

use App\Controllers\BaseController;

class PelangganController extends BaseController
{
    public function index()
    {
        // Menampilkan halaman pelanggan
        return view('users/pelanggan');
    }

    public function tagihan()
    {
        // Mengambil data tagihan untuk pelanggan tertentu dari database
        $tagihanModel = new TagihanModel();
        $tagihan = $tagihanModel->where('id_pelanggan', session()->get('id_pelanggan'))->findAll();

        // Menampilkan data tagihan
        return view('tagihan', ['tagihan' => $tagihan]);
    }

    public function pembayaran()
    {
        // Mengambil data pembayaran untuk pelanggan tertentu dari database
        $pembayaranModel = new PembayaranModel();
        $pembayaran = $pembayaranModel->where('id_pelanggan', session()->get('id_pelanggan'))->findAll();

        // Menampilkan data pembayaran
        return view('pembayaran', ['pembayaran' => $pembayaran]);
    }

    public function bayarTagihan($id_tagihan)
    {
        // Pembayaran tagihan
    }
}
