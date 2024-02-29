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
        if(!session()->get('sudahkahLogin')){
   		 return redirect()->to('login');
   	 }
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $db = \Config\Database::connect();

        //Today's Selling
        // Query for Today's Income
        $builderTodayIncome = $db->table('selling');
        $builderTodayIncome->select('COUNT(selling.selling_id) AS today_income');
        $builderTodayIncome->where('DATE(datetime)', $date);
        $todayIncome = $builderTodayIncome->get()->getRow()->today_income;
        //var_dump($todayIncome);
        
        // Query for Today's Selling
        $builderTodaySelling = $db->table('selling_details');
        $builderTodaySelling->select('SUM(selling_details.price_total) AS today_selling');
        $builderTodaySelling->join('selling', 'selling.selling_id = selling_details.selling_id');
        $builderTodaySelling->where('DATE(selling.datetime)', $date);
        $todaySelling = $builderTodaySelling->get()->getRow()->today_selling;
        
        // Query for Zero Stock
        $builderZeroStock = $db->table('product');
        $builderZeroStock->select('product.*, COUNT(product.stock) AS zero_stock');
        $builderZeroStock->where('stock <', 0);
        $zeroStockProducts = $builderZeroStock->get()->getRow()->zero_stock;

        $data = [
            'today_income' => $todayIncome,
            'today_selling' => $todaySelling,
            'zero_stock_products' => $zeroStockProducts
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
