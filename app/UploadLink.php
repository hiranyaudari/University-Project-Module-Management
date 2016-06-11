<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadLink extends Model {

    protected $table = 'upload_links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','category','docType','linkName','description','deadline','status'];

}
