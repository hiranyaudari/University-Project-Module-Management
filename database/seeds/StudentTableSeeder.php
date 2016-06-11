<?php

use App\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: pranavaghanan
 * Date: 5/8/15
 * Time: 12:18 PM
 */

class StudentTableSeeder extends Seeder{

    public function run()
    {
        Model::unguard();

        Student::create([
            'regId' => 'IT13119904',
            'name' => 'M.Pranavaghanan',
            'phone' => '0772267026',
            'email' => 'ghananisnow@yahoo.com',
            'courseField' => 'IT',
            'username' => 'ghanan2000',
            'attempt' => 1
        ]);

        Student::create([
            'regId' => 'IT13113728',
            'name' => 'Rangana K.S.',
            'phone' => '0711365458',
            'email' => 'sachithr7@gmail.com',
            'courseField' => 'IT',
            'username' => 'sachithr7',
            'attempt' => 1
        ]);

        Student::create([
            'regId' => 'IT13118914',
            'name' => 'Subangan B.',
            'phone' => '0773569854',
            'email' => 'subangan9@gmail.com',
            'courseField' => 'CS',
            'username' => 'subanganb',
            'attempt' => 1
        ]);

        Student::create([
            'regId' => 'IT13118846',
            'name' => 'Waseem R.',
            'phone' => '0774105826',
            'email' => 'waseemramzy@gmail.com',
            'courseField' => 'IM',
            'username' => 'waseemr',
            'attempt' => 2
        ]);

        Student::create([
            'regId' => 'IT13117238',
            'name' => 'Kaashiff A.',
            'phone' => '0771690127',
            'email' => 'makma1969@gmail.com',
            'courseField' => 'CS',
            'username' => 'kaashiff',
            'attempt' => 2
        ]);
    }
}