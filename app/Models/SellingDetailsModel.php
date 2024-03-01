<?php

namespace App\Models;

use CodeIgniter\Model;

class SellingDetailsModel extends Model
{
    protected $table            = 'selling_details';
    protected $primaryKey       = 'details_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['details_id', 'selling_id',	'factur',	'product_id',	'quantity',	'price_total'	];

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

    public function selecting($data){
        $sellingdetails=NEW SellingDetailsModel;
        $selling_id = $data ['selling_id'];
        $querysellingdetails = $sellingdetails->query("CALL `select_sellingdetails`('".$selling_id."')")->getResult();
        return $querysellingdetails;
    }

    public function showing_details($SellingID){
        return $this->db->table('selling_details')
        ->select('selling_details.*, product.product_name, selling_details.quantity, selling_details.price_total')
        ->join('product','product.product_id = selling_details.product_id')
        ->where('selling_details.selling_id',$SellingID)
        ->get()
        ->getResultArray();
    }

    public function sumprice($SellingID){
        return $this->db->table('selling_details')
            ->selectSum('price_total') // Selects the sum of price_total directly
            ->where('selling_details.selling_id', $SellingID)
            ->get()
            ->getRow() // Retrieve a single row
            ->price_total; // Access the sum of price_total
    }
}
