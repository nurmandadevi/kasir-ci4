<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    public function NoFaktur()
    {
        $tgl = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(no_faktur,4)) as no_urut from tbl_transaksi where DATE(tgl_jual)='$tgl'");
        $hasil = $query->getRowArray();
        if ($hasil['no_urut'] > 0) {
            $tmp = $hasil['no_urut'] + 1;
            $kd = sprintf("%04s", $tmp);
        } else {
            $kd = "0001";
        }
        $no_faktur = date('Ymd') . $kd;
        return $no_faktur;
    }

    public function CekProduk($kode_produk)
    {
        return $this->db->table('tbl_produk')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_produk.id_kategori')
            ->join('tbl_satuan', 'tbl_satuan.id_satuan=tbl_produk.id_satuan')
            ->where('kode_produk', $kode_produk)
            ->get()
            ->getRowArray();
    }

    public function CekMember($kode_member)
    {
        return $this->db->table('tbl_member')
            ->where('kode_member', $kode_member)
            ->get()
            ->getRowArray();
    }

    public function AllProduk()
    {
        return $this->db->table('tbl_produk')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_produk.id_kategori')
            ->join('tbl_satuan', 'tbl_satuan.id_satuan=tbl_produk.id_satuan')
            ->where('stok > 0')
            ->get()
            ->getResultArray();
    }

    public function AllMember()
    {
        return $this->db->table('tbl_member')
            ->get()
            ->getResultArray();
    }
    public function getTotalPoinByKodeMember($kode_member)
    {
        return $this->db->table('tbl_member')
            ->select('total_poin, id_member')
            ->where('kode_member', $kode_member)
            ->get()
            ->getRow();
    }

    public function InsertTransaksi($data)
    {
        $this->db->table('tbl_transaksi')->insert($data);
    }
    public function InsertHistoriPoin($poin)
    {
        $this->db->table('tbl_histori_poin')->insert($poin);
    }

    public function InsertRinciTransaksi($data)
    {

        $this->db->table('tbl_rinci_transaksi')->insert($data);
    }
    public function updatepoin($poin, $kode_member)
    {
        $this->db->table('tbl_member')
            ->where('kode_member', $kode_member)
            ->set('total_poin', 'total_poin + ' . $poin, false)
            ->update();
    }
}
