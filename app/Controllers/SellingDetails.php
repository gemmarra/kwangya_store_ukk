<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SellingDetails extends BaseController
{
    public function index($sellingid)
	{
		// if(session()->get('level')!='Admin'){
		// 	return redirect()->to('tampil-product');
		// 	exit;		
		// }
		if(!session()->get('sudahkahLogin')){
   		 return redirect()->to('login');
   	 }
		
		$syarat=[
			'selling_id'=>$sellingid
		];

		$data=[
			'page_title' =>'Selling Details',
	 		'SellingDetailsList' => $this->sellingdetails->selecting($syarat),
		];
		//var_dump($data);
		return view('SellingDetails/select', $data);
	}

	public function cashier_details(){
		$mydata['id'] = session()->get('SellingID');

        $data = [
			'sellingdetails' => $this->sellingdetails->select_details($mydata)
		];
		
        return view ('Selling/cahiser-machine', $data);
	}

	public function save() {
		$quantity = $this->request->getPost('quantity');
		$price = $this->request->getPost('price');
		$data = [
			'factur' => $this->request->getPost('factur'),
			'product_id' => $this->request->getPost('product_id'), // Corrected to 'product_id'
			'quantity' => $quantity,
			'price_total' => $quantity * $price // Corrected calculation
		];
	
		$this->sellingdetails->insert($data);
		return redirect()->to('/selling/cashier_machine');
	}
	
	public function grand_total(){
		$SellingIDNew = $this->selling->insertID();
		$GrandTotal = $this->sellingdetails->sumprice($SellingIDNew);

		return view('Selling/cashier-machine', $GrandTotal);
	}
}
