<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Countries;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Countries::truncate();
        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        try {
            $json = file_get_contents(base_path("database/data/countries.json"));
            $countries = json_decode($json);
        } catch (\Throwable $th) {
            $countries = null;
        }

        $inserts = [];
        foreach ($countries ?? [] as $value) {
            $inserts[] = [
                "id" => $value->id,
                "name" => $value->name,
                "phone_code" => $value->phone_code,
                "iso3" => $value->iso3,
                "currency" => $value->currency,
                "currency_symbol" => $value->currency_symbol,
                "emoji" => $value->emoji,
                "emojiU" => $value->emojiU,
            ];
        }
        if (!empty($inserts))
            Countries::insert($inserts);
    }
}
