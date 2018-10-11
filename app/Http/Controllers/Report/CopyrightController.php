<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;
use Carbon\Carbon;
use PDF;

class CopyrightController extends Controller
{
    # Controller for Copyright records
	public $viewPath;
	public $copyright;
    
    public function __construct()
    {
    	$this->viewPath = 'admin.reports.';
    	$this->copyright = new Copyright;
        $this->middleware('auth');
    }

    public function listCopyrights()
    {
    	// extract all records(eager loading)
    	$copyrights = $this->copyright->allRecords();

        return view($this->viewPath.'list-copyright', 
        	['copyrights' => $copyrights]);
    }

    public function viewCopyright($id)
    {   
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'copyrighted')
            ->where('dtm_copyrighted', '!=', NULL)
            ->where('int_id', $id)
            ->get();

        return view($this->viewPath.'view-copyright', 
            ['copyrightCollection' => $copyrightCollection]);
    }

    public function rangedCopyrights(Request $request)
    {
        $this->validate($request, [
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ]);
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;

        $copyrights = $this->copyright
            ->rangeAllRecords($dateStart, $dateEnd);
        $dateStart = date('m/d/Y', strtotime($request->dateStart));
        $dateEnd = date('m/d/Y', strtotime($request->dateEnd));
        return view($this->viewPath.'ranged-copyrights', 
            ['copyrights' => $copyrights,
                'dateStart' => $dateStart, 'dateEnd' => $dateEnd]);
    }

    # PDF Generator for Copyrights
    // All records
    public function copyrightsPDF()
    {
        $copyrights = $this->copyright->allRecords();
        $caption = 'Copyright Records';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_all_copyright_records_to_pdf($copyrights, $caption));
        return $pdf->stream();
    }

    public function rangedCopyrightsPDF($start, $end)
    {
        $copyrights = $this->copyright->rangeAllRecords($start, $end);
        $caption = 'Copyright Records('.$start.' -- '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_all_copyright_records_to_pdf($copyrights, $caption));
        return $pdf->stream();

    }

    // Pending
    public function pendingCopyrightsPDF()
    {
        $copyrights = Copyright::where('char_copyright_status', 'pending')
            ->get();
        $caption = 'Pending Requests for Copyright Registration';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_copyright_records_to_pdf($copyrights, $caption));
        return $pdf->stream();

    }

    public function rangedPendingCopyrightsPDF($start, $end)
    {
        $copyrights = $this->copyright
            ->rangeAllRecordsWithStatus('pending', $start, $end);
        $caption = 'Pending Requests for Copyright Registration
                    ('.$start.' - '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_copyright_records_to_pdf($copyrights, $caption));
        return $pdf->stream();
    }

    // To Submit
    public function toSubmitCopyrightsPDF()
    {
        $copyrights = Copyright::where('char_copyright_status', 'to submit')
            ->get();
        $caption = 'Copyright Records(To Submit)';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_copyright_records_to_pdf($copyrights, $caption));
        return $pdf->stream();

    }

    public function rangedToSubmitCopyrightsPDF($start, $end)
    {
        $copyrights = $this->copyright
            ->rangeAllRecordsWithStatus('to submit', $start, $end);
        $caption = 'Copyright Records(To Submit '.$start.' - '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_copyright_records_to_pdf($copyrights, $caption));
        return $pdf->stream();
    }

    // On Process
    public function onProcessCopyrightsPDF()
    {
        $copyrights = Copyright::where('char_copyright_status', 'on process')
            ->get();
        $caption = 'Copyright Records(On Process)';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_copyright_records_to_pdf($copyrights, $caption));
        return $pdf->stream();

    }

    public function rangedOnProcessCopyrightsPDF($start, $end)
    {
        $copyrights = $this->copyright
            ->rangeAllRecordsWithStatus('on process', $start, $end);
        $caption = 'Copyright Records(On Process '.$start.' - '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_copyright_records_to_pdf($copyrights, $caption));
        return $pdf->stream();
    }

    public function copyrightedPDF()
    {
        $copyrights = Copyright::where('char_copyright_status', 'copyrighted')
            ->get();
        $caption = 'Copyrighted Works';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_copyrighted_records_to_pdf($copyrights, $caption));
        return $pdf->stream();
    }

    public function rangedCopyrightedPDF($start, $end)
    {
        $copyrights = $this->copyright
            ->rangeAllRecordsWithStatus('copyrighted', $start, $end);
        $caption = 'Copyrighted Works('.$start.' - '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_copyrighted_records_to_pdf($copyrights, $caption));
        return $pdf->stream();
    }

    // HTML - PDF content converter
    // All records
    public function convert_all_copyright_records_to_pdf($copyrights, $caption)
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
                <caption>'.$caption.'</caption>
              <tr>
                <th scope="col">Project Title</th>
                <th scope="col">Type</th>
                <th scope="col">Date Requested</th>
                <th scope="col">Status</th>
                <th scope="col">Applicant Name - Type</th>
                <th scope="col">Department - College - Branch</th>
              </tr>';
            
            foreach ($copyrights as $copyright) {
                $output .= '
                    <tr>
                        <td>'.$copyright->str_project_title.'</td>'.
                        '<td>'.$copyright->projectType->char_project_type.'</td>'.
                        '<td>'.$copyright->created_at->format('m/d/Y g:i A').'</td>'.
                        '<td>'.$copyright->char_copyright_status.'</td>'.
                        '<td>'.$copyright->applicant->user->str_first_name.' '.$copyright->applicant->user->str_middle_name.' '.$copyright->applicant->user->str_last_name.' - '.$copyright->applicant->char_applicant_type.'</td>'.
                        '<td>'.$copyright->applicant->department->char_department_code.' - '.$copyright->applicant->department->college->char_college_code.' - '.$copyright->applicant->department->college->branch->str_branch_name.'</td>
                    </tr>';
            }  
              
        $output .= '</table>';
        return $output;

    }

    public function convert_copyright_records_to_pdf($copyrights, $caption)
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
                <caption>'.$caption.'</caption>
              <tr>
                <th scope="col">Project Title</th>
                <th scope="col">Type</th>
                <th scope="col">Date Requested</th>
                <th scope="col">Applicant Name - Type</th>
                <th scope="col">Department - College - Branch</th>
              </tr>';
            
            foreach ($copyrights as $copyright) {
                $output .= '
                    <tr>
                        <td>'.$copyright->str_project_title.'</td>'.
                        '<td>'.$copyright->projectType->char_project_type.'</td>'.
                        '<td>'.$copyright->created_at->format('m/d/Y g:i A').'</td>'.
                        '<td>'.$copyright->applicant->user->str_first_name.' '.$copyright->applicant->user->str_middle_name.' '.$copyright->applicant->user->str_last_name.' - '.$copyright->applicant->char_applicant_type.'</td>'.
                        '<td>'.$copyright->applicant->department->char_department_code.' - '.$copyright->applicant->department->college->char_college_code.' - '.$copyright->applicant->department->college->branch->str_branch_name.'</td>
                    </tr>';
            }  
              
        $output .= '</table>';
        return $output;
    }

    public function convert_copyrighted_records_to_pdf($copyrights, $caption)
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
            <h3>REPORT</h3><small>('.Carbon::now()->format('F d, Y').')</small>
            <table style="width:100%">
                <caption>'.$caption.'</caption>
              <tr>
                <th scope="col">Project Title</th>
                <th scope="col">Type</th>
                <th scope="col">Date Requested</th>
                <th scope="col">Date Copyrighted</th>
                <th scope="col">Applicant Name - Type</th>
                <th scope="col">Department - College - Branch</th>
              </tr>';
            
            foreach ($copyrights as $copyright) {
                $output .= '
                    <tr>
                        <td>'.$copyright->str_project_title.'</td>'.
                        '<td>'.$copyright->projectType->char_project_type.'</td>'.
                        '<td>'.$copyright->created_at->format('m/d/Y g:i A').'</td>'.
                        '<td>'.$copyright->dtm_copyrighted->format('m/d/Y g:i A').'</td>'.
                        '<td>'.$copyright->applicant->user->str_first_name.' '.$copyright->applicant->user->str_middle_name.' '.$copyright->applicant->user->str_last_name.' - '.$copyright->applicant->char_applicant_type.'</td>'.
                        '<td>'.$copyright->applicant->department->char_department_code.' - '.$copyright->applicant->department->college->char_college_code.' - '.$copyright->applicant->department->college->branch->str_branch_name.'</td>
                    </tr>';
            }  
              
        $output .= '</table>';
        return $output;
    }
}