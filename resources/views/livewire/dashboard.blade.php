<div>
    <span class="text-2xl font-bold text-gray-900 dark:text-white">
        Welcome again {{$name}}!
    </span>
    <div class="w-full max-w-2xl p-4 bg-white rounded-xl shadow" wire:poll>
        <div class="min-w-96 max-w-96 min-h-96 max-h-96">
            <canvas id="financeChart" class="min-w-94 max-w-96 min-h-96 max-h-96 pointer-events-none"></canvas>
        </div>
    </div>

</div>

{{-- 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const canvas = document.getElementById('financeChart');
            // Remove explicit width and height to let Chart.js handle sizing responsively
            // canvas.width = 600;
            // canvas.height = 300;
        
            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        '2025-05-01\nSalary',
                        '2025-05-03\nGroceries',
                        '2025-05-05\nFreelance Project',
                        '2025-05-07\nUtilities'
                    ],
                    datasets: [{
                        label: 'Amount',
                        data: [2500, -110, 800, -90],
                        backgroundColor: [
                            'rgba(34,197,94,0.7)',   // Income
                            'rgba(239,68,68,0.7)',   // Expense
                            'rgba(34,197,94,0.7)',   // Income
                            'rgba(239,68,68,0.7)'    // Expense
                        ],
                        borderColor: [
                            'rgba(34,197,94,1)',
                            'rgba(239,68,68,1)',
                            'rgba(34,197,94,1)',
                            'rgba(239,68,68,1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true, // Allow custom sizing
                    plugins: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'Movements for May 2025'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let value = context.parsed.y;
                                    return `$${value.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Amount ($)'
                            }
                        }
                    }
                }
            });
        });
    </script> 
--}}