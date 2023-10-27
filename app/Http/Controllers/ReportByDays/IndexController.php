<?php

namespace App\Http\Controllers\ReportByDays;

use App\Http\Controllers\Controller;
use App\Services\ReportByDaysService;

class IndexController extends Controller
{
    protected $reportByDaysService;

    public function __construct(ReportByDaysService $reportByDaysService)
    {
        $this->reportByDaysService = $reportByDaysService;
    }

    public function __invoke($month)
    {
        list($year, $month) = explode('-', $month);
        return $this->reportByDaysService->generateDaysReport($year, $month);
    }
}
