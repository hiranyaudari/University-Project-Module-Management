<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyReport extends Model {

    protected $table = 'monthly_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['id','projectId', 'month', 'currentstatus','workdone'];

}
