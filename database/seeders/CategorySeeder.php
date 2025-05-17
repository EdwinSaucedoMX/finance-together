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
        $categories = [
            ['name' => 'Food', 'description' => 'Groceries, restaurants, snacks', 'type' => 'OUT'],
            ['name' => 'Transportation', 'description' => 'Gas, public transport, car maintenance', 'type' => 'OUT'],
            ['name' => 'Health', 'description' => 'Medicines, doctor visits, health insurance', 'type' => 'OUT'],
            ['name' => 'Education', 'description' => 'Courses, tuition, books', 'type' => 'OUT'],
            ['name' => 'Entertainment', 'description' => 'Movies, concerts, subscriptions', 'type' => 'OUT'],
            ['name' => 'Housing', 'description' => 'Rent, utilities, home maintenance', 'type' => 'OUT'],
            ['name' => 'Clothing', 'description' => 'Clothes and shoes', 'type' => 'OUT'],
            ['name' => 'Salary', 'description' => 'Monthly income from work', 'type' => 'IN'],
            ['name' => 'Freelance', 'description' => 'Freelance or contract work income', 'type' => 'IN'],
            ['name' => 'Investments', 'description' => 'Returns from investments, dividends', 'type' => 'IN'],
            ['name' => 'Gifts', 'description' => 'Money received as gifts', 'type' => 'IN'],
            ['name' => 'Other Income', 'description' => 'Other miscellaneous income', 'type' => 'IN'],
        ];

        $now = now();

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['name' => $category['name']],
                [
                    'description' => $category['description'],
                    'type' => $category['type'],
                    'created_at' => $now,
                    'updated_at' => $now
                ]
            );
        }
    }
}
