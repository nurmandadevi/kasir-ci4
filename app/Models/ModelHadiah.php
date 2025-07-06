<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHadiah extends Model
{
    protected $table = 'tbl_hadiah';
    protected $primaryKey = 'id_hadiah';
    protected $allowedFields = ['nama_hadiah', 'jenis', 'stok', 'poin_dibutuhkan'];

    public function InsertData($data)
    {
        $this->db->table('tbl_hadiah')->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_hadiah')
            ->where('id_hadiah', $data['id_hadiah'])
            ->update($data);
    }

        public function DeleteData($data)
    {
        $this->db->table('tbl_hadiah')
            ->where('id_hadiah', $data['id_hadiah'])
            ->delete($data);
    }
}
