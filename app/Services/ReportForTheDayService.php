<?php

namespace App\Services;

use App\Models\Cheque;
use App\Models\Shop;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\DB;

class ReportForTheDayService
{
    public function generateDailyReport($date)
    {
        $selectedDate = Carbon::createFromFormat('Y-m-d', $date);

        $shops = Shop::all();

        $report = [];

        foreach ($shops as $shop) {
            $cheques = Cheque::where('shop_id', $shop->id)
                ->whereDate('check_datetime', $selectedDate)
                ->get();

            $shopReport = [];

            foreach ($cheques as $cheque) {
                $timezone = new DateTimeZone($shop->timezone);
                $checkDatetime = Carbon::parse($cheque->check_datetime)->setTimezone($timezone);

                $shopReport[] = [
                    'id' => $cheque->id,
                    'datetime' => $checkDatetime->format('Y-m-d H:i:s '),
                    'sum' => $cheque->sum,
                ];
            }

            $report[$shop->name] = $shopReport;
        }

        return $report;
    }
}
