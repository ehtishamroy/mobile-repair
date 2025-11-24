<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RepairOrder;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Check if user has permission to view reports
        $user = auth()->user();
        if (!$user->isAdmin() && !$user->hasPermission('manage-orders') && !$user->hasPermission('manage-repairs')) {
            abort(403, 'You do not have permission to view reports.');
        }
        
        $settings = Setting::first();
        $currencySymbol = $settings->currency_symbol ?? '£';
        
        // Get date filters
        $startDate = $request->get('start_date', date('Y-m-01')); // First day of current month
        $endDate = $request->get('end_date', date('Y-m-d')); // Today
        
        // Product Orders Statistics
        $productOrdersQuery = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        
        $totalProductOrders = $productOrdersQuery->count();
        $productOrdersPaid = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('payment_status', 'paid')
            ->count();
        
        $productRevenue = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('payment_status', 'paid')
            ->sum('total');
        
        $productRevenueStripe = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('payment_status', 'paid')
            ->where('payment_method', 'stripe')
            ->sum('total');
        
        $productRevenuePaypal = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('payment_status', 'paid')
            ->where('payment_method', 'paypal')
            ->sum('total');
        
        // Repair Orders Statistics
        $repairOrdersQuery = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        
        $totalRepairOrders = $repairOrdersQuery->count();
        $repairOrdersPaid = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('status', 'paid')
            ->count();
        
        $repairRevenue = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('status', 'paid')
            ->sum('total');
        
        $repairRevenueStripe = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('status', 'paid')
            ->where('payment_method', 'stripe')
            ->sum('total');
        
        $repairRevenuePaypal = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('status', 'paid')
            ->where('payment_method', 'paypal')
            ->sum('total');
        
        // Combined Statistics
        $totalOrders = $totalProductOrders + $totalRepairOrders;
        $totalRevenue = $productRevenue + $repairRevenue;
        $totalRevenueStripe = $productRevenueStripe + $repairRevenueStripe;
        $totalRevenuePaypal = $productRevenuePaypal + $repairRevenuePaypal;
        
        // Product Orders by Status
        $productOrdersByStatus = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->select('status', DB::raw('count(*) as count'), DB::raw('sum(total) as revenue'))
            ->groupBy('status')
            ->get();
        
        // Repair Orders by Status
        $repairOrdersByStatus = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->select('status', DB::raw('count(*) as count'), DB::raw('sum(total) as revenue'))
            ->groupBy('status')
            ->get();
        
        // Repair Orders by Delivery Method
        $repairOrdersByDelivery = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->select('delivery_method', DB::raw('count(*) as count'), DB::raw('sum(total) as revenue'))
            ->groupBy('delivery_method')
            ->get();
        
        // Repair Orders by Payment Method (including null/empty for pay on visit)
        $repairOrdersByPaymentRaw = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get()
            ->groupBy(function($order) {
                return empty($order->payment_method) ? 'pay_on_visit' : $order->payment_method;
            })
            ->map(function($group, $paymentMethod) {
                return (object)[
                    'payment_method' => $paymentMethod,
                    'count' => $group->count(),
                    'revenue' => $group->where('status', 'paid')->sum('total')
                ];
            })
            ->values();
        
        // Visit Us orders count and revenue
        $visitUsOrders = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('delivery_method', 'visit')
            ->count();
        
        $visitUsRevenue = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('delivery_method', 'visit')
            ->where('status', 'paid')
            ->sum('total');
        
        // Online Delivery orders count and revenue
        $onlineDeliveryOrders = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('delivery_method', 'online')
            ->count();
        
        $onlineDeliveryRevenue = RepairOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('delivery_method', 'online')
            ->where('status', 'paid')
            ->sum('total');
        
        // Daily Revenue Chart Data (Last 30 days)
        $dailyRevenue = [];
        $chartStartDate = date('Y-m-d', strtotime('-30 days'));
        $chartEndDate = date('Y-m-d');
        
        $productDaily = Order::whereBetween('created_at', [$chartStartDate . ' 00:00:00', $chartEndDate . ' 23:59:59'])
            ->where('payment_status', 'paid')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total) as revenue'))
            ->groupBy('date')
            ->get()
            ->keyBy('date');
        
        $repairDaily = RepairOrder::whereBetween('created_at', [$chartStartDate . ' 00:00:00', $chartEndDate . ' 23:59:59'])
            ->where('status', 'paid')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total) as revenue'))
            ->groupBy('date')
            ->get()
            ->keyBy('date');
        
        // Combine daily data
        $currentDate = strtotime($chartStartDate);
        $endTimestamp = strtotime($chartEndDate);
        while ($currentDate <= $endTimestamp) {
            $date = date('Y-m-d', $currentDate);
            $productItem = $productDaily->get($date);
            $repairItem = $repairDaily->get($date);
            $productRev = $productItem ? (float)$productItem->revenue : 0;
            $repairRev = $repairItem ? (float)$repairItem->revenue : 0;
            $dailyRevenue[] = [
                'date' => $date,
                'product' => $productRev,
                'repair' => $repairRev,
                'total' => $productRev + $repairRev
            ];
            $currentDate = strtotime('+1 day', $currentDate);
        }
        
        // Recent Orders with Pagination
        $productOrdersPage = $request->get('product_page', 1);
        $repairOrdersPage = $request->get('repair_page', 1);
        
        $recentProductOrders = Order::with(['items'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->latest()
            ->paginate(10, ['*'], 'product_page')
            ->appends($request->except('product_page'));
        
        $recentRepairOrders = RepairOrder::with(['service', 'deviceType'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->latest()
            ->paginate(10, ['*'], 'repair_page')
            ->appends($request->except('repair_page'));
        
        return view('admin.reports.index', compact(
            'currencySymbol',
            'startDate',
            'endDate',
            'totalProductOrders',
            'productOrdersPaid',
            'productRevenue',
            'productRevenueStripe',
            'productRevenuePaypal',
            'totalRepairOrders',
            'repairOrdersPaid',
            'repairRevenue',
            'repairRevenueStripe',
            'repairRevenuePaypal',
            'totalOrders',
            'totalRevenue',
            'totalRevenueStripe',
            'totalRevenuePaypal',
            'productOrdersByStatus',
            'repairOrdersByStatus',
            'repairOrdersByDelivery',
            'repairOrdersByPaymentRaw',
            'visitUsOrders',
            'visitUsRevenue',
            'onlineDeliveryOrders',
            'onlineDeliveryRevenue',
            'dailyRevenue',
            'recentProductOrders',
            'recentRepairOrders'
        ));
    }
}

