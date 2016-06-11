<?php namespace App\Http\Controllers;

use App\Http\Requests;

use Carbon\Carbon;
use DateTime;
use App\UploadLink;
use App\Student;
use Illuminate\Database\Eloquent\Collection;
//use Illuminate\Support\Facades\Validator;
use Input, Redirect, DB, Hash, Mail, URL, Response;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Database\Eloquent\Model;

class uploadController extends Controller
{

    //create Link when button clicked
    public function createUploadLink()
    {
        //To redirect to the page to view all created links
        if(isset($_POST['viewLink']))
        {
            return redirect('viewLink')->with('message','');
        }

        if (isset($_POST['createLink']))
        {
            $rules = array(
                'linkName'=>'required'
            );

            $validator = \Validator::make(Input::all(), $rules);
            if ($validator->fails()) {

                return view('Rubika.uploadLink')->with('message', '')->with('errorMessage','link Name field cannot be empty!! ');


            } else {

                $course = Input::get('getCourse');
                $document = Input::get('docType');
                $link = Input::get('linkName');
                $description = Input::get('description');
                //$deadline = date('Y-m-d', strtotime(str_replace('-', '/', Input::get('deadline'))));
                $deadline=Input::get('deadline');

                UploadLink::create(['category' => $course, 'docType' => $document, 'linkName' => $link, 'description' => $description, 'deadline' => $deadline, 'status' => 'visible']);

                return view('Rubika.uploadLink')->with('message', 'Successfully created the upload Link!!')->with('errorMessage','');
            }
        }


    }

    public function uploadLink()
    {
        return view('Rubika.uploadLink')->with('message','')->with('errorMessage','');
    }

    public function viewLinks()
    {
        $linkDetails=UploadLink::all();
        return view('Rubika.viewLinks')->with('uploadLinks',$linkDetails)->with('message','');

    }
    //button actions in the view links page
    public function buttonActions()
    {
        //redirect to a page to add a new link
        if(isset($_POST['addLink']))
        {
            return redirect('upload');
        }
        if(isset($_POST['deleteLink'])) {

            $deletelink = UploadLink::find($_POST['deleteLink']);
            $deletelink->delete();
            $linkDetails=UploadLink::all();
            return view('Rubika.viewLinks')->with('uploadLinks',$linkDetails)->with('message','Upload Link deleted');
        }

        else if (isset($_POST['hideLink'])) {

            $hideLink = UploadLink::find($_POST['hideLink']);
            if($hideLink->status=='visible')
            {
                $hideLink->status='hidden';
                $hideLink->save();
            }
            elseif($hideLink->status=='hidden')
            {
                $hideLink->status='visible';
                $hideLink->save();
            }

            $linkDetails=UploadLink::all();
            return view('Rubika.viewLinks')->with('uploadLinks',$linkDetails)->with('message','');
        }


    }

    //edit link page view
    public function editLink($linkId)
    {
        $editable=UploadLink::find($linkId);
        $deadline=$editable->deadline;
        $date=date('d/m/Y', strtotime(str_replace('/', '-',$deadline)));
        return view('Rubika.editLink')->with('update',$editable)->with('message','')->with('date',$date);
    }

    //update the edited link
    public function updateLinkDetails($linkId)
    {
        if (isset($_POST['viewLink'])) {
            return redirect('viewLink');
        }
        if (isset($_POST['editLink'])) {
            $rules = array(
                'linkName' => 'required'
            );

            $validator = \Validator::make(Input::all(), $rules);
            if ($validator->fails()) {

                return Redirect::back();


            } else {
                $course = Input::get('getCourse');
                $document = Input::get('docType');
                $link = Input::get('linkName');
                $description = Input::get('description');
                $deadline = date('Y-m-d', strtotime(str_replace('-', '/', Input::get('deadline'))));

                $edit = UploadLink::find($_POST['editLink']);
                $edit->category = $course;
                $edit->docType = $document;
                $edit->linkName = $link;
                $edit->description = $description;
                $edit->deadline = $deadline;
                $edit->save();


                return redirect('viewLink');
            }
        }
    }


        //-------------------------------------------Students view upload--------------------------------------------


        public function displayLinks()
        {
            if (Sentinel::check())
            {
                $email = Sentinel::getUser()["email"];
                $course= Student::where('email','=',$email)->pluck('courseField');


                 $linksVisible=UploadLink::where('status','=','visible')->where('category','=',$course)->get();

                return view('Rubika.studentView')->with('upLinks',$linksVisible);


            }
            else
            {
                // User is not logged in
                return view('auth.login');

            }
        }

        public function uploadView($linkId)
        {
            $email = Sentinel::getUser()["email"];
            $regNo= Student::where('email','=',$email)->pluck('regId');


           $linkInfo=UploadLink::find($linkId);
            $deadline=new DateTime($linkInfo->deadline);
            $newDate= new DateTime();
            $curDate=new DateTime($newDate->format('Y-m-d'));

            $interval = $curDate->diff($deadline);

            if($interval->format('%R')=='+')
            {
                $timeRemaining=$interval->format('%a days').' Remaining';
            }
            else
            {
                if($interval->format('%a')==0)
                    $timeRemaining='Submit before 11.59 pm today';

                else
                $timeRemaining='OverDue by '.$interval->format('%a days');
            }


            return view('Rubika.upload')->with('link',$linkInfo)->with('daysRemaining',$timeRemaining)->with('regNo',$regNo);
        }



}
