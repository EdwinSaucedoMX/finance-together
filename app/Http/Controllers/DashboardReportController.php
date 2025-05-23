<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class DashboardReportController extends Controller
{
    public function download()
    {
        $user = Auth::user();
        $incomes = $user->movements()->where('type', 'IN')->sum('amount');
        $expenses = $user->movements()->where('type', 'OUT')->sum('amount');
        $balance = $incomes - $expenses;

        $mostExpensiveCategory = $user->movements()
            ->where('movements.type', 'OUT')
            ->join('categories', 'movements.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category_name, movements.category_id, sum(movements.amount) as total')
            ->groupBy('movements.category_id', 'categories.name')
            ->orderBy('total', 'desc')
            ->first();

        $lessExpensiveCategory = $user->movements()
            ->where('movements.type', 'OUT')
            ->join('categories', 'movements.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category_name, movements.category_id, sum(movements.amount) as total')
            ->groupBy('movements.category_id', 'categories.name')
            ->orderBy('total', 'asc')
            ->first();

        $pdf = Pdf::loadView('reports.summary', [
            'name' => $user->name,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'balance' => $balance,
            'mostExpensiveCategory' => $mostExpensiveCategory,
            'lessExpensiveCategory' => $lessExpensiveCategory,
        ]);

        return $pdf->download('dashboard-summary.pdf');
    }
}
