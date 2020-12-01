<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmProductpropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_product_properties', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->unsigned()->index();
            $table->string('type')->default('amount');
            $table->string('min')->default(0);
            $table->string('max')->default(1);
            $table->integer('unit_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_product_properties');
    }
}
