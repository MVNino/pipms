<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('int_id');
            $table->string('str_branch_name');
            $table->string('str_branch_address');
            $table->mediumText('mdmTxt_branch_description');
            $table->string('str_branch_profile_image')
                ->default('default_branch_profile_image.png');
            $table->string('str_branch_banner_image')
                ->default('default_branch_banner_image.png');
            $table->string('str_branch_contact_link')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
