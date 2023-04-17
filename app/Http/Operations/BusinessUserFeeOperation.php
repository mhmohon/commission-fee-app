<?php

namespace App\Http\Operations;

use App\Http\Contracts\UserFeeCalculation;

class BusinessUserFeeOperation implements UserFeeCalculation
{
    public function calculateFeeByUser(string $date, string $userId, string $userType, string $operationType, string $amount, string $currency): string
    {
        $withdrawCommission = config('feecommision.rule.business_withdraw');
        $commissionFee = ceil($amount * $withdrawCommission) / 100;
        return $commissionFee;
    }
}
