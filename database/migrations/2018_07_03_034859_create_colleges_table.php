<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->increments('int_id');
            $table->unsignedInteger('int_branch_id')
                ->comment('foreign key for branches');
            $table->char('char_college_code', 9);
            $table->string('str_college_name');
            $table->mediumText('mdmTxt_college_description');
            $table->string('str_college_profile_image')
                ->default('default_college_profile_image.png');
            $table->string('str_college_banner_image')
                ->default('default_college_banner_image.png');
            $table->string('str_college_contact_link')
                ->nullable();
            $table->timestamps();

            // Assign foreign key for 'branches' table
            if (Schema::hasTable('branches')) {
                $table->foreign('int_branch_id')
                    ->references('int_id')
                    ->on('branches')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
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
        Schema::dropIfExists('colleges');
    }
}
