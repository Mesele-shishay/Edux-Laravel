<?php 
namespace App\Http\controllers;

use App\Models\Config;
use App\Traits\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SystemSettingsController extends Controller
{
	use UserProfile;

    /***
     * System Settings page
     * */
    public function index(Request $request, Response $response)
    {
        // get the current user
        $user = auth()->user();

        // get the current user profile in array form
        $settings = $this->userProfile($user);
        // dd($user);

        return view('system.settings',$settings);
    }

    /***
     * System edit setting
     * */
    public function edit(Request $request)
    {
        $output = new \stdClass;
        $output->status = "error";
        $output->message = "An unknown error occurred.";

        $settingName = $request->configName;
        $settingValue = $request->configValue;


        $checkConfig = Config::where('name', $settingName)->first();

        if (!$checkConfig) {
            $output->message = "Setting not found.";
            return response()->json(json_decode(json_encode($output)));
        }

        if ($checkConfig->update(['value'=>$settingValue])) {
            $output->status = "success";
            $output->message = "Setting is saved.";
            return response()->json(json_decode(json_encode($output)));
        }

        return response()->json(json_decode(json_encode($output)));
    }

}
