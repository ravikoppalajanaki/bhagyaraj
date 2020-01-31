<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		
        $this->call(add_settings::class);
        $this->call(adminsTableSeeder::class);
        $this->call(add_car_type::class);
    }
}
