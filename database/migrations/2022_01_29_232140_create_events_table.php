<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id')->unique();
            $table->text('event_name');
            $table->dateTime('start_at', $precision = 0);
            $table->dateTime('end_at', $precision = 0);
            $table->longText('event_desc');
            $table->foreignId('user_id');
            $table->foreignId('unit_id');
            $table->float('budget', 12, 2)->nullable();
            $table->string('image');
            $table->string('pdf');
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
        Schema::dropIfExists('events');
    }
}
