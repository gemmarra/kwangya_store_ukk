<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Report extends BaseController
{
    public function index()
    {
        $data = [
            'page_title' => 'Report'
        ];
        return view('report', $data);
    }

    public function generate_report()
    {
        $range = $this->request->getPost('year-month');
        $month = $this->request->getPost('month');
        $year = $this->request->getPost('year');

        $db = \Config\Database::connect();

        

        // Mengirim data ke view laporan
        return view('report_result');
    }
}
