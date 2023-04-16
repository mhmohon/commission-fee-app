<?php
namespace App\Http\Contracts;

interface FeeOperation 
{
    public function calculateCommissionFee(string $date, string $userId, string $userType, string $operationType, float $amount, string $currency);
}
