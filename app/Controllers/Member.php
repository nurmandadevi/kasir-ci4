<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Controllers\BaseController;
use App\Models\ModelMember;

class Member extends BaseController
{
    protected $ModelMember;

    public function __construct()
    {
        $this->ModelMember = new ModelMember();
    }

    public function index()
    {
        $data = [
            'judul' => 'Membership',
            'subjudul' => 'Member',
            'menu' => 'membership',
            'submenu' => 'member',
            'page' => 'member/v_member',
            'member' => $this->ModelMember->findAll(),
            'pesan' => session()->getFlashdata('pesan'),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        $kode_member = $this->request->getPost('kode_member');

        // Cek apakah kode member sudah ada
        $cek = $this->ModelMember
            ->where('kode_member', $kode_member)
            ->first();

        if ($cek) {
            // Kalau ada, balikin pesan error
            return redirect()->to(base_url('Member'))
                ->with('pesan', 'Kode Member sudah digunakan!');
        }

        // Kalau belum ada, insert data
        $data = [
            'kode_member' => $kode_member,
            'nama_member' => $this->request->getPost('nama_member'),
            'alamat'      => $this->request->getPost('alamat'),
            'total_poin'  => 0, // default saat tambah
        ];
        $this->ModelMember->InsertData($data);
        return redirect()->to(base_url('Member'))->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function UpdateData($id)
    {
        $data = [
            'id_member'   => $id,
            'kode_member' => $this->request->getPost('kode_member'),
            'nama_member' => $this->request->getPost('nama_member'),
            'alamat'      => $this->request->getPost('alamat'),
        ];
        $this->ModelMember->UpdateData($data);
        return redirect()->to(base_url('Member'))->with('pesan', 'Data berhasil diupdate!');
    }

    public function DeleteData($id)
    {
        $this->ModelMember->DeleteData($id);
        return redirect()->to(base_url('Member'))->with('pesan', 'Data berhasil dihapus!');
    }

    public function ImportExcel()
    {
        $file = $this->request->getFile('file_excel');

        if ($file->isValid() && !$file->hasMoved()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            $duplicate = [];

            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];

                $kode_member = trim($row[0]);
                $nama_member = trim($row[1]);
                $alamat      = trim($row[2]);

                $cek = $this->ModelMember
                    ->where('kode_member', $kode_member)
                    ->first();

                if ($cek) {
                    $duplicate[] = $kode_member . ' (' . $nama_member . ')';
                    continue;
                }

                $data = [
                    'kode_member' => $kode_member,
                    'nama_member' => $nama_member,
                    'alamat'      => $alamat,
                    'total_poin'  => 0,
                ];
                $this->ModelMember->insert($data);
            }

            // Buat pesan jika ada duplikat
            if (!empty($duplicate)) {
                $pesan = "Import Excel selesai. Tetapi kode member berikut sudah terdaftar dan tidak disimpan: " . implode(', ', $duplicate);
                return redirect()->to(base_url('Member'))->with('pesan', $pesan);
            }

            return redirect()->to(base_url('Member'))->with('pesan', 'Import Excel berhasil!');
        }
    }
}
