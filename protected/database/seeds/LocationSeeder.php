<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $country=new \App\Country;
        $country->country_name="Tanzania";
        $country->save();

        $region=new \App\Region;
        $region->region_name ="Kigoma";
        $region->country_id =$country->id;
        $region->save();

        $district=new \App\District;
        $district->district_name ="Kibondo";
        $district->region_id =$region->id;
        $district->save();

        $camp=new \App\Camp;
        $camp->camp_name="Nduta";
        $camp->region_id =$region->id;
        $camp->district_id =$district->id;
        $camp->save();

        $district=new \App\District;
        $district->district_name ="Kakonko";
        $district->region_id =$region->id;
        $district->save();

        $camp=new \App\Camp;
        $camp->camp_name="Mtendeli";
        $camp->region_id =$region->id;
        $camp->district_id =$district->id;
        $camp->save();
    }
}
