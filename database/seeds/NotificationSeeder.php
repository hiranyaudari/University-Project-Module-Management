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


class Notification extends Seeder {

    public function run()
    {
        Model::unguard();

//        DB::table('notification')->insert([
//            'from_id' => 'It13113741',
//            'from_type' => null,
//            'to_id' => 'RPC',
//            'to_type' =>null,
//            'category_id' =>'1',
//            'url' => '/viewSupervisorDetails/',
//            'extra' => '{"superviosrObjectid":1,"projectId":1}',
//            'read' => '0'
//        ]);

    }

}