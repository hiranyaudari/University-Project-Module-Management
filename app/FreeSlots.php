<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FreeSlots extends Model {

	//

    //
    protected $table = 'freeslots';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['id','memberId', 'freeDay', 'startingHour','startingMin','endingHour','endingMin'];

}
