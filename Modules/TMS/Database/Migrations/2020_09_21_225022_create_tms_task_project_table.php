<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsTaskProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_task_project', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->bigInteger('department_id');
            $table->bigInteger('assign_user_id');
            $table->bigInteger('project_id');
            $table->string('start_at');
            $table->string('end_at');
            $table->string('task_type_id');
            $table->string('task_group_id');
            $table->string('task_priority_id');
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
        Schema::dropIfExists('tms_task_project');
    }
}
