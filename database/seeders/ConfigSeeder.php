<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            [
                'group_name' => 'system',
                'type_name' => 'timezone',
                'name' => 'timezone',
                'description' => 'System Time Zone',
                'value' => 'Africa/Addis_Ababa',
            ],
            [
                'group_name' => 'system',
                'type_name' => 'string',
                'name' => 'domain',
                'description' => 'Web Site Domain',
                'value' => 'exampl.com',
            ],
            [
                'group_name' => 'system',
                'type_name' => 'string',
                'name' => 'support-email',
                'description' => 'Support Email',
                'value' => 'support@example.com',
            ],
            [
                'group_name' => 'system',
                'type_name' => 'string',
                'name' => 'from-email',
                'description' => 'From Email',
                'value' => 'noreply@example.com',
            ],
            [
                'group_name' => 'system',
                'type_name' => 'string',
                'name' => 'error-email',
                'description' => 'Email Error To',
                'value' => 'admin@example.com',
            ],
        ];

        foreach ($configs as $config) {
            Config::create($config);
        }

    }
}
