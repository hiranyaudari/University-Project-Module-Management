<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
class PropasalEvaluationDetails extends Model {

	//
    protected $table = 'propasal_evaluation_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['proposal_id', 'parts','marks','comment'];

    public  static $rules=array(

        'IntroductionMarks'=>'required|numeric|between:0,10',
        'ProblemDefinitionMarks'=>'required|numeric|between:0,10',
        'ScopeMarks'=>'required|numeric||between:0,5',
        'LiteratureReviewMarks'=>'required|numeric|between:0,25',
        'MethodologyMarks'=>'required|numeric||between:0,15',
        'WorkplanMarks'=>'required|numeric|between:0,10',
        'DocumentMarks'=>'required|numeric|between:0,10',
        'OralpresentationMarks'=>'required|numeric|between:0,10',
        'Q/AsessionMarks'=>'required|numeric|between:0,5',
        'status'=>'required',



    );

    public  static  function validate($data){

        return Validator::make($data,static::$rules);
    }

}
