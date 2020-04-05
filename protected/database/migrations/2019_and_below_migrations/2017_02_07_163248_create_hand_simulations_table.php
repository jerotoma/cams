<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandSimulationsTable extends Migration
{
    public $parts = array( 
					array('slug'=> 'perlvis'),
					array('slug'=> 'truck' ),
					array('slug'=> 'head'  ),
					array('slug'=> 'l_hip'   ),
					array('slug'=> 'r_hip'   ),
					array('slug'=> 'thighs'),
					array('slug'=> 'l_knee'  ),
					array('slug'=> 'r_knee'  ),
					array('slug'=> 'l_ankle' ),
					array('slug'=> 'r_ankle' ),
				   );
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		
		Schema::create('hand_simulations', function (Blueprint $table) {
               
              $count = 0;
		      $parts = $this->parts;
			  $table->increments('id');
			  $table->integer('p_assessment_id')->unsigned();
			  while($count < count($parts)){

				  $table->string($parts[$count]['slug'])->nullable();
				  $table->text($parts[$count]['slug'].'_'.$count)->nullable();
				  $count++;
				 }
			$table->timestamps();
			$table->foreign('p_assessment_id')->references('id')->on('physical_assessments')
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
        Schema::dropIfExists('hand_simulations');
    }
}
