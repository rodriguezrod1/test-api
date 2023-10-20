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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('products_id')->constrained('products');
            $table->foreignId('tickets_id')->constrained('tickets');
            $table->foreignId('draws_id')->constrained('draws');
            $table->double('amount');
            $table->boolean('prize')->default(0)->index();
            $table->double('profit')->default(0);
            $table->boolean('status')->default(0)->comment('paid or not paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
