<div>
    <span class="text-2xl font-bold text-gray-900 dark:text-white">
        Welcome again {{$name}}!
    </span>
    <div>

        <a href="{{ route('dashboard.report.download') }}" target="_blank">
            <flux:button type="button" class="mt-4" color="primary" size="sm">
                Download Report
            </flux:button>
        </a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
        <!-- Balance (full width, at the start) -->
        <div class="lg:col-span-2">
            <div
                class="w-full p-6 bg-white rounded-xl shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v0"></path>
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"></circle>
                    </svg>
                    Balance
                </h2>
                <div class="flex flex-col bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-700 dark:text-gray-200">
                            Balance
                        </span>
                        <span class="text-lg font-bold text-purple-600 dark:text-purple-400">
                            ${{ number_format($balance, 2) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- First container -->
        <div class="flex flex-col gap-6">
            <div
                class="w-full p-6 bg-white rounded-xl shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4l-3-3"></path>
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"></circle>
                    </svg>
                    Total Incomes
                </h2>
                <div class="flex flex-col bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-700 dark:text-gray-200">
                            Incomes
                        </span>
                        <span class="text-lg font-bold text-green-600 dark:text-green-400">
                            ${{ number_format($incomes, 2) }}
                        </span>
                    </div>
                </div>
            </div>
            <div
                class="w-full p-6 bg-white rounded-xl shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"></path>
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"></circle>
                    </svg>
                    Most Expensive Category
                </h2>
                <div class="flex flex-col bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-700 dark:text-gray-200">
                            {{$mostExpensiveCategory->category_name}}
                        </span>
                        <span class="text-lg font-bold text-red-600 dark:text-red-400">
                            ${{$mostExpensiveCategory->total}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Second container -->
        <div class="flex flex-col gap-6">
            <div
                class="w-full p-6 bg-white rounded-xl shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"></path>
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"></circle>
                    </svg>
                    Total Expenses
                </h2>
                <div class="flex flex-col bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-700 dark:text-gray-200">
                            Expenses
                        </span>
                        <span class="text-lg font-bold text-blue-600 dark:text-blue-400">
                            ${{ number_format($expenses, 2) }}
                        </span>
                    </div>
                </div>
            </div>
            <div
                class="w-full p-6 bg-white rounded-xl shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l-3-3"></path>
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"></circle>
                    </svg>
                    Least Expensive Category
                </h2>
                <div class="flex flex-col bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-700 dark:text-gray-200">
                            {{$lessExpensiveCategory->category_name}}
                        </span>
                        <span class="text-lg font-bold text-yellow-600 dark:text-yellow-400">
                            ${{$lessExpensiveCategory->total}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>