<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfgEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfg_employee', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avartar')->nullable();
            $table->string('email');
            $table->string('country')->nullable();
            $table->string('birthday')->nullable();
            $table->integer('gender')->nullable()->comment = '0: is men, 1: is women, 2: is undefined';
            $table->integer('marital_status')->nullable()->comment = '0: is single, 1: is married, 2: is saparated';
            $table->string('phone')->nullable();
            $table->string('remark')->nullable();
            $table->bigInteger('department_id');
            $table->bigInteger('position_id');
            $table->integer('is_deleted')->default(0);
            $table->bigInteger('created_id');
            $table->bigInteger('updated_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('cfg_employee');
    }
}
