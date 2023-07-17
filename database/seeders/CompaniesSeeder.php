<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('companies')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>null,
                'company_name' =>'メーカーA',
                'street_address' =>'東京都港区123',
                'reprentative_name' =>'田中',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>null,
                'company_name' =>'メーカーB',
                'street_address' =>'東京都港区456',
                'reprentative_name' =>'山田',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>null,
                'company_name' =>'メーカーC',
                'street_address' =>'東京都港区789',
                'reprentative_name' =>'斎藤',
            ],
        ]);
    }
}
