<?php

namespace App\Http\Controllers\Installer;

use Illuminate\Routing\Controller;
use App\Http\Controllers\Installer\Helpers\EnvironmentManager;
use App\Http\Controllers\Installer\Helpers\FinalInstallManager;
use App\Http\Controllers\Installer\Helpers\InstalledFileManager;
use App\Events\LaravelInstallerFinished;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;


class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param \App\Http\Controllers\Installer\Helpers\InstalledFileManager $fileManager
     * @param \App\Http\Controllers\Installer\Helpers\FinalInstallManager $finalInstall
     * @param \App\Http\Controllers\Installer\Helpers\EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(
                    InstalledFileManager $fileManager,
                    FinalInstallManager $finalInstall,
                    EnvironmentManager $environment,
                    )
    {

        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();


        event(new LaravelInstallerFinished);

        return view('installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
