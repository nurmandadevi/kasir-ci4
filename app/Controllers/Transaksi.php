<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelTransaksi;
use App\Models\ModelMember;

class Transaksi extends BaseController
{
    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
    }
    public function index()
    {
        $cart = \Config\Services::cart();

        $data = [
            'judul' => 'Transaksi',
            'no_faktur' => $this->ModelTransaksi->NoFaktur(),
            'cart' => $cart->contents(),
            'grand_total' => $cart->total(),
            'produk' => $this->ModelTransaksi->AllProduk(),
            'member' => $this->ModelTransaksi->AllMember(),
        ];
        return view('v_transaksi', $data);
    }
    public function CekProduk()
    {
        $kode_produk = $this->request->getPost('kode_produk');
        $produk = $this->ModelTransaksi->CekProduk($kode_produk);
        if ($produk == null) {
            $data = [
                'nama_produk' => '',
                'nama_kategori' => '',
                'nama_satuan' => '',
                'harga_jual' => '',
                'harga_beli' => '',
            ];
        } else {
            $data = [
                'nama_produk' => $produk['nama_produk'],
                'nama_kategori' => $produk['nama_kategori'],
                'nama_satuan' => $produk['nama_satuan'],
                'harga_jual' => $produk['harga_jual'],
                'harga_beli' => $produk['harga_beli'],
            ];
        }
        echo json_encode($data);
    }
    public function CekMember()
    {
        $kode_member = $this->request->getPost('kode_member');
        $member = $this->ModelTransaksi->CekMember($kode_member);

        if (!$member) {
            $data = [
                'nama_member' => '',
                'alamat' => ''
            ];
        } else {
            $data = [
                'nama_member' => $member['nama_member'],
                'alamat' => $member['alamat']
            ];
        }

        return $this->response->setJSON($data);
    }

    public function InsertCart()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $this->request->getPost('kode_produk'),
            'qty'     => $this->request->getPost('qty'),
            'price'   => $this->request->getPost('harga_jual'),
            'name'    => $this->request->getPost('nama_produk'),

            'options' => array(
                'nama_kategori' => $this->request->getPost('nama_kategori'),
                'nama_satuan' => $this->request->getPost('nama_satuan'),
                'modal' => $this->request->getPost('harga_beli'),
            )
        ));
        return redirect()->to(base_url('Transaksi'));
    }
    public function ViewCart()
    {
        $cart = \Config\Services::cart();
        $data = $cart->contents();

        echo dd($data);
    }
    public function ResetCart()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to(base_url('Transaksi'));
    }
    public function RemoveItemCart($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to(base_url('Transaksi'));
    }
    public function SimpanTransaksi()
    {
        // dd($this->request->getPost());
        $cart = \Config\Services::cart();
        $produk = $cart->contents();
        $no_faktur = $this->ModelTransaksi->NoFaktur();
        $dibayar = str_replace(',', '', $this->request->getPost('dibayar'));
        $kembalian = str_replace(',', '', $this->request->getPost('kembalian'));
        $kode_member = $this->request->getPost('kode_member');

        // dd($kode_member);
        //hitung poin
        $poin = 0;
        if ($kode_member != null) {
            $member = $this->ModelTransaksi->CekMember($kode_member);
            if ($member) {
                $poin = floor($cart->total() / 10000);
            } else {
                $kode_member = null; // reset agar tidak disimpan
            }
        }
        // dd($poin);
        //simpan ke tbl_rinci_transaksi

        foreach ($produk as $key => $value) {
            $data = [
                'no_faktur' => $no_faktur,
                'kode_produk' => $value['id'],
                'harga' => $value['price'],
                'modal' => $value['options']['modal'],
                'qty' => $value['qty'],
                'total_harga' => $value['subtotal'],
                'untung' => ($value['price'] - $value['options']['modal']) * $value['qty']
            ];
            $this->ModelTransaksi->InsertRinciTransaksi($data);
        }
        //simpan ke tbl_transaksi
        $data = [
            'no_faktur' => $no_faktur,
            'tgl_jual' => date('Y-m-d'),
            'jam' => date('H:i:s'),
            'grand_total' => $cart->total(),
            'dibayar' => $dibayar,
            'kembalian' => $kembalian,
            'id_user' => session()->get('id_user'),
            'kode_member' => $kode_member,
            'poin'        => $poin
        ];

        $member = $this->ModelTransaksi->getTotalPoinByKodeMember($kode_member);
        $datapoin = [
            'total_poin_histori' =>  $member ? $member->total_poin : 0,
            'id_member' => $kode_member,
            'poin_didapat'        => $poin
        ];
        // dd($data);
        if ($data != null) {
            $this->ModelTransaksi->InsertTransaksi($data);
            $this->ModelTransaksi->InsertHistoriPoin($datapoin);
        } else {
            log_message('error', "Update poin gagal untuk member ");
        }

        // update total poin ke member
        if ($kode_member != null && $poin > 0) {
            $this->ModelTransaksi->updatepoin($poin, $kode_member);
        } else {
            log_message('error', "Update poin gagal untuk member {$kode_member}");
        }
        $cart->destroy();
        session()->setFlashdata('pesan', 'Transaksi Berhasil Di Simpan!!');
        return redirect()->to(base_url('Transaksi'));
    }
}
