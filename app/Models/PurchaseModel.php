<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseModel extends Model
{
    protected $table            = 'purchase';
    protected $primaryKey       = 'purchase_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['purchase_id', 'datetime', 'expenditure_total', 'receipt_image'];

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
        $purchase=NEW PurchaseModel;
        $querypurchase = $purchase->query("CALL `select_purchase`()")->getResult();
        return $querypurchase;
    }

    public function inserting($data){
        $purchase=NEW PurchaseModel;
        $datetime                        = $data['datetime'];
        $expenditure_total               = $data['expenditure_total'];
        $receipt_image                   = $data['receipt_image'];
        $purchase->query("CALL insert_purchase ('".$datetime."','".$expenditure_total."','".$receipt_image."')")->getResult();
    }

    public function deleting($id){
        $purchase=NEW PurchaseModel;
        $querypurchase = $purchase->query("CALL `delete_purchase`('".$id."')")->getResult();
        return $querypurchase;
    }

    public function searching($purchase_date){
        $purchase=NEW PurchaseModel;
        $querypurchase = $purchase->query("CALL `search_purchase`('".$purchase_date."')")->getResult();
        return $querypurchase;
    }
}
