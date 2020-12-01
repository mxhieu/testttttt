<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_sales', function (Blueprint $table) {
            $table->id();
            $table->string('code', 60);
            $table->string('name');
            $table->bigInteger('customer_id')->unsigned()->index();
            $table->integer('status_id')->unsigned()->index();
            $table->integer('kind_id')->unsigned()->index();
            $table->date('start_at');
            $table->date('end_at');
            $table->string('total_money')->default(0);
            $table->string('final_money')->default(0);
            $table->string('money_up')->default(0);
            $table->string('money_down')->default(0);
            $table->string('vat', 10)->default(0);
            $table->string('discount', 10)->default(0);
            $table->mediumText('description')->nullable();
            $table->integer('approved_id')->unsigned()->index();
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
        Schema::dropIfExists('crm_sales');
    }
}
