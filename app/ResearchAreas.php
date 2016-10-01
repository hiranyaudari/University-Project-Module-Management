<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchAreas extends Model {

    protected $fillable = [
            
            'id',
            'research_area',
            'researcher_i',
            'researcher_ii',
            'description'
        ];
}
