<?php

namespace App\Http\Controllers\ReportForTheDay;

use App\Http\Controllers\Controller;
use App\Services\ReportForTheDayService;

class IndexController extends Controller
{
    protected $dailyReportService;

    public function __construct(ReportForTheDayService $reportForTheDayService)
    {
        $this->reportForTheDayService = $reportForTheDayService;
    }

    public function __invoke($date)
    {
        return $this->reportForTheDayService->generateDailyReport($date);
    }
}

