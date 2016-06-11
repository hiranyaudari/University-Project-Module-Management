<?php
use App\FreeSlots;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: pranavaghanan
 * Date: 5/11/15
 * Time: 1:26 PM
 */


class FreeSlotsTableSeeder extends Seeder {

    public function run()
    {
        Model::unguard();

        FreeSlots::create([
           'memberId' => 1,
           'freeDay' => '2015-11-11',
           'startingHour' => 8,
           'startingMin' => 15,
           'endingHour' => 12,
           'endingMin' => 30
       ]);

       FreeSlots::create([
           'memberId' => 1,
           'freeDay' => '2015-11-12',
           'startingHour' => 14,
           'startingMin' => 00,
           'endingHour' => 17,
           'endingMin' => 30
       ]);

       FreeSlots::create([
           'memberId' => 2,
           'freeDay' => '2015-11-11',
           'startingHour' => 8,
           'startingMin' => 45,
           'endingHour' => 13,
           'endingMin' => 30
       ]);

       FreeSlots::create([
           'memberId' => 3,
           'freeDay' => '2015-11-10',
           'startingHour' => 12,
           'startingMin' => 30,
           'endingHour' => 18,
           'endingMin' => 00
       ]);

       FreeSlots::create([
           'memberId' => 3,
           'freeDay' => '2015-11-12',
           'startingHour' => 14,
           'startingMin' => 30,
           'endingHour' => 17,
           'endingMin' => 00
       ]);

       FreeSlots::create([
           'memberId' => 3,
           'freeDay' => '2015-11-11',
           'startingHour' => 8,
           'startingMin' => 30,
           'endingHour' => 15,
           'endingMin' => 00
       ]);
    }

}