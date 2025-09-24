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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();

            // owner, flat and tenant for scoping & relationship
            $table->unsignedBigInteger('house_owner_id')->index();
            $table->unsignedBigInteger('flat_id')->index();
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->unsignedBigInteger('category_id')->index();

            $table->decimal('amount', 12, 2);
            $table->date('due_date')->nullable();
            $table->enum('status', ['unpaid', 'paid', 'overdue'])->default('unpaid')->index();
            $table->timestamp('paid_at')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('house_owner_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('flat_id')
                ->references('id')->on('flats')
                ->onDelete('cascade');

            $table->foreign('tenant_id')
                ->references('id')->on('tenants')
                ->onDelete('set null'); // keep bill if tenant removed, but clear tenant_id

            $table->foreign('category_id')
                ->references('id')->on('bill_categories')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
