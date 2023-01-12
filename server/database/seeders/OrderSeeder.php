<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = User::where('role', Role::CLIENT)->get();
        for ($i = 1; $i <= 500; $i++) {
            $randCustomer = rand(0, count($customers) - 1);
            Order::create([
                'customer_id' => $customers[$randCustomer]->id,
                'total' => $i * 100000
            ]);
        }
    }
}
