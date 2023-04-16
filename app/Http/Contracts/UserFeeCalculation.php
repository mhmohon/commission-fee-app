<?php
namespace App\Http\Contracts;

interface UserFeeCalculation 
{
    public function calculateFeeByUser($date, $userId, $userType, $operationType, $amount, $currency);
}
