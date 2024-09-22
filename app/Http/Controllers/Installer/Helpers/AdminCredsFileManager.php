<?php

namespace App\Http\Controllers\Installer\Helpers;

class AdminCredsFileManager
{
    /**
     * Create admin creds file.
     *
     * @return int
     */
    public function create($adminCredes)
    {
        $adminCredsLogFile = storage_path('admin_creds');

        $dateStamp = date('Y/m/d h:i:sa');

        if (! file_exists($adminCredsLogFile)) {

            file_put_contents($adminCredsLogFile, json_encode($adminCredes,true));
        } else {

            file_put_contents($adminCredsLogFile, json_encode($adminCredes,true));
        }

        return $adminCredes;
    }

    public function getCreds()
    {
        return json_decode(file_get_contents(storage_path('admin_creds')));
    }

    public function clearCreds()
    {
        $adminCredsLogFile = storage_path('admin_creds');

        if (file_exists($adminCredsLogFile)) {
            return unlink(storage_path('admin_creds'));
        }
    }
}
