<?php namespace App\Http\Controllers;
use App\Student;
use App\Submission;
use Input, Redirect, DB, Hash, Mail, URL, Response;
use Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Capsule\Manager as Capsule;
use Session;
use DateTime;

class submissionsController extends Controller
{
    //view submissions after month selected
    public function selectSubmissions()
    {
        $month=Input::get('getMonth');



        $proSubmissions=Submission::join('projects','submissions.projectId','=','projects.id')
            ->where('submissions.month','=',$month)
            ->join('students','students.id','=','projects.studentId')
            ->select('submissions.id','projects.title','students.regId','students.name','submissions.submittedDate','submissions.location')
            ->get();


        return view('Rubika.viewMonthlyReports')->with('submissions',$proSubmissions)->with('month',$month);


    }
    //view submissions before month selected
    public function viewSubmissionsDetails()
    {

        $proSubmissions=Submission::join('projects','submissions.projectId','=','projects.id')
            ->join('students','students.id','=','projects.studentId')
            ->select('submissions.id','projects.title','students.regId','students.name','submissions.submittedDate','submissions.location')
            ->get();
        return view('Rubika.viewMonthlyReports')->with('submissions',$proSubmissions)->with('month','');


    }
    //view pdf document
    public function viewDocuments($subId)
    {

        $submissions = Submission::where('id', '=', $subId)->firstOrFail();

        $path2 = storage_path('app') . '/' . $submissions->location;
        header('content-type:application/pdf');
        echo file_get_contents($path2);
        return view('Rubika.viewDocument');
    }



//----------------------------------------------iteration4----------------------------------------------------------
//---------------------------------------------save uploads----------------------------------------------------------

    public function saveUpload($linkId)
    {
        if (isset($_POST['upload'])) {


            $rules = array(
                'formField' => 'required'
            );

            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails())
            {

                Session::flash('message', 'Please choose a file to upload');
            }
            else {
                $course = Input::get('regNo');
                $document = Input::get('docType');

                $newDate = new DateTime();
                $curDate = new DateTime($newDate->format('Y-m-d'));

                $curYear = $curDate->format("Y");
                $regNo = Input::get('regNo');

                $file=Input::file('formField');

                if($file!=null)
                {
                    $destinationPath = '/public/uploads/' . $curYear . '/' . $document . '/' . $regNo.'/';
                    $extension = $file->getClientOriginalExtension();
                    $fileName = Input::get('regNo') .'.'. $extension;

                    $file->move(
                        base_path() . $destinationPath, $fileName
                    );

                    $stuId = Student::where('regId', '=', $regNo)->pluck('id');
                    Submission::create(['type' => $document, 'submittedDate' => $curDate, 'status' => 'submitted', 'location' => $destinationPath . '/' . $fileName, 'studentId' => $stuId]);
                    return redirect('/studentdashboard');


                }

                /*$file=Request::file('fileField');
                if ($file!=NULL) {
                    $destinationPath = 'uploads/' . $curYear . '/' . $document . '/' . $regNo;
                    $extension = $file->getClientOriginalExtension();
                    $fileName = Input::get('regNo') . $extension;
                    $upload_success = $file->move($destinationPath, $fileName);

                    $stuId = Student::where('regId', '=', $regNo)->pluck('id');

                    if ($upload_success) {
                        Submission::create(['type' => $document, 'submittedDate' => $curDate, 'status' => 'submitted', 'location' => $destinationPath . '/' . $fileName, 'studentId' => $stuId]);
                        return view('Rubika.editUpload');
                    }
                    else {

                        return Redirect::action('');
                    }
                }

                else{
                    return view('auth.login');
                }*/




            }
        }

    }




}
