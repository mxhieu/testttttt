<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsTaskProccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_task_proccess', function (Blueprint $table) {
            $table->id();
            $table->string('summary');
            $table->bigInteger('task_id');
            $table->bigInteger('task_process_status');
            $table->bigInteger('complete');
            $table->text('content');
            $table->string('attach_file')->nullable();
            $table->bigInteger('created_id');
            $table->bigInteger('updated_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tms_task_proccess');
    }
}
