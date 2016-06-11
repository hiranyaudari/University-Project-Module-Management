<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\MonthlyReport;
/**
 * Created by PhpStorm.
 * User: pranavaghanan
 * Date: 5/8/15
 * Time: 12:20 PM
 */

class MonthlyReportsSeeder extends Seeder {

    public function run()
    {
        Model::unguard();

        MonthlyReport::create([
            'projectId' => 1,
            'month' => 1,
            'currentstatus' => 'Thinking of what to do..',
            'workdone' => 'Nothing so far :P'
        ]);

        MonthlyReport::create([
            'projectId' => 1,
            'month' => 2,
            'currentstatus' => 'Deciding when to start',
            'workdone' => 'Still nothing.. :P'
        ]);

        MonthlyReport::create([
            'projectId' => 1,
            'month' => 3,
            'currentstatus' => 'Okay.. I decided to start next month.',
            'workdone' => 'Eating and sleeping is what is done so far.'
        ]);

        MonthlyReport::create([
            'projectId' => 1,
            'month' => 4,
            'currentstatus' => 'Sleeping',
            'workdone' => 'Oops... :('
        ]);

        MonthlyReport::create([
            'projectId' => 2,
            'month' => 1,
            'currentstatus' => 'Requirements Gathering',
            'workdone' => 'Team talk.'
        ]);

        MonthlyReport::create([
            'projectId' => 2,
            'month' => 2,
            'currentstatus' => 'Software Architecture decide phase',
            'workdone' => 'MVC research'
        ]);

        MonthlyReport::create([
            'projectId' => 2,
            'month' => 3,
            'currentstatus' => 'GUI Design planning',
            'workdone' => 'Prototype design'
        ]);

        MonthlyReport::create([
            'projectId' => 3,
            'month' => 1,
            'currentstatus' => 'Supervisor searching',
            'workdone' => 'Only talking talking talking...'
        ]);
    }
}

