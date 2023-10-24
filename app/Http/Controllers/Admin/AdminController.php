<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Analytics;
use App\Models\Admin\HomeMaintanance;
use App\Models\Admin\Maintanance;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Create a new controller instance.>
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth:admin');
    }

    /**
     * @Function:        <dashboard>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // Get the current date and time
        $now = Carbon::today();
        $sevenDaysAgo = $now->subDays(7);// Get the date 7 days ago from the current date
        $t30DaysAgo = $now->subDays(30);// Get the date 30 days ago from the current date
        $t365DaysAgo = $now->subDays(365);// Get the date 365 days ago from the current date

        $toDay = Maintanance::where('paid_date', $now )->get()->count();
        $last7Day = Maintanance::whereDate('paid_date', '>=',  $sevenDaysAgo )->get()->count();// Retrieve records from the last 7 days
        $last30Day = Maintanance::whereDate('paid_date', '>=',  $t30DaysAgo )->get()->count();// Retrieve records from the last 30 days
        $last365Day = Maintanance::whereDate('paid_date', '>=',  $t365DaysAgo )->get()->count();// Retrieve records from the last 365 days

        $toDayUnique = HomeMaintanance::where('paid_date',  $now )->get()->count();
        $last7DayUnique = HomeMaintanance::whereDate('paid_date', '>=',  $sevenDaysAgo )->get()->count();// Retrieve records from the last 7 days
        $last30DayUnique = HomeMaintanance::whereDate('paid_date', '>=',  $t30DaysAgo )->get()->count();// Retrieve records from the last 30 days
        $last365DayUnique = HomeMaintanance::whereDate('paid_date', '>=',  $t365DaysAgo )->get()->count();// Retrieve records from the last 365 days

        return view('admin.dashboard.index', compact( 'toDay', 'last7Day', 'last30Day', 'last365Day', 'toDayUnique', 'last7DayUnique', 'last30DayUnique', 'last365DayUnique' ));
    }
}
