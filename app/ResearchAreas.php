<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchAreas extends Model {

    protected $fillable = [
            
            'research_area',
            'researcher_i',
            'researcher_ii',
            'description'
        ];
}
