<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getChartData()
    {
        // Get the current date and the date 30 days ago
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(30);
        
        // Get orders in the last 30 days
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                       ->selectRaw('DATE(created_at) as date, count(*) as order_count, sum(total) as total_sales')
                       ->groupBy('date')
                       ->orderBy('date', 'asc')
                       ->get();

        // Prepare the data for chart
        $dates = [];
        $orderCounts = [];
        $salesSums = [];

        // Loop through the orders and populate the arrays
        foreach ($orders as $order) {
            $dates[] = $order->date;  // Date
            $orderCounts[] = $order->order_count;  // Daily order count
            $salesSums[] = $order->total_sales;  // Daily total sales
        }

        // Return the data in JSON format
        return response()->json([
            'dates' => $dates,
            'orders' => $orderCounts,
            'sells' => $salesSums,
        ]);
    }

    public function getWeeklyChartData()
    {
        // Get the current date and the date 6 months ago
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subMonths(1);

        // Get orders in the last 6 months grouped by week
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                       ->selectRaw('YEARWEEK(created_at) as week, count(*) as order_count, sum(total) as total_sales')
                       ->groupBy('week')
                       ->orderBy('week', 'asc')
                       ->get();

        // Prepare the data for the chart
        $weeks = [];
        $orderCounts = [];
        $salesSums = [];

        // Loop through the orders and populate the arrays
        foreach ($orders as $order) {
            $weekStartDate = Carbon::now()->setISODate(date('Y', strtotime($order->week)), date('W', strtotime($order->week)))->startOfWeek()->format('M-d');
            $weeks[] = $weekStartDate;  // Week starting date
            $orderCounts[] = $order->order_count;  // Weekly order count
            $salesSums[] = $order->total_sales;  // Weekly total sales
        }

        // Return the data in JSON format
        return response()->json([
            'weeks' => $weeks,
            'orders' => $orderCounts,
            'sells' => $salesSums,
        ]);
    }

    public function getMonthlyChartData()
    {
        // Get the current date and the date 1 year ago
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subYear();

        // Get orders in the last 1 year grouped by month
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                       ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, count(*) as order_count, sum(total) as total_sales')
                       ->groupBy('year', 'month')
                       ->orderBy('year', 'asc')
                       ->orderBy('month', 'asc')
                       ->get();

        // Prepare the data for the chart
        $months = [];
        $orderCounts = [];
        $salesSums = [];

        // Loop through the orders and populate the arrays
        foreach ($orders as $order) {
            // Format the month as "Month-Year" (e.g., Jan-2022)
            $monthYear = Carbon::createFromFormat('Y-m', $order->year . '-' . $order->month)->format('M-Y');
            $months[] = $monthYear;  // Month-Year (e.g., Jan-2022)
            $orderCounts[] = $order->order_count;  // Monthly order count
            $salesSums[] = $order->total_sales;  // Monthly total sales
        }

        // Return the data in JSON format
        return response()->json([
            'months' => $months,
            'orders' => $orderCounts,
            'sells' => $salesSums,
        ]);
    }


}
