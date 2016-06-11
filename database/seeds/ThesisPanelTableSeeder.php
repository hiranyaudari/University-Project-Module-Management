<?php
use App\PanelMember;
use App\ThesisPresentationPanel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: pranavaghanan
 * Date: 5/8/15
 * Time: 12:20 PM
 */

class ThesisPanelTableSeeder extends Seeder {

    public function run()
    {
        Model::unguard();
        ThesisPresentationPanel::create([
            'projectId' => 7,
            'memberOneId' => 3,
            'memberTwoId' => 2,
            'venue' => 'Concept Nursery',
            'date' => '2015-11-30',
            'time_start' => '08:30',
            'time_end' => '09:15',
        ]);

        ThesisPresentationPanel::create([
            'projectId' => 8,
            'memberOneId' => 2,
            'memberTwoId' => 4,
            'venue' => 'D-201',
            'date' => '2015-11-25',
            'time_start' => '09:15',
            'time_end' => '10:00',
        ]);
    }
}

