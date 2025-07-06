<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPoin;
use App\Models\ModelMember;

class Poin extends BaseController
{
    protected $ModelPoin;
    protected $ModelMember;

    public function __construct()
    {
        $this->ModelPoin = new ModelPoin();
        $this->ModelMember = new ModelMember();
    }

    public function index()
    {
        $data = [
            'judul' => 'Membership',
            'subjudul' => 'Poin',
            'menu' => 'membership',
            'submenu' => 'poin',
            'page' => 'member/v_poin',
            'poin' => $this->ModelPoin->GetAllWithMember(),
            'member' => $this->ModelMember->findAll()
        ];
        // dd($data);
        return view('v_template', $data);
    }
    // public function index()
    // {
    //     echo "MASUK HALAMAN POIN"; // debug
    //     exit;
    // }

    public function InsertData()
    {
        $data = [
            'id_member' => $this->request->getPost('id_member'),
            'total_poin' => $this->request->getPost('total_poin'),
            'poin_terpakai' => $this->request->getPost('poin_terpakai'),
            'poin_sisa' => $this->request->getPost('poin_sisa'),
        ];
        $this->ModelPoin->InsertData($data);
        return redirect()->to(base_url('Poin'))->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function UpdateData($id)
    {
        $data = [
            'id_poin' => $id,
            'id_member' => $this->request->getPost('id_member'),
            'total_poin' => $this->request->getPost('total_poin'),
            'poin_terpakai' => $this->request->getPost('poin_terpakai'),
            'poin_sisa' => $this->request->getPost('poin_sisa'),
        ];
        $this->ModelPoin->UpdateData($data);
        return redirect()->to(base_url('Poin'))->with('pesan', 'Data berhasil diupdate!');
    }

    public function DeleteData($id)
    {
        $this->ModelPoin->DeleteData($id);
        return redirect()->to(base_url('Poin'))->with('pesan', 'Data berhasil dihapus!');
    }
}
