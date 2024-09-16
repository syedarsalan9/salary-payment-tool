<?php

namespace App\Services;
use Carbon\Carbon;

class ValidationService
{
    public function validateYear($year)
    {
        if (!is_numeric($year) || !Carbon::createFromFormat('Y', $year)) {
            throw new Exception("Invalid year provided. Year must be in YYYY format.");
        }
    }
}
