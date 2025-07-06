<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    public function DetailData()
    {
        return $this->db->table('tbl_setting')
            ->where('id', '1')
            ->get()
            ->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_setting')
            ->where('id', $data['id'])
            ->update($data);
    }
    public function Grafik()
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_rinci_transaksi.no_faktur')
            ->where('month(tbl_transaksi.tgl_jual)', date('m'))
            ->where('year(tbl_transaksi.tgl_jual)', date('Y'))
            ->select('tbl_transaksi.tgl_jual')
            ->groupBy('tbl_transaksi.tgl_jual')
            ->selectSum('tbl_rinci_transaksi.total_harga')
            ->selectSum('tbl_rinci_transaksi.untung')
            ->get()->getResultArray();
    }
    public function PendapatanHariIni()
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_rinci_transaksi.no_faktur')
            ->where('tbl_transaksi.tgl_jual', date('Y-m-d'))
            ->groupBy('tbl_transaksi.tgl_jual')
            ->selectSum('tbl_rinci_transaksi.total_harga')
            ->get()->getRowArray();
    }
    public function PendapatanBulanIni()
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_rinci_transaksi.no_faktur')
            ->where('month(tbl_transaksi.tgl_jual)', date('m'))
            ->where('year(tbl_transaksi.tgl_jual)', date('Y'))
            ->groupBy('month(tbl_transaksi.tgl_jual)')
            ->selectSum('tbl_rinci_transaksi.total_harga')
            ->get()->getRowArray();
    }
    public function PendapatanTahunIni()
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_rinci_transaksi.no_faktur')
            ->where('year(tbl_transaksi.tgl_jual)', date('Y'))
            ->groupBy('year(tbl_transaksi.tgl_jual)')
            ->selectSum('tbl_rinci_transaksi.total_harga')
            ->get()->getRowArray();
    }
    public function JumlahProduk()
    {
        return $this->db->table('tbl_produk')->countAll();
    }
    public function JumlahKategori()
    {
        return $this->db->table('tbl_kategori')->countAll();
    }
    public function JumlahSatuan()
    {
        return $this->db->table('tbl_satuan')->countAll();
    }
    public function JumlahUser()
    {
        return $this->db->table('tbl_user')->countAll();
    }
    public function JumlahMember()
    {
        return $this->db->table('tbl_member')->countAll();
    }
}
