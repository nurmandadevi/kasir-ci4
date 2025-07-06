<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelAdmin;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->ModelAdmin = new ModelAdmin();
    }
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'v_admin',
            'grafik' => $this->ModelAdmin->Grafik(),
            'p_hari_ini' => $this->ModelAdmin->PendapatanHariIni(),
            'p_bulan_ini' => $this->ModelAdmin->PendapatanBulanIni(),
            'p_tahun_ini' => $this->ModelAdmin->PendapatanTahunIni(),
            'jml_produk' => $this->ModelAdmin->JumlahProduk(),
            'jml_kategori' => $this->ModelAdmin->JumlahKategori(),
            'jml_satuan' => $this->ModelAdmin->JumlahSatuan(),
            'jml_user' => $this->ModelAdmin->JumlahUser(),
            'jml_member' => $this->ModelAdmin->JumlahMember(),
        ];
        return view('v_template', $data);
    }

    public function Setting()
    {
        $data = [
            'judul' => 'Setting',
            'subjudul' => 'Setting',
            'menu' => 'setting',
            'submenu' => '',
            'page' => 'v_setting',
            'setting' => $this->ModelAdmin->DetailData(),
        ];
        return view('v_template', $data);
    }
    public function UpdateSetting()
    {
        $data = [
            'id' => '1',
            'nama_toko' => $this->request->getPost('nama_toko'),
            'slogan' => $this->request->getPost('slogan'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];
        $this->ModelAdmin->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Di Update!!');
        return redirect()->to(base_url('Admin/Setting'));
    }

    public function Cek()
    {
        echo dd($this->ModelAdmin->PendapatanTahunIni());
    }
    
}
