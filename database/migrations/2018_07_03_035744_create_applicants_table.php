<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('int_id');
            $table->unsignedInteger('int_department_id')
                ->comment('foreign key for departments')->nullable();
            $table->string('str_first_name');
            $table->string('str_middle_name')
                ->nullable();
            $table->string('str_last_name');
            $table->char('char_gender', 1); // M-Male; F-Female
            $table->date('dtm_birthdate');
            $table->char('char_applicant_type', 16);
            $table->string('str_home_address')->nullable();
            $table->string('str_email_address')
                ->unique();
            $table->bigInteger('bigInt_cellphone_number')
                ->nullable();
            $table->mediumInteger('mdmInt_telephone_number')
                ->nullable();
            $table->string('str_application_token')
                ->comment('For application request')
                ->nullable();

            // Assign foreign key for 'departments' table
            if (Schema::hasTable('departments')) {
                $table->foreign('int_department_id')
                    ->references('int_id')
                    ->on('departments')
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
        Schema::dropIfExists('applicants');
    }
}
