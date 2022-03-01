<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeoffice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeoffice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->comment("Home Office request user id");
            $table->string("ho_description")->comment("Home Office description");
            $table->date("ho_starting_date")->comment("Home Office starting date");
            $table->date("ho_ending_date")->nullable()->comment("Home Office ending date");
            $table->integer("ho_days")->comment('Home Office days');
            $table->string("ho_status")->comment("Home Office status");
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homeoffice');
    }
}
