<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_sale_details', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->string('money_min')->default(0);
            $table->string('money_max');
            $table->string('money_real');
            $table->integer('quantity')->unsigned();
            $table->string('total_money_min')->default(0);
            $table->string('total_money_max');
            $table->string('total_money_real');
            $table->bigInteger('created_id');
            $table->bigInteger('updated_id');
            $table->string('available');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_details');
    }
}
