<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objective', function (Blueprint $table) {
            $table->increments('id');
            

            $table->string('name')->comment('名称');
            $table->date('startdate')->comment('开始时间');
            $table->date('enddate')->comment('结束时间');
            $table->integer('organiser_id')->comment('发起人')->default(0);
            $table->integer('executor_id')->comment('执行人')->default(0);
            $table->text('description')->nullable()->comment('描述');
            $table->float('score', 8, 1)->comment('得分')->default(999);
            $table->dateTime('scoretime')->comment('评分时间')->nullable($value = true);
            $table->tinyInteger('status')->comment('状态，正常 0、删除 1 ')->default(0);


            $table->timestamps();

            $table->index('organiser_id');
            $table->index('executor_id');
            $table->index('status');
            $table->comment = '目标表';
            
        });

        // DB::statement("ALTER TABLE object AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objective');
    }
}
