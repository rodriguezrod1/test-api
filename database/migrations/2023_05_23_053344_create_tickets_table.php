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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_offices_id')->constrained('ticket_offices');
            $table->foreignId('users_id')->constrained('users');
            $table->tinyInteger('state_sale')->comment('1=Premiado, 2=Pagado, 3=No Premiado, 4=Vencido, 5=Cancelado')->default(3)->index();
            $table->mediumText('number');
            $table->boolean('winner')->default(0)->index();
            $table->double('total_sale')->default(0);
            $table->tinyInteger('form_payment')->comment('1=Efectivo, 2=Prepagado')->default(1)->index();
            $table->mediumText('serial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
