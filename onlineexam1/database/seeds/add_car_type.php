<?php

use Illuminate\Database\Seeder;

class add_car_type extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $c = array([
            'name' => "Ritz",
			'car_type' => "Micro",
			'seat' => "6+1",
            'os_basefare' => '40',
            'os_permin' => "1",
            'os_perkm' => "6",
            'os_daylimit' => "250",
            'rent_4km_limit' => "40",
            'rent_4price' => "400",
            'rent_8km_limit' => "80",
            'rent_8price' => "800",
            'rent_12km_limit' => "120",
            'rent_12price' => "1200",
            'ptp_basefare' => "40",
            'ptp_perkm' => "6",
            'ptp_permin' => "1",
            'os' => "1",
            'rent' => "1",
            'ptp' => "1",
        ],[
            'name' => "WagonR",
			'car_type' => "Micro",
			'seat' => "6+1",
            'os_basefare' => '40',
            'os_permin' => "1",
            'os_perkm' => "6",
            'os_daylimit' => "250",
            'rent_4km_limit' => "40",
            'rent_4price' => "400",
            'rent_8km_limit' => "80",
            'rent_8price' => "800",
            'rent_12km_limit' => "120",
            'rent_12price' => "1200",
            'ptp_basefare' => "40",
            'ptp_perkm' => "6",
            'ptp_permin' => "1",
            'os' => "1",
            'rent' => "1",
            'ptp' => "1",
        ],[
            'name' => "Xcent",
			'car_type' => "Sedan",
			'seat' => "6+1",
            'os_basefare' => '60',
            'os_permin' => "1",
            'os_perkm' => "8",
            'os_daylimit' => "250",
            'rent_4km_limit' => "40",
            'rent_4price' => "400",
            'rent_8km_limit' => "80",
            'rent_8price' => "800",
            'rent_12km_limit' => "120",
            'rent_12price' => "1200",
            'ptp_basefare' => "60",
            'ptp_perkm' => "8",
            'ptp_permin' => "1",
            'os' => "1",
            'rent' => "1",
            'ptp' => "1",
        ]);
		foreach($c as $s)
		{
          DB::table('car_type')->insert($s);
		}
    }
}
