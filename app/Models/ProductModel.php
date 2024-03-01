<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'product';
    protected $primaryKey       = 'product_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'product_id',
        'product_name',
        'category',
        'stock',
        'denomination',
        'selling_price',
        'purchase_price'];

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
        $product=NEW ProductModel;
        $queryproduct = $product->query("CALL `select_product`()")->getResult();
        return $queryproduct;
    }
    
    public function selecting_no_zero(){
        $selling=NEW SellingModel;
        $queryselling = $selling->query("CALL `select_product_no_zero`()")->getResult();
        return $queryselling;
    }

    public function inserting($data){
        $product=NEW ProductModel;
        $product_id             = $data['product_id'];
        $product_name       = $data['product_name'];
        $category                   = $data['category'];
        $stock    = $data['stock'];
        $denomination      = $data['denomination'];
        $selling_price      = $data['selling_price'];
        $purchase_price      = $data['purchase_price'];
        $product->query("CALL insert_product ('".$product_id."','".$product_name."','".$category."','".$stock."','".$denomination."','".$selling_price."','".$purchase_price."')")->getResult();
    }

    public function deleting($id){
        $product=NEW ProductModel;
        $queryproduct = $product->query("CALL `delete_product`('".$id."')")->getResult();
        return $queryproduct;
    }

    public function zerostock(){
        return $this->db->table('product')
        ->select('COUNT(product_id) AS zero_stock')
        ->where('product.stock = 0')
        ->get()
        ->getRow() // Retrieve a single row
        ->zero_stock;
    }

    public function searching_id_no_zero($product_id){
        $product=NEW ProductModel;
        $queryproduct = $product->query("CALL `search_product_id_no_zero`('".$product_id."')")->getResult();
        return $queryproduct;
    }

    public function searching_name($product_name){
        $product=NEW ProductModel;
        $queryproduct = $product->query("CALL `search_product_name`('".$product_name."')")->getResult();
        return $queryproduct;
    }

    public function datetime(){
        $product=NEW ProductModel;
        $queryproduct = $product->query("SELECT CURRENT_DATE")->getResult();
        return $queryproduct;
    }
}
