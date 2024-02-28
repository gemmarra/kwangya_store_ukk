<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Purchase extends BaseController
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
        $purchase_date=$this->request->getPost('search');
        $data = [
            'page_title' => 'Purchase',
            'PurchaseList' => $checkRecord=$this->purchase->searching($purchase_date),
            'search' => '
            <div class="search">
                <form action="/purchase/search" method="post">
                    <input type="text" name="search" id="" placeholder="YYYY/MM/DD" autocomplete="off">
                </form>
            </div>'
        ];
        return view('Purchase/select', $data);
    }
    }

    public function insert()
    {   
        $data = [
            'page_title' => 'Add Purchase'
        ];
        
        return view('Purchase/insert', $data);
    }

    public function save()
    {
        // if(session()->get('level')!='admin'){
		// 	return redirect()->to('/petugas/dashboard');
		// 	exit;		
		// }

        // validation
        $rules = [
            'receipt_image' => 'required|is_image|max_size[receipt_image, 5000]'
        ];

        $messages = [
            'receipt_image' => [
                'required' => 'Please enter an image',
                'is_image' => 'Your input is not an image',
                'max_size' => 'Your image is too big'
            ]
        ];

        if(!$this->validate($rules, $messages)) {
            return view ('Purchase/insert', [
                'page_title' => 'Add Purchase',
                "validation" => $this->validator
            ]);
        }

        $fileimage = $this->request->getFile('receipt_image');
		
		// pindahkan file
		$fileimage->move('uploads/receipt');

		// ambilnama
		$namaimage = $fileimage->getName();

		$data=[
			'datetime'=>$this->request->getPost('datetime'),
			'expenditure_total'=>$this->request->getPost('expenditure_total'),
			'receipt_image'=>$namaimage
		];

		$this->purchase->inserting($data);

        session()->setFlashdata('message','Data saved');
        session()->setFlashdata('failmessage','Data fail to be saved.');
		return redirect()->to('/purchase/select');
    }

    public function delete($id){
        		// if(session()->get('level')!='Admin'){
		// 	return redirect()->to('tampil-product');
		// 	exit;		
		// }

		$this->product->deleting($id);
        session()->setFlashdata('message','Data deleted');
        session()->setFlashdata('failmessage','Data fail to be deleted.');
		return redirect()->to('/product/select');
    }

    
	public function edit($id)
	{
		// if(session()->get('level')!='Admin'){
		// 	return redirect()->to('tampil-product');
		// 	exit;		
		// }
		
		$syarat=[
			'purchase_id'=>$id
		];

		$data=[
            'page_title' => 'Edit Purchase',
	 		'detailpurchase' => $this->purchase->where($syarat)->findAll()
		];
		
		return view('Purchase/edit', $data);
	}

	public function update($id)
{
    $this->product->save([
        'purchase_id'=>$id,
        'datetime'=>$this->request->getVar('datetime'),
        'expenditure_total'=>$this->request->getVar('expenditure_total'),
        'role'=>$this->request->getVar('role'),
        'receipt_image'=>$this->request->getVar('receipt_image'),
    ]) ;

    session()->setFlashdata('message','Data updated');
    session()->setFlashdata('failmessage','Data fail to be updated.');
    return redirect()->to('/pruchase/select');
}
}
