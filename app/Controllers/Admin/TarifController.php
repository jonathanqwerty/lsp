<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TarifModel;

class TarifController extends BaseController
{
    protected $tarif;

    public function __construct()
    {
        $this->tarif = new TarifModel();
    }
    public function index()
    {
        $data['tarif'] = $this->tarif->findAll();
        return view('admin/tarif/list-tarif', $data);
    }

    public function create()
    {
        return view('admin/tarif/create-tarif');
    }

    public function store()
    {
        $daya = $this->request->getVar('daya');
        $tarifPerKwh = $this->request->getVar('tarifperkwh');

        $data = [
            'daya' => $daya,
            'tarifperkwh' => $tarifPerKwh
        ];

        $this->tarif->insert($data);

        return redirect()->to('admin/tarif/list-tarif');
    }

    public function edit($id)
    {
        $data['tarif'] = $this->tarif->find($id);
        return view('admin/tarif/edit-tarif', $data);
    }

    public function update($id)
    {
        $daya = $this->request->getVar('daya');
        $tarifPerKwh = $this->request->getVar('tarifperkwh');

        $data = [
            'daya' => $daya,
            'tarifperkwh' => $tarifPerKwh
        ];

        $this->tarif->update($id, $data);

        return redirect()->to('admin/tarif/list-tarif');
    }
}