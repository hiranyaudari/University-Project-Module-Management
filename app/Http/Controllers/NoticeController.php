<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Fileentry;
use Illuminate\Support\Facades\Input;
use Storage;
use File;
use App\Notice;
use Session;
use Notifynder;
use Redirect;


class NoticeController extends Controller {

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

	public function viewLink()
	{
        $no= Notice::all();
        return view('Notices.viewNotice', compact('no'));
	}
    public function viewLinksForStudent()
    {
        $allNotices = Notice::all();
        return View('Notices.viewNoticeForStudents')->with('no',$allNotices);
    }
    public function add_new_notice()
    {
        return view('Notices.addNotice');
    }
    public function editNoticeView($id)
    {
        $v=Notice::find($id);
        return view('Notices.editNotice',compact('v'));
    }

   public function  addNotice()
   {
       if (isset($_POST['addNotice'])) {
           $validation = Notice::validate(Input::all());
           if ($validation->fails()) {
               return Redirect::action('NoticeController@addNotice')
                   ->withErrors($validation)
                   ->withInput();
           }
           else {
               $topic = Input::get('topic');
               $de = Input::get('detail');
               $breaks = array("<br />", "<br>", "<br/>", "<br />", "&lt;br /&gt;", "&lt;br/&gt;", "&lt;br&gt;");
               $detail = str_ireplace($breaks, "\r\n", $de);

               Notice::create(['topic' => $topic, 'detail' => $detail, 'type' => 'notice']);
               return redirect('viewNotice');
           }
       }
   }


    public  function  notice_buttons()
   {
      if(isset($_POST['addnew'])) {
        return redirect('addNotice');
      }
      else if (isset($_POST['toDelete'])) {

            $u = Notice::find($_POST['toDelete']);
            $u->delete();
            return Redirect::action('NoticeController@notice_buttons');
      }

      elseif (isset($_POST['AddUploadlink'])) {

        $y = Input::get('topicc');
         if ($y != NULL) {
            Notice::create(['topic' => $y, 'detail' => '', 'type' => 'uplink']);
            return Redirect::action('NoticeController@notice_buttons');
         }else{
            Session::flash('message', 'Add any topic to visible link ');
            return Redirect::action('NoticeController@notice_buttons');
         }

      }elseif (isset($_POST['tovisible'])) {

        $p=Notice::find($_POST['tovisible']);
        $p->type='uplink';
        $p->save();
        return Redirect::action('NoticeController@notice_buttons');

      }elseif (isset($_POST['tohide'])) {

        $p=Notice::find($_POST['tohide']);
        $p->type='hideuplink';
        $p->save();
        return Redirect::action('NoticeController@notice_buttons');

    }elseif(isset($_POST['Addlink'])){

          $file=Input::file('filefield');
          if ($file!=NULL) {
             $extension = $file->getClientOriginalExtension();
             Storage::disk('local')->put($file->getClientOriginalName(), File::get($file));
             Fileentry::create(['filename' => $file->getFilename() . '.' . $extension, 'mime' => $file->getClientMimeType(), 'original_filename' => $file->getClientOriginalName()]);
             Notice::create(['topic' => $file->getClientOriginalName(), 'detail' => $file->getFilename() . '.' . $extension, 'type' => 'link']);
             return Redirect::action('NoticeController@notice_buttons');
         }else{
             Session::flash('message', 'Please choose a file to upload');
             return Redirect::action('NoticeController@notice_buttons');
         }

     }
}

    public function  editNotice()
    {
        if (isset($_POST['toEdit'])) {
            $topic = Input::get('e_topic');
            $de = Input::get('e_detail');
            $breaks = array("<br />","<br>","<br/>","<br />","&lt;br /&gt;","&lt;br/&gt;","&lt;br&gt;");
            $detail = str_ireplace($breaks, "\r\n", $de);

            $t=Notice::find($_POST['toEdit']);
            $t->topic=$topic;
            $t->detail=$detail;
            $t->save();
            return redirect('viewNotice');
        }

    }
}
