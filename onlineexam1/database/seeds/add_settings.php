<?php

use Illuminate\Database\Seeder;

class add_settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert(array(
		  'driver_allowance' => "250"
			));
    }
}
