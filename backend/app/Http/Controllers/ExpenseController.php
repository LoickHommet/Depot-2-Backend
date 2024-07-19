<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{

    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        $category = $request->query('category');

        $query = Expense::where('user_id', $userId);

        if ($category) {
            $query->where('category_id', $category);
        }

        $expenses = $query->get();

        return response()->json($expenses);
    }

    public function getExpenseById($id)
    {
        $expense = Expense::findOrFail($id);

        return response()->json($expense);
    }

    public function getGroupedExpenses()
    {
        $expenses = Expense::all();

        $groupedExpenses = $expenses->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->date)->format('F Y');
        });

        return response()->json($groupedExpenses);
    }

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update([
            'amount' => $request->amount,
            'category' => $request->category,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return response()->json($expense, 200);
    }


    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return response()->json(null, 204);
    }
}
