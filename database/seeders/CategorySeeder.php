<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            // Expenses
            ['name' => 'Food', 'description' => 'Groceries, restaurants, snacks'],
            ['name' => 'Transportation', 'description' => 'Gas, public transport, car maintenance'],
            ['name' => 'Health', 'description' => 'Medicines, doctor visits, health insurance'],
            ['name' => 'Education', 'description' => 'Courses, tuition, books'],
            ['name' => 'Entertainment', 'description' => 'Movies, concerts, subscriptions'],
            ['name' => 'Housing', 'description' => 'Rent, utilities, home maintenance'],
            ['name' => 'Clothing', 'description' => 'Clothes and shoes'],

            // Income
            ['name' => 'Salary', 'description' => 'Monthly income from work'],
            ['name' => 'Freelance', 'description' => 'Freelance or contract work income'],
            ['name' => 'Investments', 'description' => 'Returns from investments, dividends'],
            ['name' => 'Gifts', 'description' => 'Money received as gifts'],
            ['name' => 'Other Income', 'description' => 'Other miscellaneous income'],
        ]);
    }
}
