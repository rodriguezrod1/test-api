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
        Schema::create('ticket_offices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agencies_id')->constrained('agencies');
            $table->foreignId('users_id')->constrained('users');
            $table->string('name', 200);
            $table->double('box')->default(0);
            $table->float('percentaje');
            $table->boolean('virtual_ticket')->default(0);
            $table->ipAddress('ip')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_offices');
    }
};
