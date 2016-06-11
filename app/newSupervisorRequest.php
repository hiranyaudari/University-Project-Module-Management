<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
class newSupervisorRequest extends Model {
    protected $table='new_supervisor_requests';
    protected $fillable = array('projectID' ,'newSupervisorID', 'description','status');


    public  static $rules=array(
        'newSupervisor'=>'required',
        'description'=>'required',
        'prjID'=>'unique:new_supervisor_requests,projectID',



    );

    public static $messages=array(
        'newSupervisor.required'=>'Please select the supervisor you are requesting',
        'description.required'=>'Please give valid reason',
        'prjID.unique'=>'You have already sent a request  ',
    );

    public  static  function validate($data){

        return Validator::make($data,static::$rules,static::$messages);
    }
}
