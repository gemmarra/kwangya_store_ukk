<?php

namespace App\Models;

use CodeIgniter\Model;

class SellingModel extends Model
{
    protected $table            = 'selling';
    protected $primaryKey       = 'selling_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'selling_id',	
        'factur',
        'datetime',	
        'grand_total',	
        'payed_money',	
        'change_money',	
        'cashier_id'	];

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
        $selling=NEW SellingModel;
        $queryselling = $selling->query("CALL `select_selling`()")->getResult();
        return $queryselling;
    }

    public function todayincome(){
        return $this->db->table('selling')
        ->select('SUM(grand_total) AS today_income')
        ->like('DATE(selling.datetime)', date('Y-m-d'))
        ->get()
        ->getRow() // Retrieve a single row
        ->today_income;
    }

    public function todayselling(){
        return $this->db->table('selling')
        ->select('COUNT(selling.selling_id) AS today_selling')
        ->like('DATE(selling.datetime)', date('Y-m-d'))
        ->get()
        ->getRow() // Retrieve a single row
        ->today_selling;
    }

    public function generateFactur()
    {
        $tgl = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(factur,4)) as noFactur FROM selling WHERE DATE(datetime)='$tgl' ");
        $hasil = $query->getRowArray();
        if ($hasil['noFactur'] > 0) {
            $tmp = $hasil['noFactur'] + 1;
            $kd = sprintf("%04s", $tmp);
        } else {
            $kd = "0001";
        }
        $factur = date('Ymd') . $kd;
        return $factur;
    }
    
    public function report_month($month, $year){
        $selling=NEW SellingModel;
        $queryselling = $selling->query("CALL `report_monthly`(".$month.",".$year.")")->getResult();
        return $queryselling;
    }
    
    public function report_year($year){
        $selling=NEW SellingModel;
        $queryselling = $selling->query("CALL `report_yearly`(".$year.")")->getResult();
        return $queryselling;
    }
}
