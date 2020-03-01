<?php

use Illuminate\Database\Seeder;
use App\OrderDetail;


class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderDetail::class, 10)->create();
    }
}
