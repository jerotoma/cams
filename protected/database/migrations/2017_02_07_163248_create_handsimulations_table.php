<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandsimulationsTable extends Migration
{
    public $parts = array( 
					array('slug'=> 'perlvis'),
					array('slug'=> 'truck' ),
					array('slug'=> 'head'  ),
					array('slug'=> 'hip'   ),
					array('slug'=> 'hip'   ),
					array('slug'=> 'thighs'),
					array('slug'=> 'knee'  ),
					array('slug'=> 'knee'  ),
					array('slug'=> 'ankle' ),
					array('slug'=> 'ankle' ),
				   );
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		
		Schema::table('handsimulations', function (Blueprint $table) {
               
              $count = 0;
		      $parts = $this->parts;
			  $table->increments('id');
			  $table->integer('p_assessment_id')->unsigned();
			  while($count < count($parts)){

				  $table->string($parts[$count]['slug'], 100)->nullable();
				  $table->text($parts[$count]['slug'].'_'.$count)->nullable();
				  $count++;
				 }
			$table->timestamps();
			$table->foreign('p_assessment_id')->references('id')->on('physicalassessments')
					->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('handsimulations', function (Blueprint $table) {
            //
        });
    }
}
