<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\College;
use App\Copyright;
use App\Patent;
use Carbon\Carbon;
use PDF;

class CollegeController extends Controller
{
	public $viewPath;
    public $copyright;
    public $patent;
    public $column;
  
    public function __construct()
    {
        $this->viewPath = 'admin.reports.';
        $this->copyright = new Copyright;
        $this->patent = new Patent;
        $this->column = 'colleges.char_college_code';
        $this->middleware('auth');
    }

    public function listColleges()
    {
        $patentStats = $this->patent
            ->patentStats($this->column);
        $copyrightStats = $this->copyright
            ->copyrightStats($this->column);
    	return view($this->viewPath.'list-colleges', 
            ['copyrightStats' => $copyrightStats, 
            'patentStats' => $patentStats]);
    }

    public function rangedColleges(Request $request)
    {
        $this->validate($request, [
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ]);
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;

        $copyrights = $this->copyright
            ->rangedCopyrights($this->column, $dateStart, $dateEnd);
        $patentStats = $this->patent->rangedPatents($this->column, $dateStart, $dateEnd);
        $dateStart = date('m/d/Y', strtotime($request->dateStart));
        $dateEnd = date('m/d/Y', strtotime($request->dateEnd));
        return view($this->viewPath.'ranged-colleges', 
            ['copyrightStats' => $copyrights, 'patentStats' => $patentStats, 
                'dateStart' => $dateStart, 'dateEnd' => $dateEnd]);
    }

    // View specific college's reports
    public function viewCollege($id)
    {
        $college = College::findOrFail($id);
        return view('admin.reports.view-college', 
            ['college' => $college]);
    }
    // College Report to PDF
    public function collegesPDF()
    {
        $copyrights = $this->copyright
            ->copyrightStats($this->column);
        $patents = $this->patent
            ->patentStats($this->column);
        $caption1 = 'Copyright Statistics of Colleges';
        $caption2 = 'Patent Statistics of Colleges';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_colleges_stats_to_pdf($copyrights, $patents, 
                $caption1, $caption2));
        return $pdf->stream();
    }

    public function rangedCollegesPDF($start, $end)
    {
        $copyrights = $this->copyright
            ->rangedCopyrights($this->column, $start, $end);
        $patents = $this->patent
            ->rangedPatents($this->column, $start, $end);
        $caption1 = 'Copyright Statistics of Colleges';
        $caption2 = 'Patent Statistics of Colleges';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_colleges_stats_to_pdf($copyrights, $patents, 
                $caption1, $caption2));
        return $pdf->stream();

    }

    public function convert_colleges_stats_to_pdf($copyrights, $patents, $caption1, $caption2)
    {
        $output = '
            <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
            }
            </style>
            <h2>PUP Intellectual Property Management Office</h2>
            <h3>REPORT</h23><small>('.Carbon::now()->format('F d, Y').')</small>
            <table style="width:100%">
                <caption>'.$caption1.'</caption>  
                <tr>
                  <th class="text-center">College</th>
                  <th class="text-center">Branch</th>
                  <th class="text-center">Authors</th>
                  <th colspan="5" class="text-center">Copyright</th>
                </tr>
                <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Pending</th>
                  <th scope="col">To Submit</th>
                  <th scope="col">On Process</th>
                  <th scope="col" class="text-danger">Conflicts</th>
                  <th scope="col" class="text-success">Copyrighted</th>
                </tr>';
            
            foreach ($copyrights as $copyright) {
                $output .= '
                    <tr>
                        <td>'.$copyright->char_college_code.'</td>'.
                        '<td>'.$copyright->str_branch_name.'</td>'.
                        '<td>'.$copyright->author_count.'</td>'.
                        '<td>'.$copyright->copyright_count_pending.'</td>'.
                        '<td>'.$copyright->copyright_count_to_submit.'</td>'.
                        '<td>'.$copyright->copyright_count_on_process.'</td>'.
                        '<td>'.$copyright->copyright_count_to_submit.'</td>'.
                        '<td>'.$copyright->copyright_count_copyrighted.'</td>
                    </tr>';
            }  
              
        $output .= '</table><br><br><br>';

        $output .= '<table style="width:100%">
                <caption>'.$caption2.'</caption>  
                <tr>
                  <th class="text-center">College</th>
                  <th class="text-center">Branch</th>
                  <th class="text-center">Authors</th>
                  <th colspan="5" class="text-center">Patent</th>
                </tr>
                <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Pending</th>
                  <th scope="col">To Submit</th>
                  <th scope="col">On Process</th>
                  <th scope="col" class="text-danger">Conflicts</th>
                  <th scope="col" class="text-success">Patented</th>
                </tr>';

            foreach ($patents as $patent) {
                $output .= '
                    <tr>
                        <td>'.$patent->char_college_code.'</td>'.
                        '<td>'.$patent->str_branch_name.'</td>'.
                        '<td>'.$patent->author_count.'</td>'.
                        '<td>'.$patent->patent_count_pending.'</td>'.
                        '<td>'.$patent->patent_count_to_submit.'</td>'.
                        '<td>'.$patent->patent_count_on_process.'</td>'.
                        '<td>'.$patent->patent_count_to_submit.'</td>'.
                        '<td>'.$patent->patent_count_patented.'</td>
                    </tr>';
            }  
        $output .= '</table>';
        return $output;        
    }
}
