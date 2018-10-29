<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimerAttribsToCopyrights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('copyrights', function (Blueprint $table) {
            $table->dateTime('dtm_start')
                ->after('dtm_schedule')
                ->nullable();
            $table->dateTime('dtm_end')
                ->after('dtm_start')
                ->nullable();
            $table->unsignedInteger('int_duration')
                ->after('dtm_end')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('copyrights', function (Blueprint $table) {
            $table->dropColumn(['dtm_start', 
                'dtm_end', 
                'int_duration']);
        });
    }
}
