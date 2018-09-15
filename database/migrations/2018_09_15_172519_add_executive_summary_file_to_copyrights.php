<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExecutiveSummaryFileToCopyrights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('copyrights', function (Blueprint $table) {
            $table->string('str_exec_summary_file')
                ->after('mdmTxt_project_description')
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
            $table->dropColumn('str_exec_summary_file');
        });
    }
}
