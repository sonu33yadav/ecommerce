<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('member_id')->nullable();
            $table->string('login_type',20)->nullable();
            $table->string('facebook_id')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender',10)->default('M');
            $table->tinyInteger('race_id')->nullable();
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('postcode')->nullable();
            $table->string('state')->nullable();
            $table->integer('country_id')->nullable();
            $table->tinyInteger('manage_status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
