<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDtmRescheduleToCopyrights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('copyrights', function (Blueprint $table) {
            $table->dateTime('dtm_reschedule')
                ->after('dtm_schedule')
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
            $table->dropColumn('dtm_reschedule');
        });
    }
}
