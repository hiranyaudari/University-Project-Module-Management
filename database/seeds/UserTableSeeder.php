<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
/**
 * Created by PhpStorm.
 * User: pranavaghanan
 * Date: 5/8/15
 * Time: 12:18 PM
 */

class UserTableSeeder extends Seeder{

    public function run()
    {
        Model::unguard();

        User::create([
           'email' => 'ghananisnow@yahoo.com',
           'password' => Hash::make('123'),
//           'role' => 'Student'
        ]);

        User::create([
            'email' => 'sachithr7@gmail.com',
            'password' => Hash::make('123'),
//            'role' => 'Student'
        ]);

        User::create([
            'email' => 'subangan9@gmail.com',
            'password' => Hash::make('123'),
//            'role' => 'Student'
        ]);

        User::create([
            'email' => 'waseemramzy@gmail.com',
            'password' => Hash::make('123'),
//            'role' => 'Student'
        ]);

        User::create([
            'email' => 'makma1969@gmail.com',
            'password' => Hash::make('123'),
//            'role' => 'Student'
        ]);

        User::create([
            'email' => 'johndoe@testt.lk',
            'password' => Hash::make('123'),
//            'role' => 'Panel Member'
        ]);

        User::create([
            'email' => 'mwalker@testt.lk',
            'password' => Hash::make('123'),
//            'role' => 'Panel Member'
        ]);

        User::create([
            'email' => 'janedoe@testt.lk',
            'password' => Hash::make('123'),
//            'role' => 'Panel Member'
        ]);

        User::create([
            'email' => 'aduring@testt.lk',
            'password' => Hash::make('123'),
//            'role' => 'LIC'
        ]);


        User::create([
            'email' => 'vasanthik@testt.lk',
            'password' => Hash::make('123'),
//            'role' => 'HOD'
        ]);

        User::create([
            'email' => 'russela@testt.lk',
            'password' => Hash::make('123'),
//            'role' => 'Panel Member'
        ]);//

//        User::create([
//            'email' => '',
//            'password' => '',
//            'role' => ''
//        ]);
    }
}