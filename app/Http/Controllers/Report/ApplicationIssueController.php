<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;
use Carbon\Carbon;
use PDF;

class ApplicationIssueController extends Controller
{
    public $copyright;
    public $patent;
    public function __construct()
    {
        $this->copyright = new Copyright;
        $this->patent = new Patent;
        $this->middleware('auth');
    }

    public function listApplicationIssues()
    {
        $copyrights = $this->copyright->listApplicationIssues();
        $patents = $this->patent->listApplicationIssues();
    	return view('admin.reports.application-issues', 
    		['copyrights' => $copyrights, 'patents' => $patents]);
    }

    public function rangedApplicationIssues(Request $request)
    {
        $this->validate($request, [
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ]);
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;

        $copyrights = $this->copyright->listApplicationIssues($dateStart, $dateEnd);
        $patents = $this->patent->listApplicationIssues($dateStart, $dateEnd);
        return view('admin.reports.ranged-application-issues', 
            ['copyrights' => $copyrights, 'patents' => $patents, 
            'dateStart' => $dateStart, 'dateEnd' => $dateEnd]);

    }

    public function issuesPdf($start=NULL, $end=NULL)
    {
        if($start == NULL AND $end == NULL) {
            // pdf-normal records
            $copyrights = $this->copyright->listApplicationIssues();
            $patents = $this->patent->listApplicationIssues();
            $headCaption = NULL;
            $caption1 = 'Copyright Records with Application Issue';
            $caption2 = 'Patent Records with Application Issue';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(
                $this->convert_ipr_issues_to_pdf($copyrights, $patents, 
                    $headCaption, $caption1, $caption2));
            return $pdf->stream();
        }
        else {
            // pdf-ranged records
            $copyrights = $this->copyright->listApplicationIssues($start, $end);
            $patents = $this->patent->listApplicationIssues($start, $end);
            $headCaption = 'Between ('. date('F d, Y', strtotime($start)) . ' and '. date('F d, Y', strtotime($end)) .')';
            $caption1 = 'Copyright Records with Application Issue';
            $caption2 = 'Patent Records with Application Issue';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(
                $this->convert_ipr_issues_to_pdf($copyrights, $patents, 
                    $headCaption, $caption1, $caption2));
            return $pdf->stream();
        }
    }

    public function convert_ipr_issues_to_pdf($copyrights, $patents, $headCaption=NULL, $caption1, $caption2)
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
            <h3>REPORT</h3>';
            if ($headCaption != NULL) {
                $output .= '<p><b>'.$headCaption.'</b></p>';
            } else {
                $output .= 'As of '.date('F d, Y', strtotime(now()));
            }
            
            $output .= '<table style="width:100%">
                <caption>'.$caption1.'</caption>
                <tr>
                    <th scope="col">Issue</th>
                    <th scope="col">Author - Type</th>
                    <th scope="col">Department - College - Branch</th>
                    <th scope="col">Work Title</th>
                    <th scope="col">Date Requested</th>
                    <th scope="col">Date of Schedule</th>
                </tr>';
            foreach ($copyrights as $copyright) {
                $output .= '
                <tr>';
                if ($copyright->char_copyright_status == 'conflict') {
                    $output .= '<td>Unattended Appointment</td>';
                } elseif($copyright->char_copyright_status == 'to submit/conflict') {
                    $output .= '<td>Incomplete Requirements</td>';
                }

                $output .= '<td>'
                    .$copyright->applicant->user->str_first_name
                    .' '.$copyright->applicant->user->str_last_name.' - '
                    .$copyright->applicant->char_applicant_type.'</td>'.
                    '<td>'
                    .$copyright->applicant->department->char_department_code
                    .' - '.$copyright->applicant->department->college->char_college_code
                    .' - '.$copyright->applicant->department->college->branch->str_branch_name
                    .'</td>'.
                    '<td>'.$copyright->str_project_title.'</td>'.
                    '<td>'.date('m/d/Y', strtotime($copyright->created_at)).'</td>';
                if ($copyright->char_copyright_status == 'conflict') {
                    $output .= '<td>'.date('m/d/Y', strtotime($copyright->dtm_schedule)).'</td>';
                } elseif ($copyright->char_copyright_status == 'to submit/conflict') {
                    $output .= '<td>'.date('m/d/Y g:i A', strtotime($copyright->dtm_schedule)).'</td>';
                }
                $output .= '</tr>';
            }
        $output .= '</table>'; 

        // For Patent
        $output .= '
            <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
            }
            </style><br>
            <table style="width:100%">
                <caption>'.$caption2.'</caption>
                <tr>
                    <th scope="col">Issue</th>
                    <th scope="col">Author - Type</th>
                    <th scope="col">Department - College - Branch</th>
                    <th scope="col">Work Title</th>
                    <th scope="col">Date Requested</th>
                    <th scope="col">Date of Schedule</th>
                </tr>';
            foreach ($patents as $patent) {
                $output .= '
                <tr>';
                if ($patent->char_patent_status == 'conflict') {
                    $output .= '<td>Unattended Appointment</td>';
                } elseif($patent->char_patent_status == 'to submit/conflict') {
                    $output .= '<td>Incomplete Requirements</td>';
                }

                $output .= '<td>'
                    .$patent->copyright->applicant->user->str_first_name
                    .' '.$patent->copyright->applicant->user->str_last_name.' - '
                    .$patent->copyright->applicant->char_applicant_type.'</td>'.
                    '<td>'
                    .$patent->copyright->applicant->department->char_department_code
                    .' - '.$patent->copyright->applicant->department->college->char_college_code
                    .' - '.$patent->copyright->applicant->department->college->branch->str_branch_name
                    .'</td>'.
                    '<td>'.$patent->str_patent_project_title.'</td>'.
                    '<td>'.date('m/d/Y', strtotime($patent->created_at)).'</td>';
                if ($patent->char_patent_status == 'conflict') {
                    $output .= '<td>'.date('m/d/Y', strtotime($patent->dtm_schedule)).'</td>';
                } elseif ($patent->char_patent_status == 'to submit/conflict') {
                    $output .= '<td>'.date('m/d/Y g:i A', strtotime($patent->dtm_schedule)).'</td>';
                }
                $output .= '</tr>';
            }
        $output .= '</table>';
        return $output;       
    }
}
