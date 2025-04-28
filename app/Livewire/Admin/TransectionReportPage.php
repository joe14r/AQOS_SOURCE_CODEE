<?php

namespace App\Livewire\Admin;

use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use App\Models\Order;
use App\Exports\OrdersExport;

class TransectionReportPage extends Component
{
    
    public function render()
    {
        $transections = Order::latest()->paginate(100);
        return view('livewire.admin.transection-report-page',[
            'transections'=>$transections
        ])->layout('components.layouts.dashboard');
    }

    public function downloadData()
    {
        // You can export in any format (CSV, Excel, etc.). Here, we'll export to CSV.
        return Excel::download(new OrdersExport, 'orders_report.csv');  // For CSV export
    }
}
