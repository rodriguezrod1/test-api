<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Tickets extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'winner',
        'total_sale',
        'form_payment',
        'serial',
        'state_sale'
    ];


    /**
     * Interact with the Tickets.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function state_sale(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  [
                "Premiado",
                "Pagado",
                "No Premiado",
                "Vencido",
                "Cancelado",
            ][$value - 1],
        );
    }


    protected function form_payment(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  [
                "Efectivo",
                "Prepagado"
            ][$value - 1],
        );
    }
}
