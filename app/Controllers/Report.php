<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Report extends BaseController
{
    public function index()
    {
        if(!session()->get('sudahkahLogin')){
   		 return redirect()->to('login');
   	 }
        $data = [
            'page_title' => 'Report'
        ];
        return view('report', $data);
    }

    // public function generate_report()
    // {
        // $range = $this->request->getPost('year-month');
        // $month = $this->request->getPost('month');
        // $year = $this->request->getPost('year');

    //     if ($range == "montly"){
    //         $result=$this->selling->report_month($month, $year);
    //         $data = [
    //             'page_title' => 'Selling Report',
    //             'result' => $result
    //         ];
    //         return view('report_result', $data);
    //     }  elseif ($range == "yearly") {
    //         $result=$this->selling->report_year($year);
    //         $data = [
    //             'page_title' => 'Selling Report',
    //             'result' => $result
    //         ];
    //         return view('report_result', $data);
    //     }
    // }

    public function generate_report()
    {
        // Ambil data bulan dan tahun dari form
        $range = $this->request->getPost('year-month');
        $month = $this->request->getPost('month');
        $year = $this->request->getPost('year');

        // Buat koneksi ke database
        $db = \Config\Database::connect();

        // Query untuk mengambil data selling
        $builder = $db->table('selling_details');
        $builder->select('selling_details.*, SUM(selling_details.price_total) AS total_selling, SUM((product.selling_price - product.purchase_price) * selling_details.quantity) AS total_profit, product.product_name, product.selling_price, product.purchase_price');
        $builder->join('selling', 'selling.selling_id = selling_details.selling_id');
        $builder->join('product', 'product.product_id = selling_details.product_id');

        if ($range == 'Monthly') {
            // Laporan Bulanan
            $builder->where('MONTH(selling.datetime)', $month);
            $builder->where('YEAR(selling.datetime)', $year);
        } else {
            // Laporan Tahunan
            $builder->where('YEAR(selling.datetime)', $year);
        }

        $query = $builder->get();
        $result = $query->getRow();

        // Query untuk mendapatkan detail selling
        $detailQuery = $db->table('selling_details')
            ->select('selling_details.*, product.product_name, product.selling_price, product.purchase_price')
            ->join('product', 'product.product_id = selling_details.product_id');

        if ($range == 'Monthly') {
            // Laporan Bulanan
            $detailQuery->join('selling', 'selling.selling_id = selling_details.selling_id')
                ->where('MONTH(selling.datetime)', $month)
                ->where('YEAR(selling.datetime)', $year);
        } else {
            // Laporan Tahunan
            $detailQuery->join('selling', 'selling.selling_id = selling_details.selling_id')
                ->where('YEAR(selling.datetime)', $year);
        }

        $detailResult = $detailQuery->get()->getResultArray();

        $data = [
            'detail_selling' => $detailResult,
            'month' => $month,
            'year' => $year,
            'range' => $range,
            'total_selling' => isset($result->total_selling) ? $result->total_selling : null,
            'total_profit' => isset($result->total_profit) ? $result->total_profit : null
        ];

        // Mengirim data ke view laporan
        return view('report_result', $data);
    }
}
