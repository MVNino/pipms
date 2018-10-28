<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CoAuthor;
use App\College;
use App\Copyright;
use App\Patent;
use App\User;
use Carbon\Carbon;
use PDF;

class CollegeController extends Controller
{
	public $viewPath;
    public $coAuthor;
    public $copyright;
    public $college;
    public $patent;
    public $user;
    public $column;
    public $unit;
  
    public function __construct()
    {
        $this->viewPath = 'admin.reports.';
        $this->coAuthor = new CoAuthor;
        $this->copyright = new Copyright;
        $this->college = new College;
        $this->patent = new Patent;
        $this->user = new User;
        $this->column = 'colleges.char_college_code';
        $this->unit = 'colleges.int_id';
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
        // Get conflicts records
        $copyrightConflicts = $this->copyright
            ->getApplicationConflicts($this->unit, $id, 'conflict');
        $patentConflicts = $this->patent
            ->getApplicationConflicts($this->unit, $id, 'conflict');
        // Get conflict records with incomplete requirements
        $copyrightsInc = $this->copyright
            ->getApplicationConflicts($this->unit, $id, 'to submit/conflict');
        $patentsInc = $this->patent
            ->getApplicationConflicts($this->unit, $id, 'to submit/conflict');

        // IPR Data Count
        $iprDataCount = array();
        $authorCount = $this->user->countAuthors($this->unit, $id);
        $coAuthorCount = $this->coAuthor->countCoAuthors($this->unit, $id);
        $copyrightedCount = $this->copyright->countCopyrighted($this->unit, $id);
        $patentedCount = $this->patent->countPatented($this->unit, $id);
        $iprDataCount = array(
            'authorCount' => $authorCount,
            'coAuthorCount' => $coAuthorCount,
            'copyrightedCount' => $copyrightedCount,
            'patentedCount' => $patentedCount
        );
        // This college's data
        $college = College::findOrFail($id);
        // extract copyright records of this college
        $copyrights = $this->copyright
            ->copyrightsOfThisUnit($this->unit, $id);
        // extract patent records of this college
        $patents = $this->patent
            ->patentsOfThisUnit($this->unit, $id);

        // This college's departments
        $departmentCopyrights = $this->copyright
            ->miniCopyrightStats($this->unit, $id, 'departments.int_id');
        $departmentPatents = $this->patent
            ->miniPatentStats($this->unit, $id, 'departments.int_id');

        return view('admin.reports.view-college', 
            ['college' => $college, 
            'copyrights' => $copyrights, 
            'patents' => $patents, 
            'iprDataCount' => $iprDataCount, 
            'departmentCopyrights' => $departmentCopyrights, 
            'departmentPatents' => $departmentPatents, 
            'copyrightConflicts' => $copyrightConflicts, 
            'patentConflicts' => $patentConflicts, 
            'copyrightsInc' => $copyrightsInc, 
            'patentsInc' => $patentsInc]);
    }

    // View specific college's reports
    public function viewRangedCollege($id, $start, $end)
    {
        // Get conflicts records
        $copyrightConflicts = $this->copyright
            ->getApplicationConflicts($this->unit, $id);
        $patentConflicts = $this->patent
            ->getApplicationConflicts($this->unit, $id);
        // IPR Data Count
        $iprDataCount = array();
        $authorCount = $this->user->countAuthors($this->unit, $id);
        $coAuthorCount = $this->coAuthor->countCoAuthors($this->unit, $id);
        $copyrightedCount = $this->copyright->countCopyrighted($this->unit, $id);
        $patentedCount = $this->patent->countPatented($this->unit, $id);
        $iprDataCount = array(
            'authorCount' => $authorCount,
            'coAuthorCount' => $coAuthorCount,
            'copyrightedCount' => $copyrightedCount,
            'patentedCount' => $patentedCount
        );
        // This college's data
        $college = College::findOrFail($id);
        // extract copyright records of this college
        $copyrights = $this->copyright
            ->rangedCopyrightsOfThisUnit($this->unit, $id, $start, $end);
        // extract patent records of this college
        $patents = $this->patent
            ->rangedPatentsOfThisUnit($this->unit, $id, $start, $end);

        // This college's departments
        $departmentCopyrights = $this->copyright
            ->miniCopyrightStats($this->unit, $id, 'departments.int_id');
        $departmentPatents = $this->patent
            ->miniPatentStats($this->unit, $id, 'departments.int_id');

        return view('admin.reports.view-ranged-college', 
            ['college' => $college, 
            'copyrights' => $copyrights, 
            'patents' => $patents, 
            'iprDataCount' => $iprDataCount, 
            'departmentCopyrights' => $departmentCopyrights, 
            'departmentPatents' => $departmentPatents, 
            'copyrightConflicts' => $copyrightConflicts, 
            'patentConflicts' => $patentConflicts,
            'dateStart' => $start,
            'dateEnd' => $end]);
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

    public function copyrightsPDF($id, $start = NULL, $end = NULL )
    {
        $college = College::findOrFail($id);
        $caption = $college->char_college_code.' REPORT: <small>Copyright Applications under '.$college->str_college_name;
        'Copyright Report of '.$college->str_college_name;

        if ($start != NULL || $end != NULL) {
             // ranged copyright records pdf
            $copyrights = $this->copyright
                ->rangedCopyrightsOfThisUnit($this->unit, $id, $start, $end);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(
                $this->convert_copyrights_to_pdf($copyrights, $caption));
            return $pdf->stream();
        } else {
            // return copyrights pdf
            $copyrights = $this->copyright
                ->copyrightsOfThisUnit($this->unit, $id);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(
                $this->convert_copyrights_to_pdf($copyrights, $caption));
            return $pdf->stream();
        }
    }

    public function patentsPDF($id, $start = NULL, $end = NULL)
    {
        $college = College::findOrFail($id);
        $caption = $college->char_college_code.' REPORT: <small>Patent Applications under '.$college->str_college_name;

        if ($start != NULL || $end != NULL) {
            // return ranged patents pdf
            $patents = $this->patent
                ->rangedPatentsOfThisUnit($this->unit, $id, $start, $end);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(
                $this->convert_patents_to_pdf($patents, $caption));
            return $pdf->stream();
        } else {
            // return patents pdf
            $patents = $this->patent->patentsOfThisUnit($this->unit, $id);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(
                $this->convert_patents_to_pdf($patents, $caption));
            return $pdf->stream();
        }
    }

    public function iprConflictsPdf($id, $conflictType, $start = NULL, $end = NULL)
    {
        $college = College::findOrFail($id);
        if ($conflictType == 'conflict') {
            // generate to pdf 'conflict' ipr records
            if ($start != NULL || $end != NULL) {
                // return ranged ipr records 'conflict'
            } else {
                // return all ipr records 'conflict'
                $headCaption = $college->char_college_code.' REPORT: <small> Applicants who did not come on their scheduled date';
                $caption = "Applicant's Copyright Request Records";
                $copyrights = $this->copyright
                    ->getApplicationConflicts($this->unit, $id, 'conflict');
                $caption2 = "Applicant's Patent Request Records";
                $patents = $this->patent
                    ->getApplicationConflicts($this->unit, $id, 'conflict');
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML(
                    $this->convert_ipr_conflicts_to_pdf($copyrights, $patents, $headCaption, $caption, $caption2));
                return $pdf->stream();
            }
        }
        elseif ($conflictType == 'to-submit-conflict') {
            // generate to pdf 'to submit/conflict' ipr records
            if ($start != NULL || $end != NULL) {
                // return ranged ipr records

            } else {
                // return all ipr records
                // Get conflict records with incomplete requirements
                $headCaption = $college->char_college_code.' REPORT: <small> Applicants with incomplete requirements';
                $caption = "Applicant's Copyright Request Records";
                $copyrights = $this->copyright
                    ->getApplicationConflicts($this->unit, $id, 'to submit/conflict');
                $patents = $this->patent
                    ->getApplicationConflicts($this->unit, $id, 'to submit/conflict');
                $caption2 = "Applicant's Patent Request Records";
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML(
                    $this->convert_ipr_conflicts_to_pdf($copyrights, $patents, $headCaption, $caption, $caption2));
                return $pdf->stream();
            }
        }
    }

    public function collegeDeptPdf($id, $start = NULL, $end = NULL)
    {
        $college = College::findOrFail($id);
        if ($start != NULL AND $end != NULL) {
            // ranged
        } else {
            // This college's departments ipr records
            $headCaption = $college->char_college_code.' REPORT: <small> IPR Tallies of the departments/courses under '.$college->char_college_code.' college';
            $caption = $college->char_college_code.': Tallies of Copyright Records';
            $caption2 = $college->char_college_code.': Tallies of Patent Records';
            $deptCopyrights = $this->copyright
                ->miniCopyrightStats($this->unit, $id, 'departments.int_id');
            $deptPatents = $this->patent
                ->miniPatentStats($this->unit, $id, 'departments.int_id');
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(
                $this->convert_college_dept_ipr_to_pdf($deptCopyrights, $deptPatents, $headCaption, $caption, $caption2));
            return $pdf->stream();
        }
    }

    public function convert_college_dept_ipr_to_pdf($copyrights, $patents, $headCaption, $caption, $caption2) 
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
            <h3>'.$headCaption.' (as of '.Carbon::now()->format('F d, Y').').</small></h3>
            <table style="width:100%">
                <caption>'.$caption.' as of '.date('M d, Y g:iA', strtotime(now())).'</caption>
                <tr>
                  <th scope="col">Department</th>
                  <th scope="col">Copyrighted</th>
                  <th scope="col">On Its Process</th>
                  <th scope="col">Failed Requests</th>
                </tr>';
            foreach ($copyrights as $copyright) {
                $output .= '
                <tr>
                    <td>'.$copyright->char_department_code.'</td>'.
                    '<td>'.$copyright->copyrighted_count.'</td>'.
                    '<td>'.$copyright->copyright_processing_count.'</td>'.
                    '<td>'.$copyright->copyright_conflict_count.'</td>
                </tr>';
            }
        $output .= '</table><br>';

        $output .= '
            <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
            }
            </style>
            <table style="width:100%">
                <caption>'.$caption2.' as of '.date('M d, Y g:iA', strtotime(now())).'</caption>
                <tr>
                  <th scope="col">Department</th>
                  <th scope="col">Patented</th>
                  <th scope="col">On Its Process</th>
                  <th scope="col">Failed Requests</th>
                </tr>';
            foreach ($patents as $patent) {
                $output .= '
                <tr>
                    <td>'.$patent->char_department_code.'</td>'.
                    '<td>'.$patent->patented_count.'</td>'.
                    '<td>'.$patent->patent_processing_count.'</td>'.
                    '<td>'.$patent->patent_conflict_count.'</td>
                </tr>';
            }
        $output .= '</table>';   
        return $output;
    }

    public function convert_ipr_conflicts_to_pdf($copyrights, $patents, $headCaption, $caption, $caption2)
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
            <h3>'.$headCaption.' (as of '.Carbon::now()->format('F d, Y').').</small></h3>
            <table style="width:100%">
                <caption>'.$caption.' as of '.date('M d, Y g:iA', strtotime(now())).'</caption>
                <tr>
                  <th scope="col">Author Name</th>
                  <th scope="col">Department</th>
                  <th scope="col">Copyright Work Title</th>
                  <th scope="col">Date Requested</th>
                </tr>';
            foreach ($copyrights as $copyright) {
                $output .= '
                <tr>
                    <td>'.$copyright->str_first_name.' '.$copyright->str_last_name.'</td>'.
                    '<td>'.$copyright->char_department_code.'</td>'.
                    '<td>'.$copyright->str_project_title.'</td>'.
                    '<td>'.date('m/d/Y', strtotime($copyright->created_at)).'</td>
                </tr>';
            }
        $output .= '</table><br>';

        $output .= '
            <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
            }
            </style>
            <table style="width:100%">
                <caption>'.$caption2.' as of '.date('M d, Y g:iA', strtotime(now())).'</caption>
                <tr>
                  <th scope="col">Author Name</th>
                  <th scope="col">Department</th>
                  <th scope="col">Patent Work Title</th>
                  <th scope="col">Date Requested</th>
                </tr>';
            foreach ($patents as $patent) {
                $output .= '
                <tr>
                    <td>'.$patent->str_first_name.' '.$patent->str_last_name.'</td>'.
                    '<td>'.$patent->char_department_code.'</td>'.
                    '<td>'.$patent->str_patent_project_title.'</td>'.
                    '<td>'.date('m/d/Y', strtotime($patent->created_at)).'</td>
                </tr>';
            }
        $output .= '</table>';   
        return $output;

    }

    public function convert_copyrights_to_pdf($copyrights, $caption)
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
            <h3>'.$caption.' (as of '.Carbon::now()->format('F d, Y').').</small></h3>
            <table style="width:100%">
                <tr>
                  <th scope="col">Work Title</th>
                  <th scope="col">Author - Gender - Type</th>
                  <th scope="col">Process Status</th>
                  <th scope="col">Classification</th>
                  <th scope="col">Department</th>
                  <th scope="col">Date Requested</th>
                </tr>';
            foreach ($copyrights as $copyright) {
                $output .= '
                <tr>
                    <td>'.$copyright->str_project_title.'</td>'.
                    '<td>'.$copyright->str_first_name.' '.
                        $copyright->str_last_name.' - '.$copyright->char_gender.
                        ' - '.$copyright->char_applicant_type.'</td>'.
                    '<td>'.$copyright->char_copyright_status.'</td>'.
                    '<td>'.$copyright->char_project_type.'</td>'.
                    '<td>'.$copyright->char_department_code.'</td>'.
                    '<td>'.date('m/d/Y g:i A', strtotime($copyright->created_at)).'</td>
                </tr>';
            }
        $output .= '</table>';   
        return $output;
    }

    public function convert_patents_to_pdf($patents, $caption)
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
            <h3>'.$caption.' (as of '.Carbon::now()->format('F d, Y').').</small></h3>            
            <table style="width:100%">
                <tr>
                  <th scope="col">Patent Work Title</th>
                  <th scope="col">Author - Gender - Type</th>
                  <th scope="col">Process Status</th>
                  <th scope="col">Classification</th>
                  <th scope="col">Department</th>
                  <th scope="col">Date Requested</th>
                </tr>';
            foreach ($patents as $patent) {
                $output .= '
                <tr>
                    <td>'.$patent->str_patent_project_title.'</td>'.
                    '<td>'.$patent->str_first_name.' '.
                        $patent->str_last_name.' - '.$patent->char_gender.
                        ' - '.$patent->char_applicant_type.'</td>'.
                    '<td>'.$patent->char_patent_status.'</td>'.
                    '<td>'.$patent->char_project_type.'</td>'.
                    '<td>'.$patent->char_department_code.'</td>'.
                    '<td>'.date('m/d/Y g:i A', strtotime($patent->created_at)).'</td>
                </tr>';
            }
        $output .= '</table>';   
        return $output;
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
            <h3>REPORT</h3><small>('.Carbon::now()->format('F d, Y').')</small>
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
                        '<td>'.$copyright->copyright_count_to_conflict.'</td>'.
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
                        '<td>'.$patent->patent_count_to_conflict.'</td>'.
                        '<td>'.$patent->patent_count_patented.'</td>
                    </tr>';
            }  
        $output .= '</table>';
        return $output;        
    }
}
