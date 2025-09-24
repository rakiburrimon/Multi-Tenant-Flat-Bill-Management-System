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
         Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('house_owner_id')->index();
            $table->unsignedBigInteger('flat_id')->index();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('lease_start')->nullable();
            $table->date('lease_end')->nullable();
            $table->timestamps();

            $table->foreign('house_owner_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('flat_id')
                ->references('id')->on('flats')
                ->onDelete('cascade'); // if flat removed, tenant record removed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
