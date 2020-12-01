<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned()->index();
            $table->integer('sale_id')->unsigned()->index();
            $table->integer('status_id')->unsigned()->index();
            $table->integer('payment_type_id')->unsigned()->index();
            $table->string('money');
            $table->string('note')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('crm_payments');
    }
}
