<?php

namespace App\Http\Operations;

use App\Http\Contracts\FeeOperation;

class DepositFeeOperation implements FeeOperation
{
    public function calculateCommissionFee(string $date, string $userId, string $userType, string $operationType, string $amount, string $currency): string
    {
        $depositCommission = config('feecommision.rule.deposit');
        $commissionFee = ceil($amount * $depositCommission) / 100;
        return $commissionFee;
    }
}
