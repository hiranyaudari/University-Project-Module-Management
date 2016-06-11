<?php namespace App\Http\Controllers;
use App\ResearchAreas;
use Illuminate\Http\Request as Request2;
use Request;

class AddResearchArea extends Controller {

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }


    public function add_research_area()
    {
        $Allresearchareas = ResearchAreas::all();
        return view('researchArea.addResearchArea', compact('Allresearchareas'));
    }
    
    public function create()
    {
        return view('researchArea.create');
    }
    
    public function storeResearchArea(Request2 $reques)
    {
        // validation without request clz
        $this->validate($reques, ['Research_Area' => 'required']);
        
        ResearchAreas::create([
            'research_area' => Request::get('Research_Area'),
            'researcher_i' => Request::get('researcher1'),    
            'researcher_ii' => Request::get('researcher2'),
            'description' => Request::get('desc')
                
            ]);
        
        return redirect('addResearchArea');
    }
    
    public function destroy($id)
    {
        //$idi = Crypt::decrypt($id);

        $model = ResearchAreas::find($id);
        $model->delete();

        return redirect('addResearchArea')->with('message_success', 'Research Area Deleted!');
    }
}
