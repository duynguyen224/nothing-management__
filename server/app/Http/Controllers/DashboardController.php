<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function revenue(Request $request)
    {
        $year = $request->query('year');

        $orders = Order::select(
            DB::raw('sum(total) as revenue'),
            DB::raw("DATE_FORMAT(created_at,'%m') as month")
        )->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        foreach ($orders as $order) {
            $order->month = intval($order->month);
        }

        return $orders;
    }

    public function topCategories(Request $request)
    {
        $year = $request->query('year');

        $orderDetail = DB::table('order_detail')
            ->select(
                DB::raw('sum(quantity) as sell_quantity'),
                DB::raw('category_id as category_id'),
                DB::raw('categories.name as category_name')
            )
            ->join('categories', 'categories.id', '=', 'order_detail.category_id')
            ->whereYear('order_detail.created_at', $year)
            ->groupBy('category_name', 'category_id')
            ->orderBy('category_name', 'asc')
            ->take(5)->get();

        return $orderDetail;
    }
}
