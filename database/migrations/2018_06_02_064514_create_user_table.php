<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->string('phone')->comment('电话');
            $table->string('email')->comment('邮箱');
            $table->string('pwd')->comment('密码');
            $table->integer('position_id')->comment('岗位id')->default(0);
            $table->integer('department_id')->comment('部门id')->default(0);
            $table->tinyInteger('status')->comment('状态，启用 0、停用 1 删除 2')->default(0);
            $table->integer('pid')->comment('上级id')->default(0);
            $table->tinyInteger('isleader')->comment('是否是部门领导，不是 0、是 1')->default(0);
            $table->timestamps();
            
            $table->index('department_id');
            $table->index('status');
            $table->comment = '员工表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
