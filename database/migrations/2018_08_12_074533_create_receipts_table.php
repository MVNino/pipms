<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('int_id');
            $table->unsignedInteger('int_applicant_id')
                ->comment('foreign key for applicants');// FK for 'applicants'
            $table->char('char_receipt_code', 16);
            $table->string('str_receipt_image');
            $table->timestamps();

            if (Schema::hasTable('applicants')) {
                $table->foreign('int_applicant_id')
                    ->references('int_id')
                    ->on('applicants')
                    ->onUpdate('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
}
