<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPoin extends Model
{
    protected $table = 'tbl_poin';
    protected $primaryKey = 'id_poin';
    protected $allowedFields = ['id_member', 'total_poin', 'poin_terpakai', 'poin_sisa'];

    public function InsertData($data)
    {
        return $this->insert($data);
    }

    public function UpdateData($data)
    {
        return $this->update($data['id_poin'], $data);
    }

    public function DeleteData($id)
    {
        return $this->delete($id);
    }

    public function GetAllWithMember()
    {
        return $this->db->table('tbl_poin')
            ->join('tbl_member', 'tbl_member.id_member = tbl_poin.id_member', 'left')
            ->get()
            ->getResultArray();
    }
}
