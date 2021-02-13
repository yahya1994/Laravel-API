<?php

use Illuminate\Database\Seeder;

class ReclamationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Reclamation::class,10)->create();
    }
}
