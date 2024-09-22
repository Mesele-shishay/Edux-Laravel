<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Str;



if (! function_exists('alreadyInstalled')) {
    /**
     * If application is already installed.
     *
     * @return bool
     */
    function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }
}

if (! function_exists('course_icon')) {

    function course_icon($course='')
    {
        $icons = [
            'tigrigna' => [
                'icon' => 'book',
                'color' => 'info'
            ],
            'amharic' => [
                'icon' => 'book',
                'color' => 'dark'
            ],
            'english' => [
                'icon' => 'language',
                'color' => 'primary'
            ],
            'maths' => [
                'icon' => 'superscript',
                'color' => 'danger'
            ],
            'physics' => [
                'icon' => 'balance-scale',
                'color' => 'warning'
            ],
            'biology' => [
                'icon' => 'stethoscope',
                'color' => 'readpink'
            ],
            'civic' => [
                'icon' => 'democrat',
                'color' => 'dark-slate-gray'
            ],
            'chemistry' => [
                'icon' => ' fa-prescription-bottle',
                'color' => 'orange-red'
            ],
            'ict' => [
                'icon' => 'desktop',
                'color' => 'success'
            ],
            'td' => [
                'icon' => 'paint-brush',
                'color' => 'violet'
            ],
            'hpe' => [
                'icon' => 'football-ball',
                'color' => 'coral'
            ],
            'bussines' => [
                'icon' => 'chart-bar',
                'color' => 'plum'
            ],
            'economics' => [
                'icon' => 'money-bill-alt',
                'color' => 'sandy-brown'
            ],
            'geography' => [
                'icon' => 'search-location',
                'color' => 'purple'
            ],
            'history' => [
                'icon' => 'history',
                'color' => 'sienna'
            ],
        ];

        $data = [
            'icon' => 'book',
            'color' => Arr::random($icons)['color'],
        ];


        foreach ($icons as $key => $value) {
            if (stripos($key,explode(' ',strtolower($course))[0]) !== False) {
                $data = [
                    'icon' => $value['icon'],
                    'color' => $value['color'],
                ];
                return $data;
            }
        }
        return $data;

    }
}


if (! function_exists('title')) {
    /**
     * Get current page title
     *
     * @return bool
     */
    function title()
    {
        $app_name = Str::ucfirst(config('app.name', 'Laravel'));
        $page_name = Arr::get(request()->segments(),1);
        if ($page_name) {
            return $app_name . ' - ' . Str::ucfirst($page_name);
        }
        return $app_name;
    }
}

if (! function_exists('getDayName')) {
    /**
     * Get day name
     *
     * @return string
     */
    function getDayName($weekday) {
        if($weekday == 1) {
            return "MONDAY";
        } else if($weekday == 2) {
            return "TUESDAY";
        } else if($weekday == 3) {
            return "WEDNESDAY";
        } else if($weekday == 4) {
            return "THURSDAY";
        } else if($weekday == 5) {
            return "FRIDAY";
        } else if($weekday == 6) {
            return "SATURDAY";
        } else if($weekday == 7) {
            return "SUNDAY";
        } else {
            return "Noday";
        }
    }
}

