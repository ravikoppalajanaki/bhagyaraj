<?php

use Illuminate\Database\Seeder;

class adminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $c = array([
            'name' => str_random(10),
            'email' => 'abc@gmail.com',
            'password' => bcrypt('secret')
        ],
		[
            'name' => str_random(10),
            'email' => 'abc1@gmail.com',
            'password' => bcrypt('secret')
			
         ]);
		foreach($c as $s)
		{
          DB::table('admins')->insert($s);
		}
    }
}
