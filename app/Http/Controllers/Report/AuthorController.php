<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Applicant;
use App\Patent;
use App\User;
use Carbon\Carbon;
use PDF;

class AuthorController extends Controller
{  
    public $viewPath;
    public $author;  
    public function __construct()
    {
        $this->viewPath = 'admin.reports.';
        $this->author = new User;
        $this->middleware('auth');
    }

	public function listApplicants()
	{
        $authors = $this->author->authorStats();
        return view($this->viewPath.'list-authors', 
            ['authors' => $authors]);
	}

	public function viewApplicant($id)
	{
        $applicantCollection = Applicant::with(['department.college.branch'], 
            ['copyright.patent'])
            ->where('applicants.int_id', $id)
            ->get();           
        return view($this->viewPath.'view-author', 
            ['applicantCollection' => $applicantCollection]);
	}

    public function rangedAuthors(Request $request)
    {
        $this->validate($request, [
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ]);
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;
        $authors = $this->author->rangedAuthorStats($dateStart, $dateEnd);
        $dateStart = date('m/d/Y', strtotime($request->dateStart));
        $dateEnd = date('m/d/Y', strtotime($request->dateEnd));
        return view($this->viewPath.'ranged-authors', 
            ['authors' => $authors, 'dateStart' => $dateStart, 
            'dateEnd' => $dateEnd]);
    }

    # PDF Generator for Authors
    public function authorsPDF()
    {
        $authors = $this->author->authorStats();
        $caption = 'Author Records';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_all_author_records_to_pdf($authors, $caption));
        return $pdf->stream();
    }

    public function rangedAuthorsPDF($start, $end)
    {
        $authors = $this->author->rangedAuthorStats($start, $end);
        $caption = 'Author Records('.$start.' -- '.$end.')';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(
            $this->convert_all_author_records_to_pdf($authors, $caption));
        return $pdf->stream();
    }

     // HTML - PDF content converter
    // All records
    public function convert_all_author_records_to_pdf($authors, $caption)
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
                <th scope="col" class="text-center">Author Name</th>
                <th scope="col" class="text-center">Gender - Birthdate</th>
                <th scope="col" class="text-center">Type</th>
                <th scope="col" class="text-center">College - Department - Branch</th>
                <th scope="col" class="text-center">Copyrights</th>
                <th scope="col" class="text-center">Patents</th>
                <th scope="col" class="text-center">Date Registered</th>
              </tr>';
            
            foreach ($authors as $author) {
                $output .= '
                    <tr>
                        <td>'.$author->str_first_name.' '.$author->str_middle_name
                            .' '.$author->str_last_name.'</td>'.
                        '<td>'.$author->char_gender.' - '.$author->dtm_birthdate.'</td>'.
                        '<td>'.$author->char_applicant_type.'</td>'.
                        '<td>'.$author->char_department_code.' - '
                            .$author->char_college_code.' - '.$author->str_branch_name.'</td>'.
                        '<td><ul><li>'.$author->str_project_title.'</li></ul></td>'.
                        '<td><ul><li>'.$author->str_patent_project_title.'</li></ul></td>'.
                        '<td>'.date('m/d/Y', strtotime($author->created_at)).'</td>
                    </tr>';
            }  
              
        $output .= '</table>';
        return $output;
    }
}