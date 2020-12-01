<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned()->index();
            $table->integer('sale_id')->unsigned()->index();
            $table->integer('status_id')->unsigned()->index();
            $table->string('address');
            $table->string('note')->nullable();
            $table->date('date')->nullable();
            $table->bigInteger('created_id');
            $table->bigInteger('updated_id');
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
        Schema::dropIfExists('crm_deliveries');
    }
}
