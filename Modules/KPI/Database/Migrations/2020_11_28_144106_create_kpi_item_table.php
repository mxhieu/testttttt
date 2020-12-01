<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpiItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_item', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('kpi_form_id');
            $table->bigInteger('kpi_category_id');
            $table->bigInteger('kpi_group_id');
            $table->integer('weight');
            $table->string('content')->nullable();
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
        Schema::dropIfExists('kpi_item');
    }
}
