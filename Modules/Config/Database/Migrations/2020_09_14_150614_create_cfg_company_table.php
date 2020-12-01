<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfgCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfg_company', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('logo')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('branch')->nullable();
            $table->string('address')->nullable();
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('remark')->nullable();
            $table->bigInteger('created_id');
            $table->bigInteger('updated_id')->nullable();
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
        Schema::dropIfExists('cfg_company');
    }
}
