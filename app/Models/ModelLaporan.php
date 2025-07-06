<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLaporan extends Model
{
    public function DataHarian($tgl)
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->join('tbl_produk', 'tbl_produk.kode_produk=tbl_rinci_transaksi.kode_produk')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_rinci_transaksi.no_faktur')
            ->where('tbl_transaksi.tgl_jual', $tgl)
            ->select('tbl_rinci_transaksi.kode_produk')
            ->select('tbl_produk.nama_produk')
            ->select('tbl_rinci_transaksi.modal')
            ->select('tbl_rinci_transaksi.harga')
            ->selectSum('tbl_rinci_transaksi.qty')
            ->selectSum('tbl_rinci_transaksi.total_harga')
            ->selectSum('tbl_rinci_transaksi.untung')
            ->groupBy([
                'tbl_rinci_transaksi.kode_produk',
                'tbl_produk.nama_produk',
                'tbl_rinci_transaksi.modal',
                'tbl_rinci_transaksi.harga'
            ])
            ->get()->getResultArray();
    }
    public function DataBulanan($bulan, $tahun)
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_rinci_transaksi.no_faktur')
            ->where('month(tbl_transaksi.tgl_jual)', $bulan)
            ->where('year(tbl_transaksi.tgl_jual)', $tahun)
            ->select('tbl_transaksi.tgl_jual')
            ->groupBy('tbl_transaksi.tgl_jual')
            ->selectSum('tbl_rinci_transaksi.total_harga')
            ->selectSum('tbl_rinci_transaksi.untung')
            ->get()->getResultArray();
    }
    public function DataTahunan($tahun)
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_rinci_transaksi.no_faktur')
            ->where('year(tbl_transaksi.tgl_jual)', $tahun)
            ->select('month(tbl_transaksi.tgl_jual) as bulan')
            ->groupBy('month(tbl_transaksi.tgl_jual)')
            ->selectSum('tbl_rinci_transaksi.total_harga')
            ->selectSum('tbl_rinci_transaksi.untung')
            ->get()->getResultArray();
    }
}
