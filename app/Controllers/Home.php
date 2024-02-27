<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('Auth/login');
    }

    public function dashboard()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $db = \Config\Database::connect();
        $builder = $db->table('selling');
        $builder->where('datetime',$date);
        $count = $builder->countAllResults();
        $data = [
            'today_income' => $this->selling->today_income($date),
            'today_selling'=> $count,
            'zero_stock' => $this->product->zero_stock()
        ];
        return view('dashboard', $data);
    }

    public function coba1()
    {
        $data = [
            'CategoryList' => $this->category->selecting(),
            'ProductList' => $this->product->selecting(),
        ];
        return view('coba', $data);
    }

    public function coba2()
    {
        // $data = [
        //     'CategoryList' => $this->category->selecting(),
        //     'ProductList' => $this->product->selecting(),
        // ];
        return view('coba2');
    }
}
