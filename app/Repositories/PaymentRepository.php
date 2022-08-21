<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    public function store($request, $transaction, string $status)
    {
        $price = empty($request->downPayment) ? $request->payment : $request->downPayment;
        return Payment::create([
            'user_id' => Auth()->id(),
            'transaction_id' => $transaction->id,
            'price' => $price,
            'status' => $status
        ]);
    }
}
