<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeyCfgApprove extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cfg_approve', function (Blueprint $table) {
            $table->string('key')->after('name');
            $table->string('color')->after('key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cfg_approve', function (Blueprint $table) {
            $table->dropColumn('key');
            $table->dropColumn('color');
        });
    }
}
