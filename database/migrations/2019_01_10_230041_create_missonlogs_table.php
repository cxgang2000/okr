<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missionlogs', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('itemid')->comment('itemid');
            $table->integer('type')->comment('type');
            $table->text('descbefore')->nullable()->comment('修改前内容');
            $table->text('descafter')->nullable()->comment('修改后内容');

            $table->timestamps();

            $table->index('itemid');
            $table->comment = 'mission log表';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missionlogs');
    }
}
