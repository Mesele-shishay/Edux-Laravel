<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;

class UpdatePasswordController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function edit() {
        return view('auth.passwords.edit');
    }

    public function update(Request $request) {
        dd($request->all());

        $validator = Validator::make($request->all(), [
                    'oldPassword' => 'required',
                    'newPassword' => 'required|min:6',
                    'newPassword_confirmation' => 'required|min:6',
                ])->stopOnFirstFailure();

        if ($validator->fails()) {
            return response()->json([
                'status'=>'ajax',
                'data'=>$validator->errors()]);
        }

        $request = $validator->validated();
        if ($request['newPassword'] !== $request['newPassword_confirmation']) {
            return response()->json([
                'status'=>'ajax',
                'data'=>['newPassword_confirmation'=>'Confirmation password missmached!']]);
        }

        if (Hash::check($request['oldPassword'], auth()->user()->password)) {
            // The passwords match...
            try{
                $this->userRepository->changePassword($request['newPassword']);

                return response()->json([
                    'status', 'Changing password was successful!'
                ]);

            } catch (\Exception $e) {
                return response()->json($e->getMessage());
            }
        } else {
            return response()->json([
                'status'=>'ajax',
                'data'=>['oldPassword'=>'Incorrect password!']]);
        }
    }
}
