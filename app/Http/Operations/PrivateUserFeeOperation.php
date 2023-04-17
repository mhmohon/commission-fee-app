<?php

namespace App\Http\Operations;

use App\Http\Contracts\UserFeeCalculation;
use App\Http\Services\ExchangeRateService;
use Illuminate\Support\Facades\Cache;

class PrivateUserFeeOperation implements UserFeeCalculation
{
    public function calculateFeeByUser(string $date, string $userId, string $userType, string $operationType, string $amount, string $currency): string
    {
        $amount = app(ExchangeRateService::class)->convertToBaseCurrencyAmount($currency, $amount);
        $fees = Cache::get('fees') ?? [];
        // Calculate the commission fee
        $totalWithdrawAmount = $this->getTotalWithdrawalAmount($userId, $date, $fees);
        $remainingFreeAmount = max(0, 1000 - $totalWithdrawAmount);

        $commissionFee = $this->calculateCommissionFeeAmount($amount, $remainingFreeAmount);

        $this->insertCalculationFee($date, $userId, $operationType, $amount, $commissionFee, $fees);
        return $commissionFee;
    }

    private function getTotalWithdrawalAmount(int $userId, string $date, array $fees): float
    {
        $withdrawals = array_filter($fees, function ($fee) use ($userId, $date) {
            return $fee['userId'] == $userId && $fee['date'] >= date('Y-m-d', strtotime($date.' -1 week')) && $fee['date'] <= $date;
        });

        return array_sum(array_column($withdrawals, 'amount'));
    }

    private function calculateCommissionFeeAmount(float $amount, float $remainingFreeAmount): float
    {
        $commissionFee = max(0, (($amount - $remainingFreeAmount) * 0.3) / 100);
        return $commissionFee;
    }

    private function insertCalculationFee(string $date, string $userId, string $operationType, string $amount, string $commissionFee, array $fees): void
    {
        $fees[] = [
            'date' => $date,
            'userId' => $userId,
            'operation_type' => $operationType,
            'amount' => $amount,
            'fee_amount' => $commissionFee
        ];
        Cache::put('fees', $fees);
    }
}
