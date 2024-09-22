<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;


class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory(rand(50, 247))->create()->each(function($user){
            UserProfile::create(['user_id'=>$user->id,'role'=>'student']);
        });
    }

}
