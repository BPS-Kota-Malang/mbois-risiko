<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaDampakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => 'Finansial'],
            ['id' => 2, 'name' => 'Operasional'],
            ['id' => 3, 'name' => 'Reputasi'],
        ];

        foreach ($data as $item) {
            DB::table('area_dampak')->updateOrInsert(
                ['id' => $item['id']], // Condition to check for duplicates
                ['name' => $item['name']] // Data to be updated or inserted
            );
        }
    }
}
