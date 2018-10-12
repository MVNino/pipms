<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patents', function (Blueprint $table) {
            $table->increments('int_id');            
            $table->unsignedInteger('int_copyright_id')
                ->comment('foreign key for copyrights');
            $table->unsignedInteger('int_project_type_id')
                ->comment('foreign key for project_types');
            $table->unsignedInteger('int_project_id')
                ->comment('foreign key for projects')
                ->nullable();
            $table->string('str_custom_project')->nullable();
            $table->string('str_patent_project_title');
            $table->mediumText('mdmTxt_patent_description');
            $table->string('str_patent_summary_file')
                ->nullable();
            $table->char('char_patent_status')->default('pending');
            $table->dateTime('dtm_schedule')
                ->comment('schedule of actual application')
                ->nullable();
            $table->timestamps();

            // Assign foreign key for 'copyrights' table
            if (Schema::hasTable('copyrights')) {
                $table->foreign('int_copyright_id')
                    ->references('int_id')
                    ->on('copyrights')
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
        Schema::dropIfExists('patents');
    }
}
