<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'category';
    protected $primaryKey       = 'category_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id', 'category_name'];

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
        $category=NEW CategoryModel;
        $querycategory = $category->query("CALL `select_category`();")->getResult();
        return $querycategory;
    }
    
    public function inserting($data){
        $category=NEW CategoryModel;
        $category_name       = $data['category_name'];
        $querycategory = $category->query("CALL insert_category ('".$category_name."')")->getResult();
        return $querycategory;
    }
    
    public function deleting($id){
        $category=NEW CategoryModel;
        $querycategory = $category->query("CALL `delete_category`('".$id."')")->getResult();
        return $querycategory;
    }
    
    public function searching($category_name){
        $category=NEW CategoryModel;
        $querycategory = $category->query("CALL `search_category`('".$category_name."');")->getResult();
        return $querycategory;
    }
}
