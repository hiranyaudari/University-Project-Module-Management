<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model {

    protected $table = 'projects';
    
    protected $fillable = [
            
            'title',
            'studentId'
        ];
}
