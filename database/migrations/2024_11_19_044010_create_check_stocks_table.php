<?php

use Carbon\Carbon;
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
        Schema::create('check_stocks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no')->unique();
            $table->date('check_date')->nullable()->default(Carbon::now());
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('cost_price', 10, 2);
            $table->longText('description')->nullable();
            $table->foreignUuid('check_by_id')->references('id')->on('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_stocks');
    }
};
