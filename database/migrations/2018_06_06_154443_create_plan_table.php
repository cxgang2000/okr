<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan', function (Blueprint $table) {
            $table->increments('id');
            

            $table->string('name')->comment('名称');
            $table->date('startdate')->comment('开始时间');
            $table->date('enddate')->comment('结束时间');
            // $table->integer('organiser_id')->comment('发起人')->default(0);
            // $table->integer('executor_id')->comment('执行人')->default(0);
            $table->text('description')->nullable()->comment('描述');
            $table->float('score', 8, 1)->comment('得分')->default(999);
            $table->dateTime('scoretime')->comment('评分时间');
            $table->tinyInteger('status')->comment('状态，正常 0、删除 1 ')->default(0);

            $table->integer('pid')->comment('上级id')->default(0);


            $table->timestamps();
            
            // $table->index('organiser_id');
            // $table->index('executor_id');
            $table->index('pid');
            
            $table->index('status');
            $table->comment = '计划表';
            
        });

        DB::statement("ALTER TABLE plan AUTO_INCREMENT = 100000000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan');
    }
}
