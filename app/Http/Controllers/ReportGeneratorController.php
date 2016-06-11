<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ThesisPresentationPanel;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class ReportGeneratorController extends Controller{

	public function generatePresentationPaymentReports() {
		$html = "
        <html>
            <head></head>
            <body>
                <center><h4>Payments Report of Presentation Schedules</h4></center>
            </body>
        </html>";
		return \PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')->stream('presenationpayments.pdf');
	}


	public function generateThesisSchedulesReports() {

		$panels = ThesisPresentationPanel::join('projects as prj','prj.id','=','thesis_presentation_panels.projectId')
			->join('panelmembers as p1',function($query) {
				$query->on('thesis_presentation_panels.memberOneId','=','p1.id');
			})
			->join('panelmembers as p2',function($query) {
				$query->on('thesis_presentation_panels.memberTwoId', '=', 'p2.id');
			})
			->join('panelmembers as sup',function($query) {
				$query->on('prj.supervisorId', '=', 'sup.id');
			})
			->select('prj.title','thesis_presentation_panels.date','thesis_presentation_panels.venue',
				'thesis_presentation_panels.time_start', 'thesis_presentation_panels.time_end', 'p1.name as PanelMember1',
				'p2.name as PanelMember2', 'sup.name as Supervisor' )
			->get();

		$html = "<html><body>
					<h2><center>Sri Lanka Institute of Information Technology</center></h2>
					<h3><center>Thesis Presentation Schedules</center></h3>
					<br/><br/>".
                    "<table>".
			"<thead>".
			"<tr>".
			"<th>Project Title</th>".
			"<th>Date</th>".
			"<th>Venue</th>".
			"<th>Time Slot</th>".
			"<th>Supervisor</th>".
			"<th>Panel Member 1</th>".
			"<th>Panel Member 2</th>".
			"</tr>".
			"</thead>".
			"<tbody>";

                        foreach ($panels as $panel) {
							$html .= "<tr>".
                                "<td> $panel->title </td>".
                                "<td><center>$panel->date</center></td>".
                                "<td><center>$panel->venue</center></td>".
                                "<td> <center>$panel->time_start to $panel->time_end</center> </td>".
                                "<td><center>$panel->Supervisor</center></td>".
                                "<td><center>$panel->PanelMember1</center></td>".
                                "<td><center>$panel->PanelMember2</center></td>".
                            "</tr>";
						}

                        $html .= "</tbody>".
							"</table>".
							"</body></html>";

		return \PDF::loadHTML($html)->setorientation('landscape')->stream('presenationpanels.pdf');
	}
}
