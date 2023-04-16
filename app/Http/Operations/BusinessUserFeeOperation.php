<?php

namespace App\Http\Operations;

use App\Http\Contracts\UserFeeCalculation;

class BusinessUserFeeOperation implements UserFeeCalculation
{
    public function calculateFeeByUser($date, $userId, $userType, $operationType, $amount, $currency)
    {
        $withdrawCommission = config('feecommision.rule.business_withdraw');
        $commissionFee = ceil($amount * $withdrawCommission) / 100;
        return $commissionFee;
    }
}
