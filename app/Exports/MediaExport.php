<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class MediaExport implements FromView, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $exceldata;
    public function __construct($data)
    {
        $this->exceldata = $data;
    }
    public function view(): View
    {
        return view('exports.media-report', $this->exceldata);
    }
    
    public function title(): string
    {
        return "Media Reports";
    }
}
