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
        Schema::create('receive_lines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('receive_id')->unsigned()->constrained();
            $table->foreignUuid('product_id')->unsigned()->constrained();
            $table->foreignUuid('unit_id')->unsigned()->constrained();
            $table->integer('qty')->default(0);
            $table->decimal('cost_price', 10, 2)->nullable()->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receive_lines');
    }
};
