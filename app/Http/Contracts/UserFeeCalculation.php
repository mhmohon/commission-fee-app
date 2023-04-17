<?php
namespace App\Http\Contracts;

interface UserFeeCalculation 
{
    public function calculateFeeByUser(string $date, string $userId, string $userType, string $operationType, string $amount, string $currency): string;
}
