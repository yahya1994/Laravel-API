<?php

use Illuminate\Database\Seeder;

class DeliveryManInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\DeliveryManInfo::class,10)->create();
    }
}
