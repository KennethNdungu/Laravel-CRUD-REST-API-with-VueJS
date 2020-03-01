<?php

use Illuminate\Database\Seeder;
use App\SupplierProduct;


class SupplierProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SupplierProduct::class, 10)->create();
    }
}
