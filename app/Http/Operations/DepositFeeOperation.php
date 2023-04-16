<?php

namespace App\Http\Operations;

use App\Http\Contracts\FeeOperation;

class DepositFeeOperation implements FeeOperation
{
    public function calculateCommissionFee($date, $userId, $userType, $operationType, $amount, $currency) 
    {
        $depositCommission = config('feecommision.rule.deposit');
        $commissionFee = ceil($amount * $depositCommission) / 100;
        return $commissionFee;
    }
}
