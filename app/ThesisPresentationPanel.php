<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ThesisPresentationPanel extends Model {

    protected $table = 'thesis_presentation_panels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['projectId', 'memberOneId', 'memberTwoId','venue','date','time_start','time_end'];

}
