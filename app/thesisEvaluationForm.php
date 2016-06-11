<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
class thesisEvaluationForm extends Model {

	//
    protected $table = 'thesis_evaluation_forms';
    protected $fillable = [ 'independentScientificThinking', 'scientificKnowHow','logic','presentation','workProcess'];

    public  static $rules=array(

        'independentScientificThinking'=>'required|numeric',
        'scientificKnowHow'=>'required|numeric',
        'logic'=>'required|numeric',
        'presentation'=>'required|numeric',
        'workProcess'=>'required|numeric',
        'total'=>'check',

    );

    public  static $messages=array(
        //=>'Total Marks must be 100',
        'total.check'=>'Total Marks must be 100',
    );


    public static function validate($data){

        return Validator::make($data,static::$rules,static::$messages);
    }

}
    //CHECK VALIDATION RULE TO CHECK WHETHER SUM OF MARKS IS EQUAL TO 100
    Validator::extend('check', function($field,$value,$parameters){
        return $value==='100';
    });

