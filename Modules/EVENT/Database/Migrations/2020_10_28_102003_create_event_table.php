<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->bigInteger('group_id');
            $table->bigInteger('assign_user_id');
            $table->timestamp('start_at', 0);
            $table->timestamp('end_at', 0);
            $table->string('cfg_event_category_id');
            $table->string('cfg_event_type_id');
            $table->string('cfg_event_group_id');
            $table->string('cfg_event_priority_id');
            $table->string('status_id');
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
        Schema::dropIfExists('event');
    }
}
