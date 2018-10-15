<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Copyright;
use App\Patent;
use App\User;
use App\Copyright;
use App\Patent;
use App\Charts\MonthlyCopyrightRequests;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chart = new MonthlyCopyrightRequests;
        $chart->labels(['One', 'Two', 'Three'])
                ->dataset('My dataset 1', 'line', [1, 2, 3, 4]);
                // $chart->setTitle('My first lara chart')
                // ->setLabels(['First', 'Second', 'Third'])
                // ->setValues([5, 10, 20])
                // ->setDimensions(1000, 500)
                // ->setResponsive(true);

        $title = 'Dashboard';
        $usersCount = User::count();
        $copyrightCount = Copyright::count();
        $patentCount = Patent::count();
        return view('admin.dashboard', ['title' => $title, 
            'usersCount' => $usersCount, 'chart' => $chart, 'copyrightCount'=>$copyrightCount, 'patentCount'=>$patentCount]);  


    }

    public function getMonthlyCopyrightPatents()
    {
        $copyright = $this->getMonthlyCopyrightData();
        $patent = $this->getMonthlyPatentData();
        
        return $data = array(
            $copyright,
            $patent
        );
    }

    // Monthly Copyrights
    public function getAllMonths()
    {
        $month_array = array();
        $months = Copyright::orderBy('created_at')->pluck('created_at');
        $months = json_decode($months);
        $months;
        if(!empty($months)) {
            foreach($months as $unformattedDate) {
                $date = new \DateTime($unformattedDate->date);
                // $month = $date->format(format:'');
                $monthName = $date->format('M');
                $monthNo = $date->format('m');

                $month_array[$monthNo] = [$monthName];

            }
        } 
        return $month_array;
    }

    public function getMonthlyDataCount($month)
    {
        $copyright_count = Copyright::whereMonth('created_at', $month)
            ->get()
            ->count();
        return $copyright_count;
    }

    public function getMonthlyCopyrightData()
    {
        $monthlyCopyrightCountArray = array();
        $monthArray = $this->getAllMonths();
        $monthNameArray = array();
        if(!empty($monthArray)) {
            foreach($monthArray as $monthNo => $monthName) {
                $monthlyDataCount = $this->getMonthlyDataCount($monthNo);
                array_push($monthlyCopyrightCountArray, $monthlyDataCount);
                array_push($monthNameArray, $monthName);
            }
        }

        $max_no = max($monthlyCopyrightCountArray);
        $maxMonthlyCopyright = round(( $max_no + 10/2 ) / 10) * 10;
        $month_array = $this->getAllMonths();
        $monthlyCopyrightCountArraydata = array(
            'months' => $monthNameArray,
            'copyright_count_data' => $monthlyCopyrightCountArray,
            'maxMonthlyCopyright' => $max_no 
        );
        return $monthlyCopyrightCountArraydata;
    }

    // Monthly Patents
    public function getMonthlyPatents()
    {
        // For monthly patent data
        return $this->getMonthlyPatentData();
    }
    public function getPatentAllMonths()
    {
        $month_array = array();
        $months = Patent::orderBy('created_at')->pluck('created_at');
        $months = json_decode($months);
        $months;
        if(!empty($months)) {
            foreach($months as $unformattedDate) {
                $date = new \DateTime($unformattedDate->date);
                // $month = $date->format(format:'');
                $monthName = $date->format('M');
                $monthNo = $date->format('m');

                $month_array[$monthNo] = [$monthName];

            }
        } 
        return $month_array;
    }

    public function getPatentMonthlyDataCount($month)
    {
        $patent_count = Patent::whereMonth('created_at', $month)
            ->get()
            ->count();
        return $patent_count;
    }

    public function getMonthlyPatentData()
    {
        $monthlyPatentCountArray = array();
        $monthArray = $this->getPatentAllMonths();
        $monthNameArray = array();
        if(!empty($monthArray)) {
            foreach($monthArray as $monthNo => $monthName) {
                $monthlyDataCount = $this->getPatentMonthlyDataCount($monthNo);
                array_push($monthlyPatentCountArray, $monthlyDataCount);
                array_push($monthNameArray, $monthName);
            }
        }

        $max_no = max($monthlyPatentCountArray);
        $month_array = $this->getAllMonths();
        $monthlyPatentCountArraydata = array(
            'patent_months' => $monthNameArray,
            'patent_count_data' => $monthlyPatentCountArray,
            'maxMonthlyPatent' => $max_no 
        );
        return $monthlyPatentCountArraydata;
    }

    #2 Count this month's copyrights and patents
    // public function
}
