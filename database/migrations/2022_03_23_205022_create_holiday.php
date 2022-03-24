<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoliday extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday', function (Blueprint $table) {
            $table->id();
            $table->text('title')->comment("Holiday Title");
            $table->integer('days')->comment("Number of days");
            $table->date('start_date')->comment("Start Date");
            $table->date('end_date')->comment("End Date")->nullable();
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
        Schema::dropIfExists('holiday');
    }
}
