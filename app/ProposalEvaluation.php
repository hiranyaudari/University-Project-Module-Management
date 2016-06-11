<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProposalEvaluation extends Model {

	 protected $table = 'proposal_evaluations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id', 'project_id','panelmember_id','status'];

}
