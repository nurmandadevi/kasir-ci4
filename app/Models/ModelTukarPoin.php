<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTukarPoin extends Model
{
    protected $table = 'tbl_tukar_poin';
    protected $primaryKey = 'id_tukar';
    protected $allowedFields = ['kode_member', 'nama_member', 'nama_hadiah', 'jumlah_hadiah', 'total_poin_dipakai', 'tanggal_tukar'];

    public function InsertData($data)
    {
        return $this->insert($data);
    }

    public function UpdateData($data)
    {
        return $this->update($data['id_tukar'], $data);
    }

    public function DeleteData($id)
    {
        return $this->delete($id);
    }
}
