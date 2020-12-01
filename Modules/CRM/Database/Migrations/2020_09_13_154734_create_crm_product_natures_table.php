<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmProductNaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_product_natures', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->unsigned()->index();
            $table->string('width')->default(0);
            $table->string('height')->default(0);
            $table->string('length')->default(0);
            $table->integer('unit_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_product_natures');
    }
}
