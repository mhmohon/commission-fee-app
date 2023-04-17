<?php
namespace App\Http\Contracts;

interface FeeOperation 
{
    public function calculateCommissionFee(string $date, string $userId, string $userType, string $operationType, string $amount, string $currency): string;
}
