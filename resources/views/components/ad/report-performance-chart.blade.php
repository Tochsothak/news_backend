<div class="lg:col-span-2 rounded-xl border border-border bg-card shadow-sm p-5 flex flex-col h-full" x-data="{ clientFilter: 'all' }">

    {{-- Header Area --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-3">
        <h2 class="text-base font-semibold text-foreground">Performance Over Time</h2>

        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            {{-- NEW: Client / Campaign Filter --}}
            <div class="relative">
                <select x-model="clientFilter" @change="updateChartData(clientFilter)" class="appearance-none rounded-lg border border-border bg-background pl-3 pr-8 py-1.5 text-xs font-medium text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="all">All Clients (Aggregate)</option>
                    <option value="canadia-bank">Canadia Bank</option>
                    <option value="smart">Smart Axiata</option>
                    <option value="aba">ABA Bank</option>
                    <option value="urbanland">Urbanland</option>
                    <option value="ocic">OCIC</option>
                    <option value="koh-pich">Koh Pich</option>
                    <option value="koh-norea">Koh Norea</option>
                    <option value="tia-city">TIA City</option>
                    <option value="chhroy-chhongva">Chhroy Chhongva</option>
                    <option value="tourism-city">Tourism City</option>

                </select>
                <i class="ph-bold ph-caret-down absolute right-2.5 top-1/2 -translate-y-1/2 text-muted-foreground text-[10px] pointer-events-none"></i>
            </div>

            {{-- Legend --}}
            <div class="flex items-center gap-3 text-xs font-medium">
                <div class="flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-primary"></span>
                    <span class="text-muted-foreground">Impressions</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    <span class="text-muted-foreground">Clicks</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart Canvas --}}
    <div class="relative flex-1 min-h-[300px] w-full">
        <canvas id="performanceChart"></canvas>
    </div>
</div>

@push('scripts')
<script>
    // Define the chart variable globally so our update function can access it
    let performanceChartInstance = null;

    document.addEventListener('DOMContentLoaded', function() {
        const primaryColor = '#3b82f6';
        const accentColor = '#8b5cf6';
        const gridColor = 'rgba(148, 163, 184, 0.1)';
        const textColor = '#94a3b8';

        const ctxPerf = document.getElementById('performanceChart').getContext('2d');

        // Initialize the Chart
        performanceChartInstance = new Chart(ctxPerf, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [
                    {
                        label: 'Impressions',
                        data: [12000, 19000, 15000, 22000, 28000, 35000, 31000],
                        borderColor: primaryColor,
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Clicks',
                        data: [150, 230, 180, 320, 450, 600, 480],
                        borderColor: accentColor,
                        backgroundColor: accentColor,
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: { grid: { display: false, drawBorder: false }, ticks: { color: textColor } },
                    y: { type: 'linear', display: true, position: 'left', grid: { color: gridColor, drawBorder: false }, ticks: { color: textColor } },
                    y1: { type: 'linear', display: true, position: 'right', grid: { display: false }, ticks: { color: textColor } }
                }
            }
        });
    });

    // NEW: Function to update chart data when the select dropdown changes
    function updateChartData(client) {
        if (!performanceChartInstance) return;

        // Dummy data representing different database queries
        const mockDatabase = {
            'all': {
                impressions: [12000, 19000, 15000, 22000, 28000, 35000, 31000],
                clicks: [150, 230, 180, 320, 450, 600, 480]
            },
            'canadia-bank': {
                impressions: [10000, 15000, 12000, 20000, 25000, 30000, 27000],
                clicks: [100, 200, 150, 300, 400, 550, 450]
            },
            'smart': {
                impressions: [5000, 8000, 6000, 10000, 15000, 18000, 16000],
                clicks: [80, 120, 90, 160, 240, 310, 280]
            },
            'aba': {
                impressions: [4000, 6000, 5000, 7000, 8000, 9500, 8500],
                clicks: [45, 65, 55, 85, 110, 140, 120]
            },
            'urbanland': {
                impressions: [3000, 5000, 4000, 5000, 5000, 7500, 6500],
                clicks: [25, 45, 35, 75, 100, 150, 80]
            },
            'ocic': {
                impressions: [2000, 3000, 2500, 4000, 4500, 6000, 5500],
                clicks: [15, 30, 20, 50, 80, 120, 90]
            },
            'koh-pich': {
                impressions: [1000, 2000, 1500, 3000, 3500, 5000, 4500],
                clicks: [5, 20, 10, 40, 60, 100, 70]
            },
            'koh-norea': {
                impressions: [800, 1500, 1200, 2500, 3000, 4500, 4000],
                clicks: [3, 15, 8, 30, 50, 90, 60]
            },
            'tia-city': {
                impressions: [500, 1000, 800, 2000, 2500, 4000, 3500],
                clicks: [2, 10, 5, 20, 40, 80, 50]
            },
            'chhroy-chhongva': {
                impressions: [300, 800, 500, 1500, 2000, 3500, 3000],
                clicks: [1, 5, 3, 15, 30, 70, 40]
            },
            'tourism-city': {
                impressions: [200, 500, 300, 1000, 1500, 3000, 2500],
                clicks: [0, 3, 2, 10, 20, 60, 30]
            }
        };

        const newData = mockDatabase[client] || mockDatabase['all'];

        // Update the datasets
        performanceChartInstance.data.datasets[0].data = newData.impressions;
        performanceChartInstance.data.datasets[1].data = newData.clicks;

        // Re-render the chart smoothly
        performanceChartInstance.update();
    }
</script>
@endpush
