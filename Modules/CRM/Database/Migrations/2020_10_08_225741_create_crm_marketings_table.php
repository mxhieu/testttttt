<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmMarketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_marketings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->mediumText('remark')->nullable();
            $table->jsonb('files')->nullable();
            $table->date('start_at');
            $table->date('end_at');
            $table->integer('user_group_id')->unsigned()->index();
            $table->integer('in_charge_id')->unsigned()->index();
            $table->integer('kind_id')->unsigned()->index();
            $table->integer('type_id')->unsigned()->index();
            $table->integer('group_id')->unsigned()->index();
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
        Schema::dropIfExists('crm_marketings');
    }
}
