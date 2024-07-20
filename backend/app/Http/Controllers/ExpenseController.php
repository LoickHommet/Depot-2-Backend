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
            $query->where('category', $category);
        }

        $expenses = $query->get();

        return response()->json($expenses);
    }

    public function getCategories(Request $request)
    {
        $userId = $request->query('user_id');

        $categories = Expense::where('user_id', $userId)
            ->select('category')
            ->distinct()
            ->get()
            ->pluck('category');

        return response()->json($categories);
    }

    public function getExpenseById($id)
    {
        $expense = Expense::findOrFail($id);

        return response()->json($expense);
    }

    public function getMonthlyExpenses(Request $request)
    {
        $userId = $request->query('user_id');

        $expenses = Expense::where('user_id', $userId)
            ->selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();

        return response()->json($expenses);
    }

    public function getCategoryExpenses(Request $request)
    {
        $userId = $request->query('user_id');
    
        try {
            $expenses = Expense::where('user_id', $userId)
                ->get();
    
            $categoryExpenses = $expenses->groupBy('category')->map(function ($group) {
                return [
                    'name' => $group->first()->category,
                    'total' => $group->sum('amount')
                ];
            })->values();
    
            return response()->json($categoryExpenses);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching expenses'], 500);
        }
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
