<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountRequestStatusToAuthorAccountRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('author_account_requests', function (Blueprint $table) {
            $table->char('char_request_status', 12)
                ->after('str_email')
                ->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('author_account_requests', function (Blueprint $table) {
            $table->dropColumn('char_request_status');
        });
    }
}
