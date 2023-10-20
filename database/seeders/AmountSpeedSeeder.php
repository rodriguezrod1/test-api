<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AmountSpeed as Table;
use Illuminate\Support\Facades\DB;

class AmountSpeedSeeder extends Seeder
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
            $json = file_get_contents(base_path("database/data/amount_speed.json"));
            $iterar = json_decode($json);
        } catch (\Throwable $th) {
            $iterar = null;
        }

        $insert = [];
        foreach ($iterar->amount_speed ?? []  as $value) {
            $insert[] = [
                "name" => $value->name,
                "country_id" => 239
            ];
        }
        if (!empty($insert))
            Table::insert($insert);
    }
}
