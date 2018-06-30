<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Nutnet\Artifico2\App\Http\Controllers\Controller;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use Analytics;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view index')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $analyticsData = Analytics::performQuery(Period::days(30), "ga:visitors, ga:sessions, ga:pageviews, ga:bounces, ga:newUsers", array('dimensions' => 'ga:date'));
            $last30days = array(
                'percentNewUsers' => 0,
                'percentBounces' => 0,
                'pageViewsPerSession' => 0,
                'date' => array(),
                'visitors' => array(),
                'sessions' => array(),
                'pageViews' => array(),
            );
            foreach ($analyticsData->rows as $row) {
                $last30days['date'][] = "'" . Carbon::createFromFormat('Ymd', $row[0])->format('d F') . "'";
                $last30days['visitors'][] = $row[1];
                $last30days['sessions'][] = $row[2];
                $last30days['pageViews'][] = $row[3];
            }
            $last30days['percentNewUsers'] = round($analyticsData['totalsForAllResults']['ga:newUsers'] / $analyticsData['totalsForAllResults']['ga:sessions'], 2) * 100;
            $last30days['percentBounces'] = round($analyticsData['totalsForAllResults']['ga:bounces'] / $analyticsData['totalsForAllResults']['ga:sessions'], 2) * 100;
            $last30days['pageViewsPerSession'] = round($analyticsData['totalsForAllResults']['ga:pageviews'] / $analyticsData['totalsForAllResults']['ga:sessions'], 2);

            $now = new \Datetime();
            $endDate = (new \Datetime())->setDate($now->format('Y'), $now->format('m'), 1)->modify('+1 month')->modify('-1 day');
            $startDate = (new \Datetime())->setDate($now->format('Y'), $now->format('m'), 1)->modify('-12 month');
            $analyticsData = \Analytics::performQuery(Period::create($startDate, $endDate), "ga:visitors, ga:sessions, ga:pageviews, ga:bounces, ga:newUsers", array('dimensions' => 'ga:year, ga:month'));
            $last12month = array(
                'percentNewUsers' => 0,
                'percentBounces' => 0,
                'pageViewsPerSession' => 0,
                'month' => array(),
                'visitors' => array(),
                'sessions' => array(),
                'visitorsPerDay' => array(),
                'sessionsPerDay' => array(),
            );
            foreach ($analyticsData->rows as $row) {
                $last12month['month'][] = "'" . date('F', mktime(0, 0, 0, $row[1])) . "'";//\DateTime::createFromFormat('!m', $row[1])->format('F');
                $last12month['visitors'][] = $row[2];
                $last12month['sessions'][] = $row[3];
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $row[1], $row[0]);
                if (date('m Y') == $row[1] . ' ' . $row[0]) {
                    $dayNumber = (int)date("j");
                    $last12month['visitorsPerDay'][] = round($row[2] / $dayNumber);
                    $last12month['sessionsPerDay'][] = round($row[3] / $dayNumber);
                } else {
                    $last12month['visitorsPerDay'][] = round($row[2] / $daysInMonth);
                    $last12month['sessionsPerDay'][] = round($row[3] / $daysInMonth);
                }
            }
            $last12month['percentNewUsers'] = round($analyticsData['totalsForAllResults']['ga:newUsers'] / $analyticsData['totalsForAllResults']['ga:sessions'], 2) * 100;
            $last12month['percentBounces'] = round($analyticsData['totalsForAllResults']['ga:bounces'] / $analyticsData['totalsForAllResults']['ga:sessions'], 2) * 100;
            $last12month['pageViewsPerSession'] = round($analyticsData['totalsForAllResults']['ga:pageviews'] / $analyticsData['totalsForAllResults']['ga:sessions'], 2);

            return view('artifico2::index.index', [
                'last30days' => $last30days,
                'last12month' => $last12month,
            ]);
        }
        catch (\Exception $e) {
            return view('artifico2::index.index', [
                'last30days'     => null,
                'last12month' => null,
            ]);
        };

    }
}
