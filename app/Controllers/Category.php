<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Category extends BaseController
{
    public function index()
    {
        if(!session()->get('sudahkahLogin')){
   		 return redirect()->to('login');
   	 }
        $validasiForm=[
            'search' => 'required'
        ];
        
        if($validasiForm){
            $category_name=$this->request->getPost('search');
            $data=[
            'page_title' => 'Category',
            'CategoryList' => $checkRecord=$this->category->searching($category_name),
            'subnav' => '
            <a href="/product/select">All Product</a>
            <a class="active" href="/category/select">Category</a>
            <a href="/denomination/select">Denomination</a>
            ',
            'search' => '
            <div class="search">
                <form action="/category/search" method="post">
                    <input type="text" name="search" id="" placeholder="Search category name here..." autocomplete="off">
                </form>
            </div>
            '
        ];
        return view('Category/select', $data);
    }
}
    
    // public function insert()
    // {   
    //     return view('layout');
    // }

    public function save()
    {
        // if(session()->get('level')!='admin'){
		// 	return redirect()->to('/petugas/dashboard');
		// 	exit;		
		// }

        $this->category->save([
            'category_name'=>strtolower($this->request->getPost('category_name'))
        ]);

        session()->setFlashdata('message','Data saved');
        session()->setFlashdata('failmessage','Data fail to be saved.');
		return redirect()->to('/category/select');
    }
    
    public function delete($id){
        // if(session()->get('level')!='Admin'){
        // 	return redirect()->to('tampil-category');
        // 	exit;		
        // }

        $this->category->deleting($id);
        session()->setFlashdata('message','Data deleted');
        session()->setFlashdata('failmessage','Data fail to be deleted.');
        return redirect()->to('/category/select');
}

public function edit($id)
{
    // if(session()->get('level')!='Admin'){
    // 	return redirect()->to('tampil-category');
    // 	exit;		
    // }
    
    $syarat=[
        'category_id'=>$id
    ];

    $data=[
        'page_title' => 'Edit Category',
         'detailcategory' => $this->category->where($syarat)->findAll(),
         'subnav' => '
            <a href="/product/select">All Product</a>
            <a class="active" href="/category/select">Category</a>
            <a href="/denomination/select">Denomination</a>
            ',
    ];
    
    return view('Category/edit', $data);
}

public function update($category_id)
{
        $this->category->save([
            'category_id'=>$category_id,
            'category_name'=>$this->request->getVar('category_name')
        ]);

        session()->setFlashdata('message','<p class="message">Data updated</p>');

        session()->setFlashdata('failmessage','<p class="failmessage">Data fail to be updated</p>');

    return redirect()->to('/category/select');
}
}
