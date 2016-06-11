<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
class thesisEvaluation extends Model {

    protected $table = 'thesis_evaluations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['projectId', 'independentScientificThinking', 'scientificKnowHow','logic','presentation','workProcess','comment','status','panelMember','date','formVersion','published'];



    public  static $rules=array(

        'independentScientificThinking'=>'required|numeric|marks',
        'scientificKnowHow'=>'required|numeric|marks',
        'logic'=>'required|numeric|marks',
        'presentation'=>'required|numeric|marks',
        'workProcess'=>'required|numeric|marks',
        'status'=>'required',

    );

    public  static $messages=array(

        'independentScientificThinking.marks'=>'The Independent Scientific Thinking marks must be between 0 - :max.',
        'scientificKnowHow.marks'=>'The scientific Know How marks must be between 0 - :max.',
        'logic.marks'=>'The Logic marks must be between 0 - :max.',
        'presentation.marks'=>'The Presentation marks must be between 0 - :max.',
        'workProcess.marks'=>'The WorkProcess marks must be between 0 - :max.',

    );

    public static function validate($data){

        return Validator::make($data,static::$rules,static::$messages);
    }

}
    //MARKS VALIDATION RULE TO CHECK WHETHER THE INPUT MARKS IS WITHIN THE DEFINED MARKS RANGE
    Validator::extend('marks', function($field,$value,$parameters){

        $v=thesisEvaluationForm::max('id');
        $marks=thesisEvaluationForm::where('id',$v)->pluck($field);

        return (0 <= $value && $value <= $marks );

    });

    //ERRORS MESSAGE FOR MARKS RULE
    Validator::replacer('marks', function ($message, $field, $rule, $parameters) {
            $v=thesisEvaluationForm::max('id');
            $marks=thesisEvaluationForm::where('id',$v)->pluck($field);

            return str_replace([':max'], $marks, $message);
        });