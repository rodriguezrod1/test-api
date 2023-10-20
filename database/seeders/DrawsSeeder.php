<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Draws as Table;
use Illuminate\Support\Facades\DB;

class DrawsSeeder extends Seeder
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
            $json = file_get_contents(base_path("database/data/draws.json"));
            $iterar = json_decode($json);
        } catch (\Throwable $th) {
            $iterar = null;
        }

        $insert = [];
        foreach ($iterar->draws ?? []  as $value) {
            $insert[] = [
                "roulette_id" => $value->roulettes_id,
                "hours_name" => $value->hour_name,
                "close" => $value->close,
                "order" => $value->orden
            ];
        }
        if (!empty($insert))
            Table::insert($insert);
    }
}
