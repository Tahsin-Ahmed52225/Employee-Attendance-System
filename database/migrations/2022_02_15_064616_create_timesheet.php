<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->commet("User ID");
            $table->dateTime("check_in")->comment("User Check In");
            $table->dateTime("check_out")->comment("User Check Out")->nullable();
            $table->unsignedBigInteger('total_time')->comment("Total Time")->nullable();
            $table->longText('daily_update')->comment("User daily update")->nullable();
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
        Schema::dropIfExists('timesheet');
    }
}
