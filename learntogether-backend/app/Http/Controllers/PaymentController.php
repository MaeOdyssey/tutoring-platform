<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with('session')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
    
        return $payments->map(function ($payment) {
            return [
                'id' => $payment->id,
                'amount' => $payment->amount,
                'method' => ucfirst($payment->method),
                'status' => ucfirst($payment->status),
                'session_date' => optional($payment->session)->date,
            ];
        });
    }
    
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_id' => 'required|exists:sessions,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string',
        ]);

        $payment = Payment::create([
            'user_id' => $validated['user_id'],
            'session_id' => $validated['session_id'],
            'amount' => $validated['amount'],
            'method' => $validated['method'],
            'status' => 'paid', // default value
        ]);

        return response()->json($payment, 201);
    }
}
