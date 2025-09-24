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
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('building_id')->index();
            // duplicate owner id for faster scoping and simpler queries
            $table->unsignedBigInteger('house_owner_id')->index();
            $table->string('number')->comment('Flat number or identifier');
            $table->integer('floor')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('building_id')
                ->references('id')->on('buildings')
                ->onDelete('cascade'); // deleting building removes flats

            $table->foreign('house_owner_id')
                ->references('id')->on('users')
                ->onDelete('cascade'); // owner deletion cascades
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flats');
    }
};
