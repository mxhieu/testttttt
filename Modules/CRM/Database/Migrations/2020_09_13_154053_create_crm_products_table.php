<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_products', function (Blueprint $table) {
            $table->id();
            $table->jsonb('images');
            $table->jsonb('files');
            $table->string('name');
            $table->string('code', 60);
            $table->integer('type_id')->unsigned()->index();
            $table->integer('kind_id')->unsigned()->index();
            $table->integer('group_id')->unsigned()->index();
            $table->integer('color_id')->unsigned()->index();
            $table->string('sold')->default(0);
            $table->string('totalQuantity');
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
        Schema::dropIfExists('crm_products');
    }
}
