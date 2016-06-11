<?php
use App\PanelMember;
use App\PresentationPanel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: pranavaghanan
 * Date: 5/8/15
 * Time: 12:20 PM
 */

class PresentationPanelTableSeeder extends Seeder {

    public function run()
    {
        Model::unguard();

        PresentationPanel::create([
            'projectId' => 1,
            'memberOneId' => 1,
            'memberTwoId' => 2,
            'venue' => 'Concept Nursery',
            'date' => '2015-05-10',
            'time_start' => '08:40',
            'time_end' => '09:40',
        ]);

        PresentationPanel::create([
            'projectId' => 2,
            'memberOneId' => 1,
            'memberTwoId' => 3,
            'venue' => 'D-201',
            'date' => '2015-05-11',
            'time_start' => '09:10',
            'time_end' => '09:40',
        ]);

        PresentationPanel::create([
            'projectId' => 3,
            'memberOneId' => 1,
            'memberTwoId' => 3,
            'venue' => 'D-201',
            'date' => '2015-05-13',
            'time_start' => '10:10',
            'time_end' => '10:30',
        ]);

        PresentationPanel::create([
            'projectId' => 4,
            'memberOneId' => 1,
            'memberTwoId' => 3,
            'venue' => 'Concept Nursery',
            'date' => '2015-05-11',
            'time_start' => '09:10',
            'time_end' => '09:40',
        ]);
    }
}

