@props(['topAds'])

<div class="rounded-xl border border-border bg-card shadow-sm overflow-hidden">
    <div class="border-b border-border p-5 flex items-center justify-between">
        <h2 class="text-base font-semibold text-foreground">Top Performing Campaigns</h2>
        <div class="flex items-center gap-4">
            <button class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors flex items-center gap-1.5" title="Export this list as CSV">
                <i class="ph-bold ph-file-csv text-lg"></i>
                <span class="hidden sm:inline">Export List</span>
            </button>
            <div class="h-4 w-px bg-border hidden sm:block"></div>
            <a href="{{ route('ads.index') }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors flex items-center gap-1">
                View All Ads <i class="ph-bold ph-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="overflow-x-auto min-h-[250px]"> {{-- Added min-height so dropdowns don't get cut off --}}
        <table class="min-w-full divide-y divide-border">
            <thead class="bg-muted/30">
                <tr>
                    <th scope="col" class="px-5 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider w-16">Rank</th>
                    <th scope="col" class="px-5 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Campaign & Client</th>
                    <th scope="col" class="px-5 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider hidden sm:table-cell">Primary Zone</th>
                    <th scope="col" class="px-5 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">Impressions</th>
                    <th scope="col" class="px-5 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">Clicks</th>
                    <th scope="col" class="px-5 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">CTR</th>
                    <th scope="col" class="px-5 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">Report</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border bg-transparent">
                @foreach($topAds as $ad)
                    <tr class="hover:bg-muted/30 transition-colors duration-150">
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full {{ $ad['rank'] === 1 ? 'bg-warning/20 text-warning font-bold' : ($ad['rank'] === 2 ? 'bg-slate-300/20 text-slate-300 font-bold' : ($ad['rank'] === 3 ? 'bg-amber-700/20 text-amber-600 font-bold' : 'bg-muted text-muted-foreground')) }}">
                                {{ $ad['rank'] }}
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-foreground">{{ $ad['campaign'] }}</span>
                                <span class="text-xs text-muted-foreground mt-0.5">{{ $ad['client'] }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap hidden sm:table-cell">
                            <span class="inline-flex items-center rounded-md bg-muted px-2 py-1 text-xs font-medium text-muted-foreground border border-border">
                                {{ $ad['zone'] }}
                            </span>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-right text-sm text-foreground font-medium">
                            {{ $ad['impressions'] }}
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-right text-sm text-foreground font-medium">
                            {{ $ad['clicks'] }}
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <span class="text-sm font-bold text-foreground">{{ $ad['ctr'] }}</span>
                                @if($ad['trend'] === 'up')
                                    <i class="ph-bold ph-trend-up text-success text-xs"></i>
                                @else
                                    <i class="ph-bold ph-trend-down text-destructive text-xs"></i>
                                @endif
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-right">

                            {{-- Alpine Dropdown for Report Export --}}
                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                {{-- Button is now always visible --}}
                                <button @click="open = !open" @click.away="open = false" class="inline-flex items-center justify-center rounded-lg p-2 text-muted-foreground transition-colors hover:bg-primary/10 hover:text-primary focus:outline-none focus:ring-2 focus:ring-primary/20" title="Download Report">
                                    <i class="ph-bold ph-download-simple text-lg"></i>
                                </button>

                                {{-- Dropdown Menu --}}
                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-xl border border-border bg-card shadow-lg focus:outline-none overflow-hidden"
                                     x-cloak>
                                    <div class="py-1">
                                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-muted-foreground hover:bg-muted hover:text-foreground transition-colors">
                                            <i class="ph-fill ph-file-pdf text-destructive text-lg"></i>
                                            Export as PDF
                                        </a>
                                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-muted-foreground hover:bg-muted hover:text-foreground transition-colors">
                                            <i class="ph-fill ph-file-csv text-success text-lg"></i>
                                            Export as CSV
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
