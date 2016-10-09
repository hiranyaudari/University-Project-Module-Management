<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model {

	//

    protected $table = 'modules';
    


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['module_id','module_index','enrollment_key', 'module_name', 'module_year','lecturer_incharge','module_description'];


}
