<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PelangganModel;
use App\Models\TarifModel;

class PelangganController extends BaseController
{
    protected $pelanggan;
    protected $tarif;

    public function __construct()
    {
        $this->tarif = new TarifModel();
        $this->pelanggan = new PelangganModel();
    }

    public function index()
    {
        $data['pelanggan'] = $this->pelanggan->findAll();

        // Ambil tarif berdasarkan id_pelanggan
        $data['tarif'] = [];
        foreach ($data['pelanggan'] as $p) {
            $tarif = $this->tarif->find($p['id_tarif']);
            $data['tarif'][$p['id_pelanggan']] = $tarif;
        }

        return view('admin/pelanggan/list-pelanggan', $data);
    }

    // public function save()
    // {
    //     $id_pelanggan = $this->request->getVar('id_pelanggan');
    //     $nomor_kwh = $this->request->getVar('nomor_kwh');
    //     $nama_pelanggan = $this->request->getVar('nama_pelanggan');
    //     $alamat = $this->request->getVar('alamat');
    //     $id_tarif = $this->request->getVar('id_tarif');

    //     $data = [
    //         'nomor_kwh' => $nomor_kwh,
    //         'nama_pelanggan' => $nama_pelanggan,
    //         'alamat' => $alamat,
    //         'id_tarif' => $id_tarif
    //     ];
    //     $this->pelanggan->save($id_pelanggan, $data);

    //     return redirect()->to('admin/pelanggan');
    // }

    public function update($id)
    {
        $nomor_kwh = $this->request->getVar('nomor_kwh');
        $nama_pelanggan = $this->request->getVar('nama_pelanggan');
        $alamat = $this->request->getVar('alamat');
        $id_tarif = $this->request->getVar('id_tarif');

        $data = [
            'nomor_kwh' => $nomor_kwh,
            'nama_pelanggan' => $nama_pelanggan,
            'alamat' => $alamat,
            'id_tarif' => $id_tarif
        ];

        $this->pelanggan->update($id, $data);

        return redirect()->to('/admin/pelanggan/list-pelanggan');
    }


    public function edit($id)
    {
        $data['pelanggan'] = $this->pelanggan->where(['id_pelanggan' => $id])->first();
        $data['tarif'] = $this->tarif->findAll();
        return view('admin/pelanggan/edit-pelanggan', $data);
    }

    public function delete($id)
    {
        $this->pelanggan->delete($id);
        return redirect()->to('admin/pelanggan');
    }
}