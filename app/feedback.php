<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model {

	protected $table = 'feedback';

    protected $fillable = ['Student_no','Project_id','Supervisor_id', 'date', 'feedback' ];

}
