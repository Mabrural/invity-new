<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('favicon')->nullable();
            $table->string('event_name');
            $table->string('event_photo_1')->nullable();
            $table->string('event_photo_2')->nullable();
            $table->string('event_photo_3')->nullable();
            $table->date('event_date');
            $table->string('venue')->nullable();
            $table->string('event_time')->nullable();
            $table->string('event_time_2')->nullable();
            $table->string('link_googlemaps')->nullable();
            $table->string('dresscode')->nullable();
            $table->string('no_wa_confirmation')->nullable();
            $table->text('other_information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
