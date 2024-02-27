<?php

namespace App\Helpers;

use Maatwebsite\Excel\Excel as LaravelExcel;

class ExcelHelper
{
    protected $excel;

    public function __construct(LaravelExcel $excel)
    {
        $this->excel = $excel;
    }

    public function downloadExcel($data, $filename)
    {
        return $this->excel->download(function ($excel) use ($data) {
            $excel->sheet('Sheet 1', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        }, $filename . '.xlsx');
    }
}
