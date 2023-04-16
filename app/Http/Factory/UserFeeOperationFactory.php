<?php

namespace App\Http\Factory;

use App\Http\Contracts\UserFeeCalculation;
use App\Http\Operations\BusinessUserFeeOperation;
use App\Http\Operations\PrivateUserFeeOperation;
use InvalidArgumentException;

class UserFeeOperationFactory 
{
    public static function createUserFeeOperation(string $userType): UserFeeCalculation
    {
        switch ($userType) {
            case 'private':
                return new PrivateUserFeeOperation();
                break;
            case 'business':
                return new BusinessUserFeeOperation();
                break;
            default:
                throw new InvalidArgumentException('Invalid fee user type');
        }
    }
}

