<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PresentationPanel extends Model {

	//
    //
    protected $table = 'presentationpanels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['projectId', 'memberOneId', 'memberTwoId','venue','date','time_start','time_end'];

}
