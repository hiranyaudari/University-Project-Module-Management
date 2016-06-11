<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\MonthlyReportSupervisorFeedback;
/**
 * Created by PhpStorm.
 * User: pranavaghanan
 * Date: 5/8/15
 * Time: 12:20 PM
 */

class MonthlyReportsSupervisorFeedbackSeeder extends Seeder {

    public function run()
    {
        Model::unguard();

        MonthlyReportSupervisorFeedback::create([
            "reportId" => 1,
            "supervisorId" => 1,
            "currentstatus" => 3,
            "workdone" => 3,
            "timelycompletion" => 2,
            "supervisorcontact" => 3,
            "overallprogress" => 1,
            "seriousproblems" => 2,
            "comments" => "Talk with me people.."
        ]);

        MonthlyReportSupervisorFeedback::create([
            "reportId" => 2,
            "supervisorId" => 1,
            "currentstatus" => 2,
            "workdone" => 3,
            "timelycompletion" => 2,
            "supervisorcontact" => 2,
            "overallprogress" => 1,
            "seriousproblems" => 1,
            "comments" => "Expecting more output.."
        ]);

        MonthlyReportSupervisorFeedback::create([
            "reportId" => 3,
            "supervisorId" => 1,
            "currentstatus" => 2,
            "workdone" => 2,
            "timelycompletion" => 2,
            "supervisorcontact" => 2,
            "overallprogress" => 1,
            "seriousproblems" => 1,
            "comments" => "Bar is set high guys.."
        ]);

        MonthlyReportSupervisorFeedback::create([
            "reportId" => 4,
            "supervisorId" => 1,
            "currentstatus" => 2,
            "workdone" => 3,
            "timelycompletion" => 1,
            "supervisorcontact" => 4,
            "overallprogress" => 1,
            "seriousproblems" => 1,
            "comments" => "Do the work you lazy bastards.."
        ]);

        MonthlyReportSupervisorFeedback::create([
            "reportId" => 6,
            "supervisorId" => 2,
            "currentstatus" => 3,
            "workdone" => 3,
            "timelycompletion" => 2,
            "supervisorcontact" => 3,
            "overallprogress" => 1,
            "seriousproblems" => 2,
            "comments" => "No comments.. Simply waste."
        ]);

    }
}

