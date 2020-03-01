<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ProductSeeder::class);
         $this->call(OrderSeeder::class);
         $this->call(SupplierSeeder::class);
         $this->call(OrderDetailSeeder::class);
         $this->call(SupplierProductSeeder::class);

    }
}
