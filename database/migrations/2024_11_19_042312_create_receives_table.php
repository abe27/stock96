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
        Schema::create('receives', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no')->unique();
            $table->string('tax_no')->nullable();
            $table->foreignUuid('supplier_id')->unsigned()->constrained();
            $table->date('received_on')->nullable()->default(Carbon::now());
            $table->integer('qty')->nullable()->default(0);
            $table->decimal('cost_price', 10, 2)->nullable()->default(0);
            $table->foreignUuid('receive_by_id')->references('id')->on('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receives');
    }
};
