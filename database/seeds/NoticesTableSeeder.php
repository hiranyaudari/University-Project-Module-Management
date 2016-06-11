<?php
use App\Notices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: pranavaghanan
 * Date: 5/8/15
 * Time: 12:21 PM
 */

class NoticesTableSeeder extends Seeder{

    public function run()
    {
        Model::unguard();

        Notices::create([
            'topic' => 'Upload this link',
            'detail' => 'Blah Blah Blah.... :P',
            'type' => 'asklgb'
        ]);

        Notices::create([
            'topic' => 'Upload this link',
            'detail' => 'Blah Blah Blah.... :P',
            'type' => 'asfjsla'
        ]);
    }
}