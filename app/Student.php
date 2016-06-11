<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Input;
class Student extends Model {

	//

    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone','courseField','attempt','username', 'regId'];


    public static function validateFields(){

        $messages = array(
            'regId.required' => 'Registration Number is required',
            'regId.unique' => 'Registration Number should be unique',
            'studentname.required' => 'Your name is required',
            'studentname.alpha' => 'Your name should contain only letters',
            'email.required' => 'Your email address is required',
            'telephone.required' => 'Your telephone number is required',
            'telephone.numeric' => 'Your telephone number should be numeric',
            'password.min:5' => 'Enter a password must have at least 5 letters',
            'supervisortype.required' => 'Select type of supervisor',
            'projectTitle.required' => 'Select a supervisor',
            'projectDescription.required' => 'Enter a short description of your project',
            'attempt.required' => 'Select your attempt'
        );


        $rules = array(
            'regId' => 'required|unique:students',
            'studentname' => 'required|alpha',
            'email' => 'required|email|unique:students',
            'telephone' => 'required|min:10',
            'password' => 'required|min:5',//|confirmed
            'confirm' => 'required',//|same:password
            'projectTitle' => 'required',
            'projectDescription' => 'required',
            'supervisortype' => 'required',
            'attempt' => 'required'
        );

        return \Validator::make(Input::all(), $rules, $messages);



    }

}
