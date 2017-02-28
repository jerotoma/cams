<?php

use Illuminate\Database\Seeder;

class PCCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories=array('Food','Gift/Share','Livestock','Business Investment','Water','Medical','Education',
            'Debt repayment','Transport','Rent or shelter materials','Agriculture inputs','Household items','Fuel',
            'Clothes/Shoes','Labour- shelter','Labour- Agriculture','Saved/in hand','Other');

        foreach ($categories as $category)
        {
            $cat=new \App\PCCategories;
            $cat->category_name=$category;
            $cat->save();
        }
    }
}
