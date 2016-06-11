<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class monthlyfeed extends Model {

    //

    protected $table = 'monthlyfeed';

    protected $fillable = ['student_id','project_id', 'date', 'feedback' ];
}
