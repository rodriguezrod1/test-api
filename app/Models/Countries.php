<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone_code',
        'iso3',
        'currency',
        'currency_symbol',
        'emoji',
        'emojiU',
    ];


    public function User()
    {
        return $this->hasMany(User::class);
    }
}
