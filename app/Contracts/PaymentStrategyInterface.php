<?php

namespace App\Contracts;

interface PaymentStrategyInterface
{
    public function calculateSalaryDate(int $year, int $month);
    public function calculateBonusDate(int $year, int $month);
}