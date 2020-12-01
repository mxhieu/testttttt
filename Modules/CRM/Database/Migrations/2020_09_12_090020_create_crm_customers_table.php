<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_customers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 60)->index();
            $table->string('logo')->nullable();
            $table->string('name');
            $table->string('tax_id');
            $table->string('address');
            $table->integer('market_id')->unsigned()->index();
            $table->string('email', 80);
            $table->string('phone', 20);
            $table->string('website')->nullable();
            $table->date('find_at')->nullable();
            $table->integer('kind_id')->unsigned()->index();
            $table->integer('group_id')->unsigned()->index();
            $table->integer('type_id')->unsigned()->index();
            $table->integer('channel_id')->unsigned()->index();
            $table->integer('relation_id')->unsigned()->index();
            $table->integer('employee_id')->index();
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('crm_customers');
    }
}
