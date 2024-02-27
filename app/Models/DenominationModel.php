<?php

namespace App\Models;

use CodeIgniter\Model;

class DenominationModel extends Model
{
    protected $table            = 'denomination';
    protected $primaryKey       = 'denomination_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['denomination_id', 'denomination_name'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function selecting(){
        $denomination=NEW DenominationModel;
        $querydenomination = $denomination->query("CALL `select_denomination`();")->getResult();
        return $querydenomination;
    }

    public function searching($denomination_name){
        $denomination=NEW DenominationModel;
        $querydenomination = $denomination->query("CALL `search_denomination`('".$denomination_name."');")->getResult();
        return $querydenomination;
    }

    public function deleting($id){
        $denomination=NEW DenominationModel;
        $querydenomination = $denomination->query("CALL `delete_denomination`('".$id."')")->getResult();
        return $querydenomination;
    }

    public function inserting($data){
        $denomination=NEW DenominationModel;
        $denomination_name       = $data['denomination_name'];
        $querydenomination = $denomination->query("CALL insert_denomination ('".$denomination_name."')")->getResult();
        return $querydenomination;
    }
}
