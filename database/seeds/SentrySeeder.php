<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
/**
 * registerAndActivated by PhpStorm.
 * User: pranavaghanan
 * Date: 5/8/15
 * Time: 12:18 PM
 */

class SentrySeeder extends Seeder{

    public function run()
    {
        Model::unguard();

        $studentRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Students',
            'slug' => 'students',
        ]);

        $panelMemberRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Panel Member',
            'slug' => 'panelmembers',
        ]);

        $rpcRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'RPC',
            'slug' => 'rpc',
        ]);

        //creating the users
        //students
        $user = Sentinel::registerAndActivate([
           'email' => 'ghananisnow@yahoo.com',
           'password' => '123',
//           'role' => 'Student'
        ]);
        $studentRole->users()->attach($user);

        $user = Sentinel::registerAndActivate([
            'email' => 'sachithr7@gmail.com',
            'password' => '123',
//            'role' => 'Student'
        ]);
        $studentRole->users()->attach($user);

        $user = Sentinel::registerAndActivate([
            'email' => 'subangan9@gmail.com',
            'password' => '123',
//            'role' => 'Student'
        ]);
        $studentRole->users()->attach($user);

        $user = Sentinel::registerAndActivate([
            'email' => 'waseemramzy@gmail.com',
            'password' => '123',
//            'role' => 'Student'
        ]);
        $studentRole->users()->attach($user);

        $user = Sentinel::registerAndActivate([
            'email' => 'makma1969@gmail.com',
            'password' => '123',
//            'role' => 'Student'
        ]);
        $studentRole->users()->attach($user);

        //panel members
        $user = Sentinel::registerAndActivate([
            'email' => 'johndoe@testt.lk',
            'password' => '123',
//            'role' => 'Panel Member'
        ]);
        $panelMemberRole->users()->attach($user);

        $user = Sentinel::registerAndActivate([
            'email' => 'mwalker@testt.lk',
            'password' => '123',
//            'role' => 'Panel Member'
        ]);
        $panelMemberRole->users()->attach($user);

        $user = Sentinel::registerAndActivate([
            'email' => 'janedoe@testt.lk',
            'password' => '123',
//            'role' => 'Panel Member'
        ]);
        $panelMemberRole->users()->attach($user);

        $user = Sentinel::registerAndActivate([
            'email' => 'aduring@testt.lk',
            'password' => '123',
//            'role' => 'RPC'
        ]);
        $panelMemberRole->users()->attach($user);

        $user = Sentinel::registerAndActivate([
            'email' => 'russela@testt.lk',
            'password' => '123',
//            'role' => 'Panel Member'
        ]);
        $panelMemberRole->users()->attach($user);


        //RPC
        $user = Sentinel::registerAndActivate([
            'email' => 'vasanthik@testt.lk',
            'password' => '123',
//            'role' => 'Panel Member'
        ]);
        $rpcRole->users()->attach($user);

    }
}

//        User::registerAndActivate([
//            'email' => '',
//            'password' => '',
//            'role' => ''
//        ]);