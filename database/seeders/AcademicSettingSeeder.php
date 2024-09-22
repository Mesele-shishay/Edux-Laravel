<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AcademicSetting;
class AcademicSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [

            [
                'attendance_type' => 'section',
                'marks_submission_status' => 'off',
            ]

        ];

        foreach ($settings as $setting) {
            AcademicSetting::create($setting);
        }
    }
}
