<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Summary</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        h1 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Dashboard Summary - {{ $name }}</h1>

    <table>
        <tr>
            <th>Balance</th>
            <td>${{ number_format($balance, 2) }}</td>
        </tr>
        <tr>
            <th>Total Incomes</th>
            <td>${{ number_format($incomes, 2) }}</td>
        </tr>
        <tr>
            <th>Total Expenses</th>
            <td>${{ number_format($expenses, 2) }}</td>
        </tr>
    </table>

    <h2>Categories</h2>
    <table>
        <tr>
            <th>Most Expensive Category</th>
            <td>{{ $mostExpensiveCategory?->category_name ?? 'N/A' }}</td>
            <td>${{ number_format($mostExpensiveCategory?->total ?? 0, 2) }}</td>
        </tr>
        <tr>
            <th>Least Expensive Category</th>
            <td>{{ $lessExpensiveCategory?->category_name ?? 'N/A' }}</td>
            <td>${{ number_format($lessExpensiveCategory?->total ?? 0, 2) }}</td>
        </tr>
    </table>
</body>

</html>