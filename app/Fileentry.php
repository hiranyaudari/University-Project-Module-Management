<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Fileentry extends Model {

	//
    protected $table = 'fileentries';
    protected $fillable =array('filename', 'mime','original_filename','type');
}
