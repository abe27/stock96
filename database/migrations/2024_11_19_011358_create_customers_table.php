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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('address_1')->nullable();
            $table->longText('address_2')->nullable();
            $table->string('mobile_bo')->nullable();
            $table->string('messenger_id')->nullable();
            $table->string('line_id')->nullable();
            $table->string('avatar')->nullable();
            $table->decimal('vat', 8, 2)->nullable()->default(0.0);
            $table->boolean('is_active')->nullable()->default(true);
            $table->enum('color', ['info', 'success', 'primary', 'danger', 'warning'])->nullable()->default('danger');
            $table->foreignUuid('owner_id')->nullable()->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
