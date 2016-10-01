<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model {

    protected $fillable = [
            
            'task',
            'description',
            'plantofinish',
            'state',
            'sdate',
            'edate',
            'hours'
        ];
}
