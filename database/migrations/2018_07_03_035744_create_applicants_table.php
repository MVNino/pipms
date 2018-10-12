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
                ->comment('foreign key for departments')
                ->nullable();
            $table->unsignedInteger('int_user_id')
                ->comment('foreign key for users')
                ->nullable();
            $table->char('char_gender', 1); // M-Male; F-Female
            $table->date('dtm_birthdate');
            $table->char('char_applicant_type', 16);
            $table->string('str_home_address')
                ->nullable();
            $table->string('bigInt_cellphone_number', 30)
                ->nullable();
            $table->string('mdmInt_telephone_number', 30)
                ->nullable();
    
            // Assign foreign key for 'users' table
            if (Schema::hasTable('users')) {
                $table->foreign('int_user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade');
            }

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
