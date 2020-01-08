<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectiveLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objectiveLog', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('oid')->comment('oid');
            $table->integer('type')->comment('type');
            $table->text('descbefore')->nullable()->comment('修改前内容');
            $table->text('descafter')->nullable()->comment('修改后内容');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objectiveLog');
    }
}
