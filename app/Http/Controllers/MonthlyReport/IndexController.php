<?php

namespace App\Http\Controllers\MonthlyReport;

use App\Http\Controllers\Controller;
use App\Services\MonthlyReportService;

class IndexController extends Controller
{
    protected $monthlyReportService;

    public function __construct(MonthlyReportService $monthlyReportService)
    {
        $this->monthlyReportService = $monthlyReportService;
    }

    public function __invoke()
    {
        return $this->monthlyReportService->generateReport();
    }
}
