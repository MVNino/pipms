<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
