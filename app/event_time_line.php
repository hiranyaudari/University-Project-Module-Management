<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class event_time_line extends Model {


    protected $table = 'event_time_lines';
    protected $fillable =array('id','memberID', 'eventType','eventName','eventDate','eventTime','eventDescription');

}
