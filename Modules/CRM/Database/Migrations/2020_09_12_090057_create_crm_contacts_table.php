<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned()->index();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->integer('department_id')->unsigned()->index();
            $table->integer('position_id')->unsigned()->index();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('crm_contacts');
    }
}
