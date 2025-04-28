<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    // Fetch and modify data before export
    public function collection()
    {
        $orders = Order::all();  // Fetch all orders

        // Modify or format data as needed
        $modifiedOrders = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'name' => $order->name,
                'phone' => $order->phone,
                'status' => $order->status,
                'paymentMethod' => $order->paymentMethod,
                'paymentStatus' => $order->paymentStatus,
                'date_time' => $order->created_at->format('Y-m-d H:i:s'), // Format date
                'table_no' => $order->table->title,
                //'recipeta_number' => $order->recipeta_number,
                'amount' => number_format($order->total, 2), // Format amount to 2 decimal places
                // Add any other modifications here
            ];
        });

        return $modifiedOrders;
    }

    // Headings for the export file
    public function headings(): array
    {
        return [
            'ID',
            'name',
            'Phone',
            'Status',
            'Payment method',
            'Payment Status',
            'Date & Time',
            'Table No',
            'Amount (RM)'
        ];
    }
}
