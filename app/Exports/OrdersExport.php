<?php

namespace App\Exports;

use App\Orders;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromQuery, WithHeadings, WithMapping
{

    use Exportable;

    public function __construct($dates)
    {
        $this->dates = $dates;
    }

    public function query()
    {
        $orders = (array) Orders::query()->whereBetween('orderDate', [$this->dates['from'], $this->dates['to']])->get();
        return $this->map($orders);
    }

    public function headings(): array
    {
        return [
            'order Number',
            'Order Date',
            'Quantity Order',
            'Total Price',
            'Customer Name',
            'Customer Phone',
        ];
    }


    public function map($orders): array
    {
        
        foreach($orders as $order){
            return [
                $order['orderNumber'],
                $order->orderDate,
                $order->orderLine->quantityOrdered,
                $order->orderLine->sum('priceEach'),
                $order->customer->customerName,
                $order->customer->phone,
            ];
        }
    }

    

    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Orders::query()->whereBetween('orderDate', [$this->dates['from'], $this->dates['to']])->get();
    // }
}
