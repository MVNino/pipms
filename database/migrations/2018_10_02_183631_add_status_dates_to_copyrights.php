<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusDatesToCopyrights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('copyrights', function (Blueprint $table) {
            // timestamps for copyright status
            $table->dateTime('dtm_to_submit')
                ->nullable();
            $table->dateTime('dtm_on_process')
                ->nullable();
            $table->dateTime('dtm_copyrighted')
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
            $table->dropColumn([
                'dtm_to_submit',
                'dtm_on_process',
                'dtm_copyrighted',
            ]);
        });
    }
}
