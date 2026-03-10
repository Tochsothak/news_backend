<div class="rounded-xl border border-border bg-card shadow-sm p-5">
    <h2 class="text-base font-semibold text-foreground mb-4">Clicks by Zone</h2>
    <div class="relative h-[220px] w-full flex items-center justify-center">
        <canvas id="zoneChart"></canvas>
    </div>
    <div class="mt-6 space-y-3">
        <div class="flex items-center justify-between text-sm">
            <div class="flex items-center gap-2 text-muted-foreground"><span class="h-2.5 w-2.5 rounded-sm bg-primary"></span> Pop Up</div>
            <span class="font-medium text-foreground">42%</span>
        </div>
        <div class="flex items-center justify-between text-sm">
            <div class="flex items-center gap-2 text-muted-foreground"><span class="h-2.5 w-2.5 rounded-sm bg-info"></span> Top Banner</div>
            <span class="font-medium text-foreground">28%</span>
        </div>
        <div class="flex items-center justify-between text-sm">
            <div class="flex items-center gap-2 text-muted-foreground"><span class="h-2.5 w-2.5 rounded-sm bg-accent"></span> Article Middle</div>
            <span class="font-medium text-foreground">18%</span>
        </div>
        <div class="flex items-center justify-between text-sm">
            <div class="flex items-center gap-2 text-muted-foreground"><span class="h-2.5 w-2.5 rounded-sm bg-warning"></span> Other</div>
            <span class="font-medium text-foreground">12%</span>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const primaryColor = '#3b82f6';
        const accentColor = '#8b5cf6';
        const infoColor = '#0ea5e9';
        const warningColor = '#f59e0b';

        const ctxZone = document.getElementById('zoneChart').getContext('2d');
        new Chart(ctxZone, {
            type: 'doughnut',
            data: {
                labels: ['Pop Up', 'Top Banner', 'Article Middle', 'Other'],
                datasets: [{
                    data: [42, 28, 18, 12],
                    backgroundColor: [primaryColor, infoColor, accentColor, warningColor],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
