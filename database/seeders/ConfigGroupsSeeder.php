<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ConfigGroups;

class ConfigGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config_groups = [

            [
                'name' => 'system',
                'description' => 'System Settings'
            ]
        ];

        foreach ($config_groups as $config_group) {
            ConfigGroups::create($config_group);
        }
    }
}
