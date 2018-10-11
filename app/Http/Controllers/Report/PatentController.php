<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;
use Carbon\Carbon;
use PDF;

class PatentController extends Controller
{
    public $viewPath;
    public $patent;
    # Controller for Patented Reports
    public function __construct()
    {
        $this->viewPath = 'admin.reports.';
        $this->patent = new Patent;
        $this->middleware('auth');
    }
    public function listPatents()
    {
        $patents = $this->patent->allRecords();
        return view('admin.reports.list-patent', ['patents' => $patents]);
    }

    public function viewPatent($id)
    {
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.reports.view-patent', 
            ['patentCollection' => $patentCollection]);
    }

    public function rangedPatents(Request $request)
    {
        $this->validate($request, [
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ]);
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;
        $patents = $this->patent
            ->rangeAllRecords($dateStart, $dateEnd);
        $dateStart = date('m/d/Y', strtotime($request->dateStart));
        $dateEnd = date('m/d/Y', strtotime($request->dateEnd));
        return view($this->viewPath.'ranged-patents', 
            ['patents' => $patents, 'dateStart' => $dateStart, 
            'dateEnd' => $dateEnd]);
    }

    # PDF Generator for Patents
    // All records
    public function patentsPDF()
    {
        $patents = $this->patent->allRecords();
        $caption = 'Patent Records';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_all_patent_records_to_pdf($patents, $caption));
        return $pdf->stream();

    }

    public function rangedPatentsPDF($start, $end)
    {
        $patents = $this->patent->rangeAllRecords($start, $end);
        $caption = 'Patent Records('.$start.' -- '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_all_patent_records_to_pdf($patents, $caption));
        return $pdf->stream();
    }

    // Pending
    public function pendingPatentsPDF()
    {
        $patents = Patent::where('char_patent_status', 'pending')
            ->get();
        $caption = 'Pending Requests for Patent';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_patent_records_to_pdf($patents, $caption));
        return $pdf->stream();

    }

    public function rangedPendingPatentsPDF($start, $end)
    {
        $patents = $this->patent
            ->rangeAllRecordsWithStatus('pending', $start, $end);
        $caption = 'Pending Requests for Patent
                    ('.$start.' - '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_patent_records_to_pdf($patents, $caption));
        return $pdf->stream();
    }

    // To Submit
    public function toSubmitPatentsPDF()
    {
        $patents = Patent::where('char_patent_status', 'to submit')
            ->get();
        $caption = 'Patent Records(To Submit)';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_patent_records_to_pdf($patents, $caption));
        return $pdf->stream();
    }

    public function rangedToSubmitPatentsPDF($start, $end)
    {
        $patents = $this->patent
            ->rangeAllRecordsWithStatus('to submit', $start, $end);
        $caption = 'To Submit Requests for Patent
                    ('.$start.' - '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_patent_records_to_pdf($patents, $caption));
        return $pdf->stream();
    }

    // On Process
    public function onProcessPatentsPDF()
    {
        $patents = Patent::where('char_patent_status', 'on process')
            ->get();
        $caption = 'Patent Records(On Process)';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_patent_records_to_pdf($patents, $caption));
        return $pdf->stream();
    }

    public function rangedOnProcessPatentsPDF($start, $end)
    {
        $patents = $this->patent
            ->rangeAllRecordsWithStatus('on process', $start, $end);
        $caption = 'On Process Requests for Patent
                    ('.$start.' ~ '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_patent_records_to_pdf($patents, $caption));
        return $pdf->stream();
    }

    public function patentedPDF()
    {
        $patents = Patent::where('char_patent_status', 'patented')
            ->get();
        $caption = 'Patented Works';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_patented_records_to_pdf($patents, $caption));
        return $pdf->stream();
    }

    public function rangedPatentedPDF($start, $end)
    {
        $patents = $this->patent
            ->rangeAllRecordsWithStatus('patented', $start, $end);
        $caption = 'Patented Works('.$start.' - '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_patented_records_to_pdf($patents, $caption));
        return $pdf->stream();
    }

    // HTML - PDF content converter
    // All records
    public function convert_all_patent_records_to_pdf($patents, $caption)
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
                <th scope="col">Patent Project Title</th>
                <th scope="col">Type</th>
                <th scope="col">Date Requested</th>
                <th scope="col">Status</th>
                <th scope="col">Applicant Name - Type</th>
                <th scope="col">Department - College - Branch</th>
              </tr>';
            
            foreach ($patents as $patent) {
                $output .= '
                    <tr>
                        <td>'.$patent->str_patent_project_title.'</td>'.
                        '<td>'.$patent->projectType->char_project_type.'</td>'.
                        '<td>'.$patent->created_at->format('m/d/Y g:i A').'</td>'.
                        '<td>'.$patent->char_patent_status.'</td>'.
                        '<td>'.$patent->copyright->applicant->user->str_first_name.' '.$patent->copyright->applicant->user->str_middle_name.' '.$patent->copyright->applicant->user->str_last_name.' - '.$patent->copyright->applicant->char_applicant_type.'</td>'.
                        '<td>'.$patent->copyright->applicant->department->char_department_code.' - '.$patent->copyright->applicant->department->college->char_college_code.' - '.$patent->copyright->applicant->department->college->branch->str_branch_name.'</td>
                    </tr>';
            }  
              
        $output .= '</table>';
        return $output;
    }

    // Pending-To Submit-On Process
    public function convert_patent_records_to_pdf($patents, $caption)
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
                <th scope="col">Patent Project Title</th>
                <th scope="col">Type</th>
                <th scope="col">Date Requested</th>
                <th scope="col">Applicant Name - Type</th>
                <th scope="col">Department - College - Branch</th>
              </tr>';
            
            foreach ($patents as $patent) {
                $output .= '
                    <tr>
                        <td>'.$patent->str_patent_project_title.'</td>'.
                        '<td>'.$patent->projectType->char_project_type.'</td>'.
                        '<td>'.$patent->created_at->format('m/d/Y g:i A').'</td>'.
                        '<td>'.$patent->copyright->applicant->user->str_first_name.' '.$patent->copyright->applicant->user->str_middle_name.' '.$patent->copyright->applicant->user->str_last_name.' - '.$patent->copyright->applicant->char_applicant_type.'</td>'.
                        '<td>'.$patent->copyright->applicant->department->char_department_code.' - '.$patent->copyright->applicant->department->college->char_college_code.' - '.$patent->copyright->applicant->department->college->branch->str_branch_name.'</td>
                    </tr>';
            }  
              
        $output .= '</table>';
        return $output;
    }

    // Patented
    public function convert_patented_records_to_pdf($patents, $caption)
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
                <th scope="col">Patent Project Title</th>
                <th scope="col">Type</th>
                <th scope="col">Date Requested</th>
                <th scope="col">Date Patented</th>
                <th scope="col">Applicant Name - Type</th>
                <th scope="col">Department - College - Branch</th>
              </tr>';
            
            foreach ($patents as $patent) {
                $output .= '
                    <tr>
                        <td>'.$patent->str_patent_project_title.'</td>'.
                        '<td>'.$patent->projectType->char_project_type.'</td>'.
                        '<td>'.$patent->created_at->format('m/d/Y g:i A').'</td>'.
                        '<td>'.$patent->dtm_patented->format('m/d/Y g:i A').'</td>'.
                        '<td>'.$patent->copyright->applicant->user->str_first_name.' '.$patent->copyright->applicant->user->str_middle_name.' '.$patent->copyright->applicant->user->str_last_name.' - '.$patent->copyright->applicant->char_applicant_type.'</td>'.
                        '<td>'.$patent->copyright->applicant->department->char_department_code.' - '.$patent->copyright->applicant->department->college->char_college_code.' - '.$patent->copyright->applicant->department->college->branch->str_branch_name.'</td>
                    </tr>';
            }  
              
        $output .= '</table>';
        return $output;
    }
}
