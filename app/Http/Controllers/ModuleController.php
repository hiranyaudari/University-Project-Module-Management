<?php namespace App\Http\Controllers;

use Illuminate\Http\Requests;
use App\Http\Requests\AddMod;
use App\FreeSlots;
use App\Modules;
use App\PanelMember;
use App\PresentationPanel;
use App\Project;
use App\Student;
use DB;
use Crypt;
use Input, Redirect, Hash, Mail, URL, Response;

class ModuleController extends Controller{
    
  
    public function add()
    {
        $mid = DB::table('modules')->max('module_id');
        $mid++;
        return view('modules')->with('mid',$mid);
    }
    
    public function store(AddMod $mod){
        
          $unique = true;
          
          
          $Name=$mod->name;
          $code=$mod->code;
          $ek=$mod->ek;
          $Year=$mod->year;
          $Lecturers=$mod->lecturers;
          $Description=$mod->description;
          
          $modules=Modules::all();
          $names=$modules->lists('module_name');
          $codes=$modules->lists('module_index');

          foreach ($names as $name1) {
              if ($name1 == $Name) {
                  $unique = false;
                  \Session::flash('message_error', 'Module is existing, try with a different module!!');
                  return Redirect::to('/modules');
              }
              foreach ($codes as $code1)
                  if ($code1 == $code) {
                      $unique = false;
                      \Session::flash('message_error', 'Module is existing, try with a different module!!');
                      return Redirect::to('/modules');
                  }

          }

        if ($unique) {
            Modules::create(['module_index'=>$code,'module_name' => $Name,'enrollment_key'=>$ek, 'module_year' =>$Year,
            'lecturer_incharge' =>$Lecturers,'module_description' => $Description]);
            \Session::flash('message_success', 'Module Added Successfully!!');
            return Redirect::to('/modules');
            
            

        } else {

            return view('Final.modules')->with('message', 'Try with a different module name');
        }
        
        
    }
    
    function search(){
        
        
        $name=Input::get('sid');
        $id=Modules::where('module_name',$name)->pluck('module_id');
        $code=Modules::where('module_name',$name)->pluck('module_index');
        $ek=Modules::where('module_name',$name)->pluck('enrollment_key');
        $year=Modules::where('module_name',$name)->pluck('module_year');
        $lecturerincharge=Modules::where('module_name',$name)->pluck('lecturer_incharge');
        $description=Modules::where('module_name',$name)->pluck('module_description');

        $data = array(
            "name" =>$name,
            "id" => $id,
            "code"=>$code,
            "ek"=>$ek,
            "year" => $year,
            "lecturerincharge" => $lecturerincharge,
            "description" => $description);
        return json_encode($data);
    }
    
    
    function updateModindex()
    {

        $lecturers1 = PanelMember::lists('name','id');
        $categories1 =  Modules::lists('module_name','module_name');
        
        return view('updateModules',compact('categories1','lecturers1','user'));
    
    }
    
    
    
    
    
    
    function updateModelindexstore()
    {
        $name = Input::get('name');
        $ek=Input::get('ek');
        $code = Input::get('code');
        $year = Input::get('year');
        $ek=Input::get('ek');
        $lecturerincharge = Input::get('lecturerincharge');
        $description = Input::get('description');
        

        $q = Modules::where('module_name', $name)->update(['module_year' => $year,'module_index'=>$code,'enrollment_key'=>$ek,
            'lecturer_incharge' => $lecturerincharge,
            'module_description' => $description]);
     


        return $q;


    }


    function deleteModuleindexstore()
    {
        $name = Input::get('name');
        
        $model=Modules::where('module_name',$name)->delete();
        $lecturers1 = PanelMember::lists('name','id');
        $categories1 =  Modules::lists('module_name','module_name');
        
       //return view('updateModules',compact('categories1','lecturers1','user'))->with('delete_success','Module Deleted Successfully !');
    }
}
