<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class OrdersController extends Controller
{
    public function print($uid)
    {
        
        $order = Order::where('unique_id', $uid)->first();
        //dd($order);

        return view('print.order-details', compact('order'));
    }

    public function generatePDF($uid)
    {
        $order = Order::where('unique_id', $uid)->first();
        $pdf = PDF::loadView('print.order-details', ['order' => $order]);

        // Download the PDF
        return $pdf->download('order.pdf');
    }
}
