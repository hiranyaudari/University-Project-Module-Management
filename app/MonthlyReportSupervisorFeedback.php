<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyReportSupervisorFeedback extends Model {

    protected $table = 'monthly_report_supervisor_feedbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['supervisorId','reportId','currentstatus', 'workdone', 'timelycompletion','supervisorcontact','overallprogress','seriousproblems','comments'];

}
