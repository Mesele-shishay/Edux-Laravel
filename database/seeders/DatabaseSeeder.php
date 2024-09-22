<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ConfigSeeder;
use Database\Seeders\ConfigGroupsSeeddr;
use Database\Seeders\AcademicSettingSeeder;
use Database\Seeders\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ConfigSeeder::class);
        $this->call(ConfigGroupsSeeder::class);
        $this->call(ConfigTypesSeeder::class);
        $this->call(AcademicSettingSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
