<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class progress extends Model {

    protected $table = 'progress';

    protected $fillable = ['student_id','project_id', 'date', 'month','current_project_status','prev_month_work' ];
}


