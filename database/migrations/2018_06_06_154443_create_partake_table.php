<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartakeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partake', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('okr_id')->comment('okr_id');
            $table->integer('user_id')->comment('user_id');

            $table->timestamps();
            
            $table->index('okr_id');
            $table->index('user_id');

            // $table->index('status');
            $table->comment = '参与者表';
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partake');
    }
}
