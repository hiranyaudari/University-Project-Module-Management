<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PanelMember extends Model {

	//

    protected $table = 'panelmembers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'designation', 'email','phone','speciality','type','status','university','cv','username'];

}
