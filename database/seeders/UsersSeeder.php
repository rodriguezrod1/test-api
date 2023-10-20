<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        try {
            $json = file_get_contents(base_path("database/data/users.json"));
            $users = json_decode($json);
        } catch (\Throwable $th) {
            $users = null;
        }

        $insert = [];
        foreach ($users->users ?? []  as $value) {
            $insert[] = [
                "type" => $value->type_id,
                "country_id" => 239,
                "name" => $value->name,
                "last_name" => $value->last_name,
                "identification_card" => $value->cedula,
                "phone" => $value->phone,
                "username" => $value->usuario,
                "email" => $value->email,
                "password" => Hash::make('12345678'),
                "pass_short" => Hash::make('1234')
            ];
        }
        if (!empty($insert))
            User::insert($insert);
    }
}
