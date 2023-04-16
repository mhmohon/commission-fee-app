<?php

namespace App\Http\Factory;

use App\Http\Contracts\FeeOperation;
use App\Http\Operations\DepositFeeOperation;
use App\Http\Operations\WitdrawtFeeOperation;
use InvalidArgumentException;

class FeeOperationFactory 
{
    public static function createFeeOperation(string $operationType): FeeOperation
    {
        switch ($operationType) {
            case 'deposit':
                return new DepositFeeOperation();
                break;
            case 'withdraw':
                return new WitdrawtFeeOperation();
                break;
            default:
                throw new InvalidArgumentException('Invalid fee operation type');
        }
    }
}

