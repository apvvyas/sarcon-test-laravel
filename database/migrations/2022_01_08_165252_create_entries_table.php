<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('organiser_name');
            $table->string('organiser_post');
            $table->string('organiser_company');
            $table->string('organiser_photo');
            $table->boolean('activate_join_as_audience');
            $table->boolean('activate_join_as_speaker');
            $table->boolean('activate_add_to_my_schedule');
            $table->boolean('activate_add_to_calendar');
            $table->integer('rating');
            $table->string('event_time');
            $table->string('event_timezone');
            
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
        Schema::dropIfExists('entries');
    }
}
