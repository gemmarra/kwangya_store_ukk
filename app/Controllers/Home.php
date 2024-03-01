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
        $data = [
            'page_title' => 'Dashboard',
            'today_selling' => $this->selling->todayselling(),
            'zero_stock' => $this->product->zerostock(),
            'today_income' => $this->selling->todayincome(),
        ];
        return view('dashboard', $data);
    }

    // public function coba1()
    // {
    //     $data = [
    //         'CategoryList' => $this->category->selecting(),
    //         'ProductList' => $this->product->selecting(),
    //     ];
    //     return view('coba', $data);
    // }

    // public function coba2()
    // {
    //     // $data = [
    //     //     'CategoryList' => $this->category->selecting(),
    //     //     'ProductList' => $this->product->selecting(),
    //     // ];
    //     return view('coba2');
    // }
}
