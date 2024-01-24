<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Role;
use App\Models\User;
use DivisionArray;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use SubdivisionArray;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            "name" => "Admin",
            "email" => "admin@filament.test",
            "password" => Hash::make("qwerty"),
        ]);
    }
}
