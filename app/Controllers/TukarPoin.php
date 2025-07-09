<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTukarPoin;

class TukarPoin extends BaseController
{
    protected $ModelTukarPoin;

    public function __construct()
    {
        $this->ModelTukarPoin = new ModelTukarPoin();
    }

    public function index()
    {
        $data = [
            'judul' => 'Membership',
            'subjudul' => 'Penukaran Poin',
            'menu' => 'membership',
            'submenu' => 'tukarpoin',
            'page' => 'member/v_tukar_poin',
            'tukar' => $this->ModelTukarPoin->findAll(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        $data = [
            'kode_member' => $this->request->getPost('kode_member'),
            'nama_member' => $this->request->getPost('nama_member'),
            'nama_hadiah' => $this->request->getPost('nama_hadiah'),
            'jumlah_hadiah' => $this->request->getPost('jumlah_hadiah'),
            'total_poin_dipakai' => $this->request->getPost('total_poin_dipakai'),
            'tanggal_tukar' => $this->request->getPost('tanggal_tukar'),
        ];
        $this->ModelTukarPoin->InsertData($data);
        return redirect()->to(base_url('TukarPoin'))->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function UpdateData($id)
    {
        $data = [
            'id_tukar' => $id,
            'kode_member' => $this->request->getPost('kode_member'),
            'nama_member' => $this->request->getPost('nama_member'),
            'nama_hadiah' => $this->request->getPost('nama_hadiah'),
            'jumlah_hadiah' => $this->request->getPost('jumlah_hadiah'),
            'total_poin_dipakai' => $this->request->getPost('total_poin_dipakai'),
            'tanggal_tukar' => $this->request->getPost('tanggal_tukar'),
        ];
        $this->ModelTukarPoin->UpdateData($data);
        return redirect()->to(base_url('TukarPoin'))->with('pesan', 'Data berhasil diupdate!');
    }

    public function DeleteData($id)
    {
        $this->ModelTukarPoin->DeleteData($id);
        return redirect()->to(base_url('TukarPoin'))->with('pesan', 'Data berhasil dihapus!');
    }
}
