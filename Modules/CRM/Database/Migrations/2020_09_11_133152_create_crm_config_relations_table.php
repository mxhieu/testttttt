<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmConfigRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_config_relations', function (Blueprint $table) {
            $table->id();
            $table->string('color', 20)->nullable();
            $table->string('name');
            $table->string('code', 60)->index();
            $table->tinyInteger('order')->default(0);
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
        Schema::dropIfExists('crm_config_relations');
    }
}
