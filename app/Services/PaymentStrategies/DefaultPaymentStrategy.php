<?php
namespace App\Services\PaymentStrategies;

use App\Contracts\PaymentStrategyInterface;
use Carbon\Carbon;

class DefaultPaymentStrategy implements PaymentStrategyInterface
{
    public function calculateSalaryDate(int $year, int $month)
    {
        $lastDay = Carbon::create($year, $month, 1)->endOfMonth();

        if ($lastDay->isWeekend()) {
            return $lastDay->subWeekday();
        }

        return $lastDay;
    }

    public function calculateBonusDate(int $year, int $month)
    {
        $bonusDay = Carbon::create($year, $month, 15);

        if ($bonusDay->isWeekend()) {
            return $bonusDay->next(Carbon::WEDNESDAY);
        }

        return $bonusDay;
    }
}
