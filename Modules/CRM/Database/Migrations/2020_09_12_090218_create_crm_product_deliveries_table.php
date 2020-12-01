<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmProductDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_product_deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer('delivery_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->integer('sale_id')->unsigned()->index();
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_product_deliveries');
    }
}
