<?php

namespace App\Http\Operations;

use App\Http\Contracts\FeeOperation;
use App\Http\Factory\UserFeeOperationFactory;

class WitdrawtFeeOperation implements FeeOperation
{
    public function calculateCommissionFee(string $date, string $userId, string $userType, string $operationType, string $amount, string $currency): string
    {
        $operation = UserFeeOperationFactory::createUserFeeOperation($userType);
        $commissionFee = $operation->calculateFeeByUser($date, $userId, $userType, $operationType, $amount, $currency);
        return $commissionFee;
    }

}
