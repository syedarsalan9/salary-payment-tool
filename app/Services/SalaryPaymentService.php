<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;

class SalaryPaymentService
{
    public function calculatePaymentDates($year)
    {
        $dates = [];

        for ($month = 1; $month <= 12; $month++) {
            $salaryDate = $this->getSalaryPaymentDate($year, $month);
            $bonusDate = $this->getBonusPaymentDate($year, $month);
            $dates[] = [
                'month' => Carbon::createFromDate($year, $month, 1)->format('F'),
                'salary_date' => $salaryDate->format('Y-m-d'),
                'bonus_date' => $bonusDate->format('Y-m-d')
            ];
        }

        return $dates;
    }

    private function getSalaryPaymentDate($year, $month)
    {
        $lastDay = Carbon::create($year, $month, 1)->endOfMonth();

        if ($lastDay->isWeekend()) {
            return $lastDay->subWeekday();
        }

        return $lastDay;
    }

    private function getBonusPaymentDate($year, $month)
    {
        $bonusDay = Carbon::create($year, $month, 15);

        if ($bonusDay->isWeekend()) {
            return $bonusDay->next(Carbon::WEDNESDAY);
        }

        return $bonusDay;
    }
}
