<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConfigTypes;

class ConfigTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config_types = [

            [
                'name' => 'timezone',
            ],

            [
                'name' => 'string',
            ],

            [
                'name' => 'boolean',
            ],
        ];

        foreach ($config_types as $config_type) {
            ConfigTypes::create($config_type);
        }
    }
}
