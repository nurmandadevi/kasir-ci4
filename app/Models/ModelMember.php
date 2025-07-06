<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMember extends Model
{
    protected $table = 'tbl_member';
    protected $primaryKey = 'id_member';
    protected $allowedFields = ['kode_member', 'nama_member', 'alamat', 'total_poin'];

    public function InsertData($data)
    {
        $this->insert($data);
    }

    public function UpdateData($data)
    {
        $this->update($data['id_member'], $data);
    }

    public function DeleteData($id)
    {
        $this->delete($id);
    }
}
