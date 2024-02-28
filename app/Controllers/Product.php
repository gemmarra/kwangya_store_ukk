<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class Product extends BaseController
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
            $product_name=$this->request->getPost('search');
            $data=[
                'ProductList' => $checkRecord=$this->product->searching_name($product_name),
                'page_title' => 'Product',
                'subnav' => '
                <a class="active" href="/product/select">All Product</a>
                <a href="/category/select">Category</a>
                <a href="/denomination/select">Denomination</a>
                ',
                'search' => '
                <div class="search">
                    <form action="/product/search_name" method="post">
                        <input type="text" name="search" id="" placeholder="Search product name here..." autocomplete="off">
                    </form>
                </div>
                '
            ];
        }
        return view('Product/select', $data);
    }

    public function insert()
    {   
        $data = [
            'page_title' => 'Add Product',
            'CategoryList' => $this->category->findAll(),
            'DenominationList' => $this->denomination->findAll(),
            'subnav' => '
            <a class="active" href="/product/select">All Product</a>
            <a href="/category/select">Category</a>
            <a href="/denomination/select">Denomination</a>
            '
        ];
        return view('Product/insert', $data);
    }

    public function save()
    {
                // if(session()->get('level')!='admin'){
		// 	return redirect()->to('/petugas/dashboard');
		// 	exit;		
		// }

        // validation
        $rules = [
            'product_id' => 'required|numeric|max_length[14]|is_unique[product.product_id]',
            'product_name' => 'required|is_unique[product.product_name]',
            'stock' => 'required|numeric'
        ];

        $messages = [
            'product_id'=> [
                'max_length' => 'Product ID can not be more than 14 characters',
                'is_unique' => 'Product with this ID is already exist',
                'numeric' => 'Product ID needs to be numeric'
            ],
            'product_name' => [
                'is_unique' => 'This product is already exist'
            ],
            'stock' => [
                'numeric' => 'Enter a number'
            ]
        ];

        if(!$this->validate($rules, $messages)) {
            return view('Product/insert', [
                "validation" => $this->validator,
                'page_title' => 'Add Product',
                'CategoryList' => $this->category->findAll(),
                'DenominationList' => $this->denomination->findAll(),
                'subnav' => '
                <a class="active" href="/product/select">All Product</a>
                <a href="/category/select">Category</a>
                <a href="/denomination/select">Denomination</a>
                '
            ]);
        }

		$data=[
			'product_id'=>$this->request->getPost('product_id'),
			'product_name'=>$this->request->getPost('product_name'),
			'category'=>$this->request->getPost('category'),
			'stock'=>$this->request->getPost('stock'),
			'denomination'=>$this->request->getPost('denomination'),
			'selling_price'=>$this->request->getPost('selling_price'),
			'purchase_price'=>$this->request->getPost('purchase_price')
		];

        $this->product->inserting($data);
        session()->setFlashdata('message','<p class="message">Data saved</p>');
        session()->setFlashdata('failmessage','<p class="failmessage">Data fail to be saved</p>');
		return redirect()->to('/product/select');
    }

    public function delete($id){
        		// if(session()->get('level')!='Admin'){
		// 	return redirect()->to('tampil-product');
		// 	exit;		
		// }
        
        if ($this->product->deleting($id)) {
            session()->setFlashdata('message','<p class="message">Data deleted</p>');
        } else {
            session()->setFlashdata('failmessage','<p class="failmessage">Data fail to be deleted</p>');
        }

		return redirect()->to('/product/select');
    }

    
	public function edit($id)
	{
		// if(session()->get('level')!='Admin'){
		// 	return redirect()->to('tampil-product');
		// 	exit;		
		// }
		
		$syarat=[
			'product_id'=>$id
		];

		$data=[
            'page_title' => 'Edit Product',
            'CategoryList' => $this->category->findAll(),
            'DenominationList' => $this->denomination->findAll(),
	 		'detailProduct' => $this->product->where($syarat)->findAll(),
             'subnav' => '
             <a class="active" href="/product/select">All Product</a>
             <a href="/category/select">Category</a>
             <a href="/denomination/select">Denomination</a>
             '
		];
		
		return view('Product/edit', $data);
	}

	public function update($product_id)
{
    $syarat=[
        'product_id'=>$product_id
    ];
    $detailProduct = $this->product->where($syarat)->findAll();
    $rules = [
        'product_id' => 'required|numeric|max_length[14]|is_unique[product.product_id, product_id, '. $detailProduct[0]['product_id'] .']',
        'product_name' => [
            'rules' => [
                'required',
                'max_length[50]', // Adjust max length according to your database column definition
                function ($value, $params, $data) use ($detailProduct) {
                // Custom callback to check uniqueness, considering the current record
                $existingProductNames = array_column($detailProduct, 'product_name');

                // Remove the current product name from the list to ignore it
                $currentProductNameIndex = array_search($value, $existingProductNames);
                if ($currentProductNameIndex !== false) {
                    unset($existingProductNames[$currentProductNameIndex]);
                }

                // Check if the current product name already exists in other records
                if (in_array($value, $existingProductNames)) {
                    return 'The product name must be unique.';
                }

                // Check if the product_id exists in the data array and is not null
                if (isset($data['product_id']) && $data['product_id'] !== null) {
                    // Check if the product name already exists in other records with different product_id
                    $otherProducts = $this->product->where('product_name', $value)->findAll();
                    foreach ($otherProducts as $product) {
                        if ($product['product_id'] != $data['product_id']) {
                            return 'Another product with the same name already exists.';
                        }
                    }
                }
    
                    return true;
                }
            ]
        ],
        'selling_price' => 'required',
        'purchase_price' => 'required',
        'stock' => 'required|numeric'
    ];

    $messages = [
        'product_id'=> [
            'max_length' => 'Product ID can not be more than 14 characters',
            'is_unique' => 'Product with this ID is already exist',
            'numeric' => 'Product ID needs to be numeric'
        ],
        'product_name' => [
            'is_unique' => 'This product is already exist'
        ],
        'stock' => [
            'numeric' => 'Enter a number'
        ]
    ];

    $syarat=[
        'product_id'=>$product_id
    ];

    if(!$this->validate($rules, $messages)) {
        return view('Product/edit', [
            "validation" => $this->validator,
            'page_title' => 'Edit Product',
            'CategoryList' => $this->category->findAll(),
            'DenominationList' => $this->denomination->findAll(),
	 		'detailProduct' => $this->product->where($syarat)->findAll(),
            'subnav' => '
            <a class="active" href="/product/select">All Product</a>
            <a href="/category/select">Category</a>
            <a href="/denomination/select">Denomination</a>
            '
        ]);
    }

        $this->product->save([
            'product_id'=>$product_id,
            'product_name'=>$this->request->getVar('product_name'),
            'category'=>$this->request->getVar('category'),
            'stock'=>$this->request->getVar('stock'),
            'denomination'=>$this->request->getVar('denomination'),
            'selling_price'=>$this->request->getVar('selling_price'),
            'purchase_price'=>$this->request->getVar('purchase_price')
        ]);

        session()->setFlashdata('message','<p class="message">Data updated</p>');

        session()->setFlashdata('failmessage','<p class="failmessage">Data fail to be updated</p>');

    return redirect()->to('/product/select');
}

public function pdf(){
    $product_name=$this->request->getPost('search');
    $data=[
        'ProductList' => $this->product->selecting()
    ];
    return view('Product/pdf', $data);
}

public function pdfgenerate()
    {
        date_default_timezone_set('Asia/Jakarta');  
        $filename = date('Y-m-d-H-i-s'). '-product-report';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $data=[
            'ProductList' => $this->product->selecting()
        ];

        // load HTML content
        $dompdf->loadHtml(view('Product/pdf', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}
