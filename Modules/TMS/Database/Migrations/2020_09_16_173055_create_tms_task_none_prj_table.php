<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsTaskNonePrjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_task_none_prj', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->bigInteger('department_id');
            $table->bigInteger('assign_user_id');
            $table->timestamp('start_at', 0);
            $table->timestamp('end_at', 0);
            $table->bigInteger('task_category_id');
            $table->bigInteger('task_type_id');
            $table->bigInteger('task_group_id');
            $table->bigInteger('task_priority_id');
            $table->bigInteger('task_phrase_id');
            $table->bigInteger('status_id');
            $table->string('content');
            $table->string('attach_file')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('tms_task_none_prj');
    }
}
