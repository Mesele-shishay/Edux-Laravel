<?php

namespace App\Livewire;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Hash;


use Livewire\Component;
use App\Http\Controllers\Auth\UpdatePasswordController;

class ChangePassword extends Component
{
    #[rule('required')]
    public $oldPassword;

    #[rule('required|min:6')]
    public $newPassword;

    #[rule('required|min:6|same:newPassword')]
    public $newPassword2;




    public function change()
    {
        $request = $this->all();

        if (Hash::check($request['oldPassword'], auth()->user()->password)) {
            // The passwords match...
            try{
                $this->userRepository->changePassword($request['newPassword']);
                session()->flash('status','Changing password was successful!');

            } catch (\Exception $e) {
                session()->flash('status',$e->getMessage());
            }
        } else {
            session()->flash('status','Incorrect password!');
        }
    }
}
