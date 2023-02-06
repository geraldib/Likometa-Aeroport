<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('number');
            $table->integer('nr_persons');
            $table->text('note')->nullable();
            $table->string('st_location');
            $table->string('end_location');
            $table->string('intersection')->nullable();
            $table->string('intersection_end')->nullable();
            $table->string('st_date');
            $table->bigInteger('price');
            $table->string('confirmation');
            $table->integer('confirmed')->default(0);
            $table->foreignId('user_id')->nullable();
            $table->string('st_time');
            $table->string('int_time')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
