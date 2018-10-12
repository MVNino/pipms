<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopyrightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copyrights', function (Blueprint $table) {
            $table->increments('int_id');
            $table->unsignedInteger('int_user_id')
                ->comment('foreign key for users')
                ->nullable(); // temporarily, attribute is nullable
            $table->unsignedInteger('int_applicant_id')
                ->comment('foreign key for applicants');
            $table->unsignedInteger('int_project_type_id')
                ->comment('foreign key for project_types');
            $table->unsignedInteger('int_project_id')->nullable();
            $table->string('str_custom_project')->nullable();
            $table->string('str_project_title');
            $table->mediumText('mdmTxt_project_description')
                ->nullable();
            $table->string('str_exec_summary_file')->nullable();    
            $table->char('char_copyright_status')
                ->default('pending');
            $table->dateTime('dtm_schedule')
                ->nullable();
            $table->timestamps();

            // Assign foreign key for 'users' table
            if (Schema::hasTable('users')) { 
                $table->foreign('int_user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade');
            }
            // Assign foreign key for 'applicants' table
            if (Schema::hasTable('applicants')) {
                $table->foreign('int_applicant_id')
                    ->references('int_id')
                    ->on('applicants')
                    ->onDelete('cascade');
            }
            // Assign foreign key for 'project_types' table
            if (Schema::hasTable('project_types')) {
                $table->foreign('int_project_type_id')
                    ->references('int_id')
                    ->on('project_types')
                    ->onUpdate('cascade');
            }
            // Assign fk for 'projects' table
            if (Schema::hasTable('projects')) {
                $table->foreign('int_project_id')
                    ->references('int_id')
                    ->on('projects');
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
        Schema::dropIfExists('copyrights');
    }
}
