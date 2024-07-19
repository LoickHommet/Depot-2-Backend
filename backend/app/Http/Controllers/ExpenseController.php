<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $expense = Expense::create([
            'amount' => $request->amount,
            'category' => $request->category,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);

        return response()->json($expense, 201);
    }
}
