<?php

namespace Database\Seeders;

use App\Models\Order;
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
        $orders = Order::all();

        foreach ($orders as $key => $order) {
            $order->products()->attach( $key + 3, ['quantity' => rand(1, 10), 'price' => rand(10000, 200000)]);
            $order->products()->attach( $key + 2, ['quantity' => rand(1, 10), 'price' => rand(10000, 200000)]);
            $order->products()->attach( $key + 4, ['quantity' => rand(1, 10), 'price' => rand(10000, 200000)]);
        }
    }
}
