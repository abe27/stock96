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
        Schema::create('stocks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('category_id')->unsigned()->constrained();
            $table->foreignUuid('product_id')->unsigned()->constrained()->cascadeOnDelete();
            $table->foreignUuid('unit_id')->unsigned()->constrained();
            $table->integer('quantity')->nullable()->default(0);
            $table->decimal('price', 10, 2)->nullable()->default(0);
            $table->decimal('cost_price', 10, 2)->nullable()->default(0);
            $table->longText('description')->nullable();
            $table->integer('min_qty')->nullable()->default(0);
            $table->integer('max_qty')->nullable()->default(500);
            $table->integer('safety_stock')->nullable()->default(0);
            $table->foreignUuid('adjust_by_id')->nullable()->references('id')->on('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
