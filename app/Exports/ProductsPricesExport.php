<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductsPricesExport implements FromView
{
    private $rows;

    public function __construct($rows)
    {
        $this->rows = $rows;
    }

    public function view() : View
    {
        return view('backend.exports.prices', [
            'rows' => $this->rows
        ]);
    }

}
