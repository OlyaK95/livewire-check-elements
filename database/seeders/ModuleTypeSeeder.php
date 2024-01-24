<?php

namespace Database\Seeders;

use App\Models\ModuleType;
use Illuminate\Database\Seeder;
use ModuleTypeArray;

class ModuleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (ModuleTypeArray::MODULE_TYPES as $module_type) {
            ModuleType::create([
                "name" => $module_type["name"],
                "designator" => $module_type["designator"],
                "prefix" => $module_type["prefix"],
            ]);
        }
    }
}
