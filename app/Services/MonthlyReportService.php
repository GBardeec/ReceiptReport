<?php

namespace App\Services;

use App\Models\Cheque;
use Carbon\Carbon;

class MonthlyReportService
{
    public function generateReport()
    {
        $minDate = Carbon::parse(Cheque::min('check_datetime'));
        $maxDate = Carbon::parse(Cheque::max('check_datetime'));

        $months = $this->generateMonths($minDate, $maxDate);
        $shopIds = Cheque::select('shop_id')->distinct()->get()->pluck('shop_id');
        $report = $this->generateReportData($months, $shopIds);

        return $report;
    }

    protected function generateMonths(Carbon $minDate, Carbon $maxDate)
    {
        $months = [];
        $currentMonth = $minDate->copy();
        while ($currentMonth <= $maxDate) {
            $months[] = $currentMonth->format('Y-m');
            $currentMonth->addMonth();
        }

        return $months;
    }

    protected function generateReportData(array $months, $shopIds)
    {
        $report = [];

        foreach ($months as $month) {
            $report[$month] = [];
            foreach ($shopIds as $shopId) {
                $totalSum = Cheque::where('shop_id', $shopId)
                    ->whereBetween('check_datetime', [
                        $month . '-01 00:00:00',
                        $month . '-31 23:59:59',
                    ])
                    ->sum('sum');

                $report[$month][$shopId] = $totalSum;
            }
        }

        return $report;
    }
}
