<?php

namespace App\Helpers;

use App\Models\ConfigGroups;


/** @SuppressWarnings(PHPMD.StaticAccess) */
class Settings
{
    public function getSettingsFile()
    {
        $settings = require config_path().DIRECTORY_SEPARATOR.'app.php';

        return $settings;
    }

    public function getSettingsByGroup()
    {
        $groups = ConfigGroups::where('name','!=','')->with('config')->get()->unique('name');

        return $groups;
    }


    public function getTimezones()
    {
        $zonesArray = array();
        $timestamp = time();
        foreach (timezone_identifiers_list() as $key => $zone) {
            $zonesArray[$key]['zone'] = $zone;
            $zonesArray[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        return $zonesArray;
    }

    private function getRouteNames()
    {
        $routes = $this->container->router->getRoutes();
        $allRoutes = array();
        foreach ($routes as $route) {
            $allRoutes[] = $route->getName();
        }

        asort($allRoutes);

        return $allRoutes;
    }


}
