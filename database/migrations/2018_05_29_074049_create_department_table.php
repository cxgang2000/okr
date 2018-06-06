<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 
	 
	 /*
	 *
	 *public function up()
		{
			Schema::table('article_list', function (Blueprint $table) {
				//
				$table->string('keywords')->nullable()->after('keyword')->comment('关键词文本,以逗号隔开')->default('');
				$table->string('mykind')->nullable()->after('kind')->comment('个人分类字符串')->default('');
	
			});
		}
	 *
	 *
	 */
	 
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->comment('名称');
			$table->integer('pid')->comment('父部门id')->default(0);
			$table->tinyInteger('status')->comment('状态，启用 0、停用 1 删除 2')->default(0);
            $table->timestamps();
			
			$table->index('pid');
			$table->index('status');
			$table->comment = '部门表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department');
    }
}
