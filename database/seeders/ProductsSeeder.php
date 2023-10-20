<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products as Table;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
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
            $json = file_get_contents(base_path("database/data/products.json"));
            $iterar = json_decode($json);
        } catch (\Throwable $th) {
            $iterar = null;
        }

        $insert = [];
        foreach ($iterar->products ?? []  as $value) {
            $insert[] = [
                "roulette_id" => $value->roulettes_id,
                "name" => $value->name,
                "number" => $value->number,
                "path_photo" => $value->foto,
                "color" => $value->color
            ];
        }
        if (!empty($insert))
            Table::insert($insert);
    }
}
