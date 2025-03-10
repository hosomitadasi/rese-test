<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{

    public function run()
    {
        $param = [
            'name' => '寿司',
        ];
        DB::table('genres')->insert($param);

        $param = [
            'name' => '焼肉',
        ];
        DB::table('genres')->insert($param);

        $param = [
            'name' => '居酒屋',
        ];
        DB::table('genres')->insert($param);

        $param = [
            'name' => 'イタリアン',
        ];
        DB::table('genres')->insert($param);

        $param = [
            'name' => 'ラーメン',
        ];
        DB::table('genres')->insert($param);
    }
}
