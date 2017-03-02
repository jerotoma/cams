<?php

use Illuminate\Database\Seeder;

class NeedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories=array('Needs of Items','Referral',);
        foreach ($categories as $category){
            $cat_need=new \App\NeedCategory;
            $cat_need->category_name=$category;
            $cat_need->save();
        }

        $forreferral=\App\NeedCategory::where('category_name','=','Referral')->get()->first();
        $referral_needs=array('Needs for referral','Health','Psychosocial','Child protection','Shelter','NFIs');

        foreach ($referral_needs as $need){
            $ref_need=new \App\Need;
            $ref_need->need_name=$need;
            $ref_need->category_id=$forreferral->id;
            $ref_need->save();
        }

        $forr_actions=\App\NeedCategory::where('category_name','=','Needs of Items')->get()->first();

        $foraction_needs=array('Assisting devices','Crutches','Toilet chair',
                               'Urine flaks:','White cane','Walking aids','Wheel chairs','Incontinent kit',
            'Bedpan','Needs for specific Items','Mattresses','Blanket','Stove','Toileteries','Diapers',
            'Jarrican','Clothing','Dignity kit men','Dignity kit women','Underwear','Needs for protection items',
            'Flashlight','Whistle','Radio','Wheelchair','Functional Assessments');

        foreach ($foraction_needs as $need){
            $Item_need=new \App\Need;
            $Item_need->need_name=$need;
            $Item_need->category_id=$forr_actions->id;
            $Item_need->save();
        }
    }
}
