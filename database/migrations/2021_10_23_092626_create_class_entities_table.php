<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_entities', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('weekday');
            $table->time('start_time');
            $table->time('finish_time');
            $table->integer('places_available');
            $table->foreignId('template_id')->references('id')->on('class_templates')->cascadeOnDelete();
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
        Schema::dropIfExists('class_entities');
    }
}
