<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelHadiah;

class Hadiah extends BaseController
{
    protected $ModelHadiah;

    public function __construct()
    {
        $this->ModelHadiah = new ModelHadiah();
    }

    public function index()
    {
        $data = [
            'judul' => 'Membership',
            'subjudul' => 'Hadiah',
            'menu' => 'membership',
            'submenu' => 'hadiah',
            'page' => 'member/v_hadiah',
            'hadiah' => $this->ModelHadiah->findAll()
        ];
        return view('v_template', $data);
    }
    public function InsertData()
    {
        $data = [
            'nama_hadiah' => $this->request->getPost('nama_hadiah'),
            'jenis' => $this->request->getPost('jenis'),
            'stok' => $this->request->getPost('stok'),
            'poin_dibutuhkan' => $this->request->getPost('poin_dibutuhkan'),
        ];
        session()->setFlashdata('pesan', 'Data Berhasil Di Hapus!!');
        return redirect()->to(base_url('Hadiah'));
    }
    public function DeleteData($id_hadiah)
    {
        $data = ['id_hadiah' => $id_hadiah];
        session()->setFlashdata('pesan', 'Data Berhasil Di Hapus!!');
        return redirect()->to(base_url('Hadiah'));
    }

    public function EditData($id_hadiah)
    {
        $data = [
            'judul' => 'Edit Hadiah',
            'subjudul' => 'Edit Data Hadiah',
            'menu' => 'member',
            'submenu' => 'hadiah',
            'page' => 'member/v_edit_hadiah',
            'hadiah' => $this->ModelHadiah->find($id_hadiah)
        ];
        return view('v_template', $data);
    }

    public function UpdateData()
    {
        $data = [
            'id_hadiah' => $this->request->getPost('id_hadiah'),
            'nama_hadiah' => $this->request->getPost('nama_hadiah'),
            'jenis' => $this->request->getPost('jenis'),
            'stok' => $this->request->getPost('stok'),
            'poin_dibutuhkan' => $this->request->getPost('poin_dibutuhkan'),
        ];
        session()->setFlashdata('pesan', 'Data Berhasil Di Hapus!!');
        return redirect()->to(base_url('Hadiah'));
    }
}
