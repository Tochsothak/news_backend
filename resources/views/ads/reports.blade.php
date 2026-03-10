@extends('layouts.app')

@section('title', 'Ad Reports & Analytics')
@section('breadcrumb', 'Ads / Reports')

@push('scripts')
    {{-- Include Chart.js globally for the components to use --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    @php
        // Dummy Data for Top Performing Ads
        $topAds = [
            [
                'rank' => 1,
                'campaign' => 'Smart 5G Unlimited Plan',
                'client' => 'Smart Axiata',
                'zone' => 'Pop Up Ads',
                'impressions' => '142,500',
                'clicks' => '3,800',
                'ctr' => '2.66%',
                'trend' => 'up'
            ],
            [
                'rank' => 2,
                'campaign' => 'ABA Bank - Mobile App Update',
                'client' => 'ABA Bank',
                'zone' => 'Top Banner Ads',
                'impressions' => '89,200',
                'clicks' => '1,100',
                'ctr' => '1.23%',
                'trend' => 'up'
            ],
            [
                'rank' => 3,
                'campaign' => 'Condo Launch - Urbanland',
                'client' => 'Urbanland',
                'zone' => 'Article Middle',
                'impressions' => '65,000',
                'clicks' => '650',
                'ctr' => '1.00%',
                'trend' => 'down'
            ],
            [
                'rank' => 4,
                'campaign' => 'Hanuman Beverages Promo',
                'client' => 'Hanuman',
                'zone' => 'Sticky Footer',
                'impressions' => '45,300',
                'clicks' => '320',
                'ctr' => '0.70%',
                'trend' => 'up'
            ],
            [
                'rank' => 5,
                'campaign' => 'OCIC - New Project Launch',
                'client' => 'OCIC',
                'zone' => 'Sidebar Ads',
                'impressions' => '30,000',
                'clicks' => '150',
                'ctr' => '0.50%',
                'trend' => 'down'
            ],
            
        ];
    @endphp

    <div class="p-4 sm:p-6 lg:max-w-7xl mx-auto" x-data="{ dateRange: '30days' }">

        {{-- Page Header & Filters --}}
        <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-foreground sm:text-2xl">Ad Performance Reports</h1>
                <p class="mt-1 text-sm text-muted-foreground">Analyze impressions, clicks, and conversion rates across all zones.</p>
            </div>
            <div class="flex items-center gap-2">
                {{-- Date Range Selector --}}
                <div class="relative">
                    <select x-model="dateRange" class="appearance-none rounded-lg border border-border bg-card pl-10 pr-8 py-2 text-sm font-medium text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                        <option value="7days">Last 7 Days</option>
                        <option value="30days">Last 30 Days</option>
                        <option value="90days">Last 3 Months</option>
                        <option value="year">This Year</option>
                    </select>
                    <i class="ph-bold ph-calendar-blank absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
                    <i class="ph-bold ph-caret-down absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground text-xs pointer-events-none"></i>
                </div>

                {{-- Export Button --}}
                <button class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90 shadow-sm">
                    <i class="ph-bold ph-download-simple"></i>
                    <span class="hidden sm:inline">Export CSV</span>
                </button>
            </div>
        </div>

        {{-- Component: Overview KPIs --}}
        <x-ad.report-kpis />

        {{-- Charts Section (Updated to gap-4 for tighter List View spacing) --}}
        <div class="mb-4 grid grid-cols-1 lg:grid-cols-3 gap-4">

            {{-- Component: Main Line Chart (Spans 2 columns internally) --}}
            <x-ad.report-performance-chart />

            {{-- Right Side Column Wrapper: This stacks the Doughnut & Device charts in the 3rd column --}}
            <div class="flex flex-col gap-4">
                {{-- Component: Doughnut Chart --}}
                <x-ad.report-zone-chart />

                {{-- Component: Device Breakdown --}}
                <x-ad.report-device-chart />
            </div>

        </div>

        {{-- Component: Top Performing Campaigns Table --}}
        {{-- Pass the $topAds array as a prop to the component --}}
        <x-ad.report-top-campaigns :topAds="$topAds" />

    </div>
@endsection
