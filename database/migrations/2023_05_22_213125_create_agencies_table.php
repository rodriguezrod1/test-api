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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bankings_id')->constrained('bankings');
            $table->foreignId('users_id')->constrained('users');
            $table->string('name', 200);
            $table->string('address', 250)->nullable();
            $table->double('minimum_sales', 20);
            $table->double('limit_sales', 30);
            $table->double('percentaje');
            $table->boolean('virtual')->default(0);
            $table->double('box')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
