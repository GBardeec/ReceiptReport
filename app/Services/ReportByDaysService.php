<?php

namespace App\Services;

use App\Models\Cheque;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportByDaysService
{
    public function generateDaysReport($year, $month)
    {
        $startOfMonth = Carbon::create($year, $month, 1, 0, 0, 0);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $uniqueDates = Cheque::select(DB::raw('DATE(check_datetime) as date'))
            ->whereBetween('check_datetime', [$startOfMonth, $endOfMonth])
            ->distinct()
            ->orderBy('date', 'asc')
            ->pluck('date');

        $shopIds = Cheque::select('shop_id')->distinct()->get()->pluck('shop_id');

        $report = [];

        foreach ($uniqueDates as $date) {
            $report[$date] = [];
            foreach ($shopIds as $shopId) {
                $totalSum = Cheque::where('shop_id', $shopId)
                    ->whereDate('check_datetime', $date)
                    ->sum('sum');

                $totalCheques = Cheque::where('shop_id', $shopId)
                    ->whereDate('check_datetime', $date)
                    ->count();

                $report[$date][$shopId] = [
                    'total_sum' => $totalSum,
                    'total_cheques' => $totalCheques,
                ];
            }
        }

        return $report;
    }

}
