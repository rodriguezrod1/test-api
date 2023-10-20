<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roulettes as Table;
use Illuminate\Support\Facades\DB;

class RoulettesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Table::truncate();
        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        try {
            $json = file_get_contents(base_path("database/data/roulettes.json"));
            $iterar = json_decode($json);
        } catch (\Throwable $th) {
            $iterar = null;
        }

        $insert = [];
        foreach ($iterar->roulettes ?? []  as $value) {
            $insert[] = [
                "id" => $value->id,
                "country_id" => 239,
                "name" => $value->name,
                "payment" => $value->payment,
                "short_name" => $value->name_corto,
                "twitter_route" => $value->ruta_twitter
            ];
        }
        if (!empty($insert))
            Table::insert($insert);
    }
}
