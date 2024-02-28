<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Denomination extends BaseController
{
    public function index(){
    if(!session()->get('sudahkahLogin')){
   	return redirect()->to('login');
   	 }
    $validasiForm=[
        'search' => 'required'
    ];
    
    if($validasiForm){
        $denomination_name=$this->request->getPost('search');
        $data=[
        'page_title' => 'Denomination',
        'DenominationList' => $checkRecord=$this->denomination->searching($denomination_name),
        'subnav' => '
        <a href="/product/select">All Product</a>
        <a href="/category/select">Category</a>
        <a class="active" href="/denomination/select">Denomination</a>
        ',
        'search' => '
        <div class="search">
            <form action="/denomination/search" method="post">
                <input type="text" name="search" id="" placeholder="Search category name here..." autocomplete="off">
            </form>
        </div>
        '
    ];
    return view('Denomination/select', $data);
}
    }

    public function delete($id){
        // if(session()->get('level')!='Admin'){
        // 	return redirect()->to('tampil-product');
        // 	exit;		
        // }

        $this->denomination->deleting($id);
        session()->setFlashdata('message','Data deleted');
        session()->setFlashdata('failmessage','Data fail to be deleted.');
        return redirect()->to('/denomination/select');
}

public function save()
    {
                // if(session()->get('level')!='admin'){
		// 	return redirect()->to('/petugas/dashboard');
		// 	exit;		
		// }

		$data=[
			'denomination_name'=>$this->request->getPost('denomination_name'),
		];

		$this->denomination->inserting($data);

        session()->setFlashdata('message','Data saved');
        session()->setFlashdata('failmessage','Data fail to be saved.');
		return redirect()->to('/denomination/select');
    }

    public function edit($id)
{
    // if(session()->get('level')!='Admin'){
    // 	return redirect()->to('tampil-denomination');
    // 	exit;		
    // }
    
    $syarat=[
        'denomination_id'=>$id
    ];

    $data=[
        'page_title' => 'Edit Denomination',
         'detaildenomination' => $this->denomination->where($syarat)->findAll(),
         'subnav' => '
        <a href="/product/select">All Product</a>
        <a href="/category/select">Category</a>
        <a class="active" href="/denomination/select">Denomination</a>
        ',
    ];
    
    return view('denomination/edit', $data);
}

public function update($denomination_id)
{
        $this->denomination->save([
            'denomination_id'=>$denomination_id,
            'denomination_name'=>$this->request->getVar('denomination_name')
        ]);

        session()->setFlashdata('message','<p class="message">Data updated</p>');

        session()->setFlashdata('failmessage','<p class="failmessage">Data fail to be updated</p>');

    return redirect()->to('/denomination/select');
}
}
