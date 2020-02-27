<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use App\OrderLines;
use App\Orders;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    //

    public function index(){
        $orders = Orders::paginate(5);
        return view('welcome',compact('orders'));
    }

    public function export(Request $request){

        $from = $request->from;
        $to = $request->to;
        $dates = ['from'=>$from, 'to'=>$to];

        // $orders = Orders::whereBetween('orderDate', [$from, $to])->get();

        return Excel::download(new OrdersExport($dates), 'users.xlsx');
    }
}
