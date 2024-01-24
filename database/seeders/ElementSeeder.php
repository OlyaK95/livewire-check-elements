<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\ModuleType;
use Illuminate\Database\Seeder;

class ElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $element = Element::create([
            "name" => "Element1",
            "quantity" => 1,
        ]);

        $element->module_types()->attach(ModuleType::find(1), [
            "sort" => 1,
            "quantity" => "10",
            "ref_des" => "R1, R2, R3, R4, R5, R6, R7, R8, R9, R10",
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        $element = Element::create([
            "name" => "Element2",
            "quantity" => 1,
        ]);

        $element->module_types()->attach(ModuleType::find(2), [
            "sort" => 1,
            "quantity" => "1",
            "ref_des" => "R3",
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        $element->module_types()->attach(ModuleType::find(1), [
            "sort" => 2,
            "quantity" => "1",
            "ref_des" => "R100",
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}
