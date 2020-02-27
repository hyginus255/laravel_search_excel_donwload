<?php

namespace App\Exports;

use App\Orders;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class OrdersExport implements FromCollection
{

    use Exportable;

    public function __construct($dates)
    {
        $this->dates = $dates;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // dd($this->dates['from']);
        dd( Orders::query()->whereBetween('orderDate', [$this->dates['from'], $this->dates['to']])->get());
    }
}
