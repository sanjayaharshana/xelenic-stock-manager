<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Products',
                'icon' => 'icon-cube',
                'uri' => 'products',
                'permission' => null,
                'created_at' => null,
                'updated_at' => '2024-03-02 04:43:58',
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Salesmen',
                'icon' => 'icon-user-friends',
                'uri' => 'salesmen',
                'permission' => null,
                'created_at' => null,
                'updated_at' => '2024-03-02 04:43:58',
            ],
            [
                'parent_id' => 0,
                'order' => 3,
                'title' => 'Suppliers',
                'icon' => 'icon-building',
                'uri' => 'suppliers',
                'permission' => null,
                'created_at' => null,
                'updated_at' => '2024-03-02 04:43:58',
            ]


        ];

        DB::table('admin_menu')->insert($data);
    }
}
