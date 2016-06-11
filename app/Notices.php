<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notices extends Model {

	//

    protected $table = 'notices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['topic', 'detail', 'type'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
