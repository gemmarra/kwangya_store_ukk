<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class Selling extends BaseController
{
    
    public function index(){
        if(!session()->get('sudahkahLogin')){
   		 return redirect()->to('login');
   	 }
    //  $seereport = [
    //     'range' => 'required',
    //     'month' => 'required',
    //     'year'=>   'required',
    //  ];

    //  if($seereport){
    //     $range = $this->request->getPost('year-month');
    //     $month = $this->request->getPost('month');
    //     $year = $this->request->getPost('year');
    //     if ($range == "monthly"){
    //         $result = $this->selling->report_month($month, $year);   
    //         $data = [
    //             'page_title' => 'Selling',
    //             'SellingList' => $result,
    //         ];
    //         return view('Selling/select', $data);
    //     }  elseif ($range == "yearly") {
            //$result = $this->selling->report_year($year);
    //         $data = [
    //             'page_title' => 'Selling',
    //             'SellingList' => $result,
    //         ];
    //         return view('Selling/select', $data);
    //     //}
    //  } else {
        $data = [
            'page_title' => 'Selling',
            'SellingList' => $this->selling->selecting()
        ];
        return view('Selling/select', $data);
     //}
    }

    public function cashiermachine()
    {       $grand_total = $this->sellingdetails->sumprice(session()->get('SellingID'));
            $datalist = [
                'CategoryList' => $this->category->selecting(),
                'ProductList' => $this->product->selecting_no_zero(),
                'factur' => $this->selling->generateFactur(),
                'sellingdetails' => $this->sellingdetails->showing_details(session()->get('SellingID')),
                'grand_total' => $grand_total
            ];
            return view('Selling/cashier', $datalist);
    }

    public function save(){
    $where=['product_id'=>$this->request->getPost('product_id')];
    $checkProduct=$this->product->where($where)->findAll(); 
    $sellingPrice=$checkProduct[0]['selling_price'];
    if(session()->get('SellingID') == null){  
        date_default_timezone_set('Asia/Jakarta');          
        //$payed_money = $this->request->getPost('payed_money');
        //$change_money = $this->request->getPost('change_money');
            $dataSelling=[
                'factur' => $this->selling->generateFactur(),                
                'datetime'=>date('Y-m-d H:i:s'),
                'grand_total'=>0//$this->sellingdetails->selectSum('price_total')
            ];         
            //2 simpan ke tabel penjualan
            $this->selling->insert($dataSelling);

        // 3. Menyiapkan data untuk menyimpan detail penjualan
        $SellingIDNew = $this->selling->insertID(); // Mendapatkan ID penjualan baru
        $quantity = $this->request->getPost('quantity');
           $datadetails = [
               'selling_id' => $SellingIDNew,
               'factur' => $this->selling->generateFactur(),               
               'product_id' => $this->request->getPost('product_id'), // Corrected to 'product_id'
               'quantity' => $quantity,
               'price_total' => $quantity * $sellingPrice // Corrected calculation
           ];

        // 4. Menyimpan data ke dalam tabel detail penjualan
        $this->sellingdetails->insert($datadetails);

        // 5. Membuat session untuk penjualan baru
        session()->set('SellingID', $SellingIDNew);
    } else {
        // Jika ada ID penjualan yang sudah tersimpan di sesi, gunakan ID itu untuk menyimpan detail penjualan
        $SellingIDNow = session()->get('SellingID');
        $quantity = $this->request->getPost('quantity');
        $datadetails=[
            'selling_id'=>$SellingIDNow,
            'factur' => $this->selling->generateFactur(),            
            'product_id' => $this->request->getPost('product_id'), // Corrected to 'product_id'
            'quantity' => $quantity,
            'price_total' => $quantity * $sellingPrice // Corrected calculation
        ];

        // Simpan data ke dalam tabel detail penjualan
        $this->sellingdetails->insert($datadetails);
    }

    // Mengarahkan pengguna kembali ke halaman transaksi penjualan
    return redirect()->to('/selling/cashier_machine');
    }

    public function insert_total(){
        $data=[           
            'grand_total' => $this->request->getPost('grand_total'),
            'payed_money' => $this->request->getPost('payed_money'),
            'change_money' => $this->request->getPost('change_money'),
        ];
        $this->selling->update(session()->get('SellingID'), $data);
        return redirect()->to('/selling/payment');
    }

    public function payment(){
        $SellingIDend = session()->get('SellingID');
        session()->remove('SellingID');
        return redirect()->to('/selling/cashier_machine');
    }

    public function pdf(){
        $data=[
            'SellingList' => $this->selling->selecting()
        ];
        return view('Selling/pdf', $data);
    }
    
    public function pdfgenerate()
        {
            date_default_timezone_set('Asia/Jakarta');  
            $filename = date('Y-m-d-H-i-s'). '-selling-report';
    
            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
    
            $data=[
                'SellingList' => $this->selling->selecting()
            ];
    
            // load HTML content
            $dompdf->loadHtml(view('Selling/pdf', $data));
    
            // (optional) setup the paper size and orientation
            $dompdf->setPaper('A4', 'potrait');
    
            // render html as PDF
            $dompdf->render();
    
            // output the generated pdf
            $dompdf->stream($filename);
        }

        public function generateInvoiceNumber()
        {
            // Check if last invoice number and date are stored in session
            $lastInvoiceNumber = session()->get('last_invoice_number');
            $lastGeneratedDate = session()->get('last_generated_date');
    
            // Get today's date
            $today = date('Y-m-d');
    
            if ($lastGeneratedDate === $today && $lastInvoiceNumber !== null) {
                // Increment the last generated invoice number
                $lastInvoiceNumber++;
                $invoiceNumber = str_pad($lastInvoiceNumber, 3, '0', STR_PAD_LEFT);
            } else {
                // Reset invoice number to '001'
                $invoiceNumber = '001';
            }
    
            // Store the generated invoice number and today's date in session
            session()->set('last_invoice_number', $lastInvoiceNumber);
            session()->set('last_generated_date', $today);
    
            // Pass the generated invoice number to the view
            return view('Selling/cashier', ['invoiceNumber' => $invoiceNumber]);
        }
}
