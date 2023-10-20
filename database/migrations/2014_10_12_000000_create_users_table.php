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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('1=Admin, 2=Banca, 3=Recogedor, 4=Agencia, 5=Cliente')->default(5)->index();
            //$table->foreignId('parish_id')->constrained('parishes')->nullable();
            $table->foreignId('country_id')->constrained('countries')->default(239);
            $table->string('name', 100);
            $table->string('last_name', 100);
            $table->string('identification_card', 20);
            $table->string('phone', 30);
            $table->string('username', 100)->index();
            $table->string('email', 150)->index();
            $table->string('password', 250);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('pass_short', 250);
            $table->boolean('status')->default(1)->index();
            $table->double('balance')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
