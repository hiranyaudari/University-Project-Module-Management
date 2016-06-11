<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
class Notice extends Model {

    //

    protected $table = 'notices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['topic', 'detail', 'type'];


    public  static $rules=array(
        'topic'=>'required',
        'detail'=>'required',

    );

    public  static  function validate($data){

        return Validator::make($data,static::$rules);
    }
}
