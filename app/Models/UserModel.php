<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'email';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email',	'name',	'password',	'role'];

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
        $user=NEW UserModel;
        $queryuser = $user->query("CALL `select_user`()")->getResult();
        return $queryuser;
    }

    public function inserting($data){
        $user=NEW UserModel;
        $email              = $data['email'];
        $name               = $data['name'];
        $password           = $data['password'];
        $role               = $data['role'];
        $user->query("CALL insert_user ('".$email."','".$name."','".$password."','".$role."')")->getResult();
    }

    public function deleting($email){
        $user=NEW UserModel;
        $queryuser = $user->query("CALL `delete_user`('".$email."')")->getResult();
        return $queryuser;
    }

    public function searching($name){
        $user=NEW UserModel;
        $queryuser = $user->query("CALL `search_user`('".$name."')")->getResult();
        return $queryuser;
    }
}
