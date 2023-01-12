<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::all();
        $products = Product::all();
        foreach ($orders as $order) {
            $random = rand(1, 10);
            if ($random > 5) {
                foreach ($products as $product) {
                    $quantity = rand(1, 10);
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'price' => $product->price,
                        'category_id' => $product->category_id,
                        'quantity' => $quantity,
                        'amount' => $product->price * $quantity,
                    ]);
                }
            }
        }

        // Add total for Order based on OrderDetail
        $orderDetails = OrderDetail::all();
        foreach (Order::all() as $order) {
            $total = 0;
            foreach ($orderDetails as $orderDetail) {
                if ($orderDetail->order_id == $order->id) {
                    $total += $orderDetail->amount;
                }
            }
            if ($total !== 0) {
                $order->total = $total;
            }
            if ($order->id % 2 == 0) {
                $order->created_at = Carbon::now()->subYears(random_int(0, 2))->subMonths(random_int(0, 12))->subDays(random_int(0, 100));
            }
            $order->save();
        }

        // Change datetime of Order and OrderDetail
        
    }
}
