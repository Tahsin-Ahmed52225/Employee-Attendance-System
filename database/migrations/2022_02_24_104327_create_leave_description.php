<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_description', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->comment("Leave request user id");
            $table->string("leave_description")->comment("Leave description");
            $table->date("leave_starting_date")->comment("Leave starting date");
            $table->date("leave_ending_date")->nullable()->comment("Leave ending date");
            $table->integer("leave_days")->comment('Leave days');
            $table->string("leave_status")->comment("Leave status");
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
        Schema::dropIfExists('leave_description');
    }
}
