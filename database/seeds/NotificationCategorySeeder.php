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


class NotificationCategorySeeder extends Seeder {

    public function run()
    {
        Model::unguard();

        DB::table('notification_categories')->insert([
            'name'=> 'StudentToRpcAddExtSupReq',
            'text' => 'dsfdsf'
        ]);
        DB::table('notification_categories')->insert([
            'name'=> 'StudentToRpcAddExtSupReq1',
            'text' => 'dfdfdsfsdfdsf'
        ]);

        DB::table('notification_categories')->insert([
            'name'=> 'ConfirmInternalSupervisorRequest',
            'text' => 'has Requested a Supervisor'
        ]);
        DB::table('notification_categories')->insert([
            'name'=> 'HasNoSupervisor',
            'text' => 'has no Supervisor assigned'
        ]);
        DB::table('notification_categories')->insert([
            'name'=> 'ConfirmProjectRequest',
            'text' => 'has Requested a Project'
        ]);

        DB::table('notification_categories')->insert([
            'name'=> 'ConfirmExternalSupervisorRequest',
            'text' => 'has Requested a External Supervisor'
        ]);
        DB::table('notification_categories')->insert([
            'name'=> 'InternalSupervisorRequestNotification',
            'text' => 'You have been assign to a project'
        ]);

        DB::table('notification_categories')->insert([
            'name'=> 'RequestSupervisorAsYou',
            'text' => 'has requested a Supervisor as you'
        ]);
        DB::table('notification_categories')->insert([
            'name'=> 'SupervisorMeetingRequest',
            'text' => 'Your request has been accepted Supervisor'
        ]);

        DB::table('notification_categories')->insert([
            'name'=> 'SupervisorMeetingRequestForSupervisor',
            'text' => 'has Requested a Supervisor Meeting'
        ]);

        DB::table('notification_categories')->insert([
            'name'=> 'SupervisorMeetingRequestAccepted',
            'text' => 'has Accepted you requested Supervisor Meeting'
        ]);
        DB::table('notification_categories')->insert([
            'name'=> 'SupervisorMeetingRequestRejected',
            'text' => 'has Rejected you requested Supervisor Meeting'
        ]);


    }

}