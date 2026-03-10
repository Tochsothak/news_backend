@extends('layouts.app')

@section('title', 'All Advertisements')
@section('breadcrumb', 'Advertisements')

@section('content')
    @php
        // Dummy Data tailored for Advertisements
        $dummyAds = [
            [
                'id' => 501,
                'campaign' => 'Smart 5G Unlimited Plan',
                'client' => 'Smart Axiata',
                'format' => 'Video', // Can be Image, Video, GIF
                'zone' => 'Pop Up Ads',
                'status' => 'Active',
                'impressions' => '142.5k',
                'clicks' => '3.8k',
                'ctr' => '2.6%',
                'end_date' => 'Dec 31, 2026',
                'media' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 502,
                'campaign' => 'ABA Bank - Mobile App Update',
                'client' => 'ABA Bank',
                'format' => 'GIF',
                'zone' => 'Top Banner Ads',
                'status' => 'Active',
                'impressions' => '89.2k',
                'clicks' => '1.1k',
                'ctr' => '1.2%',
                'end_date' => 'Nov 15, 2026',
                'media' => 'https://images.unsplash.com/photo-1563986768494-4dee2763ff0f?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 503,
                'campaign' => 'Hanuman Beverages Summer Promo',
                'client' => 'Hanuman Beverages',
                'format' => 'Image',
                'zone' => 'Middle Banner Ads',
                'status' => 'Scheduled',
                'impressions' => '0',
                'clicks' => '0',
                'ctr' => '0%',
                'end_date' => 'Jan 01, 2027',
                'media' => 'https://images.unsplash.com/photo-1605270012917-bf157c5a9541?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 504,
                'campaign' => 'Local Real Estate - Condo Launch',
                'client' => 'Urbanland',
                'format' => 'Image',
                'zone' => 'Bottom Ads',
                'status' => 'Inactive',
                'impressions' => '210k',
                'clicks' => '4.5k',
                'ctr' => '2.1%',
                'end_date' => 'Expired',
                'media' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 505,
                'campaign' => 'Tourism City - Explore Now',
                'client' => 'Tourism City',
                'format' => 'Video',
                'zone' => 'Pop Up Ads',
                'status' => 'Active',
                'impressions' => '75k',
                'clicks' => '2.2k',
                'ctr' => '2.9%',
                'end_date' => 'Dec 15, 2026',
                'media' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=150&h=100&q=80'
            ],
                [
                    'id' => 506,
                    'campaign' => 'OCIC - New Project Launch',
                    'client' => 'OCIC',
                    'format' => 'Image',
                    'zone' => 'Top Banner Ads',
                    'status' => 'Scheduled',
                    'impressions' => '0',
                    'clicks' => '0',
                    'ctr' => '0%',
                    'end_date' => 'Jan 30, 2027',
                    'media' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=150&h=100&q=80'
                ],
                [
                    'id' => 507,
                    'campaign' => 'Koh Pich - Luxury Condos',
                    'client' => 'Koh Pich',
                    'format' => 'GIF',
                    'zone' => 'Middle Banner Ads',
                    'status' => 'Active',
                    'impressions' => '60k',
                    'clicks' => '1.5k',
                    'ctr' => '2.5%',
                    'end_date' => 'Dec 20, 2026',
                    'media' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=150&h=100&q=80'
                ],
                [
                    'id' => 508,
                    'campaign' => 'Koh Norea - Beachfront Villas',
                    'client' => 'Koh Norea',
                    'format' => 'Image',
                    'zone' => 'Bottom Ads',
                    'status' => 'Inactive',
                    'impressions' => '30k',
                    'clicks' => '500',
                    'ctr' => '1.7%',
                    'end_date' => 'Expired',
                    'media' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=150&h=100&q=80'
                ],
                [
                    'id' => 509,
                    'campaign' => 'TIA City - Grand Opening',
                    'client' => 'TIA City',
                    'format' => 'Video',
                    'zone' => 'Pop Up Ads',
                    'status' => 'Scheduled',
                    'impressions' => '0',
                    'clicks' => '0',
                    'ctr' => '0%',
                    'end_date' => 'Feb 10, 2027',
                    'media' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=150&h=100&q=80'
                ],
                [
                    'id' => 510,
                    'campaign' => 'Chhroy Chhongva - New Collection',
                    'client' => 'Chhroy Chhongva',
                    'format' => 'Image',
                    'zone' => 'Top Banner Ads',
                    'status' => 'Active',
                    'impressions' => '45k',
                    'clicks' => '900',
                    'ctr' => '2.0%',
                    'end_date' => 'Dec 25, 2026',
                    'media' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=150&h=100&q=80'
                ],

        ];
    @endphp

    <div x-data="{
        selectAll: false,
        selected: []
    }">
        {{-- Page Header --}}
        <div class="mb-4 flex flex-col gap-4 sm:mb-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-foreground sm:text-2xl">Advertisements</h1>
                <p class="mt-1 text-sm text-muted-foreground">Manage active campaigns, banners, and monitor ad performance.</p>
            </div>
            <div class="flex items-center gap-2">
                <button
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-download-simple"></i>
                    <span class="hidden sm:inline">Export Metrics</span>
                </button>
                <a href="{{ route('ads.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90">
                    <i class="ph-bold ph-plus"></i>
                    <span>Create Ad</span>
                </a>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="mb-4 grid grid-cols-2 gap-3 sm:mb-6 sm:gap-4 lg:grid-cols-4">
            {{-- Total Ads --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Active Campaigns</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">12</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-success/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-broadcast text-lg text-success sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Total Impressions --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Total Impressions (30d)</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">2.4M</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-eye text-lg text-primary sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Total Clicks --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Total Clicks (30d)</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">45.2k</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-cursor-click text-lg text-info sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Avg CTR --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Average CTR</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">1.8%</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-trend-up text-lg text-accent sm:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters & Search --}}
        <div class="mb-4 flex flex-col gap-3 sm:mb-6 lg:flex-row lg:items-center lg:justify-between">
            {{-- Search & Bulk Actions --}}
            <div class="flex items-center gap-2 w-full lg:max-w-md">
                {{-- Bulk Select Checkbox --}}
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-border bg-card">
                    <input type="checkbox" x-model="selectAll" @change="selected = selectAll ? [{{ implode(',', array_column($dummyAds, 'id')) }}] : []"
                           class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background cursor-pointer">
                </div>

                <div class="relative flex-1">
                    <i class="ph-bold ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
                    <input type="text" placeholder="Search campaigns or clients..."
                        class="w-full rounded-xl border border-border bg-card py-2.5 pl-10 pr-4 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
            </div>

            {{-- Filters --}}
            <div class="flex flex-wrap items-center gap-2">
                <select class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="">All Zones</option>
                    <option value="top">Top Banner Ads</option>
                    <option value="middle">Middle Banner Ads</option>
                    <option value="bottom">Bottom Ads</option>
                    <option value="popup">Pop Up Ads</option>
                </select>
                <select class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="inactive">Inactive</option>
                </select>
                <button x-show="selected.length > 0" x-cloak x-transition
                    class="inline-flex items-center gap-2 rounded-xl border border-destructive/20 bg-destructive/10 text-destructive px-3 py-2.5 text-sm font-medium transition-colors hover:bg-destructive hover:text-destructive-foreground">
                    <i class="ph-bold ph-trash"></i>
                    <span class="hidden sm:inline">Delete Selected</span>
                </button>
            </div>
        </div>

        {{-- Ads List (Card Based) --}}
        <div class="space-y-3 pb-24"> {{-- Added pb-24 padding to bottom so last dropdown isn't cut off by screen edge --}}
            @foreach($dummyAds as $ad)
                {{-- Note: Removed 'overflow-hidden' from this card so the dropdown menu can escape the borders! --}}
                <div class="rounded-xl border border-border bg-card shadow-sm transition-all hover:shadow-md hover:border-primary/30">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between p-4 sm:p-5 gap-4">

                        {{-- Left Side: Checkbox, Media & Main Info --}}
                        <div class="flex items-start sm:items-center gap-3 sm:gap-4 flex-1 min-w-0">
                            {{-- Checkbox --}}
                            <div class="pt-1 sm:pt-0 shrink-0">
                                <input type="checkbox" value="{{ $ad['id'] }}" x-model="selected" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background cursor-pointer">
                            </div>

                            {{-- Media Thumbnail --}}
                            <div class="relative shrink-0 overflow-hidden rounded-lg">
                                <img src="{{ $ad['media'] }}" alt="Ad Media" class="h-16 w-24 sm:h-20 sm:w-32 object-cover border border-border {{ $ad['status'] === 'Inactive' ? 'grayscale opacity-70' : '' }}">

                                {{-- Format Badge overlay --}}
                                <div class="absolute bottom-1 right-1 rounded-md bg-background/80 backdrop-blur-sm px-1.5 py-0.5 text-[10px] font-bold text-foreground border border-border/50 uppercase">
                                    @if($ad['format'] === 'Video')
                                        <i class="ph-fill ph-play-circle text-primary"></i> Video
                                    @elseif($ad['format'] === 'GIF')
                                        <i class="ph-fill ph-gif text-accent"></i> GIF
                                    @else
                                        <i class="ph-fill ph-image text-muted-foreground"></i> IMG
                                    @endif
                                </div>
                            </div>

                            {{-- Ad Info --}}
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('ads.edit', $ad['id']) }}" class="font-semibold text-foreground text-base hover:text-primary transition-colors line-clamp-1 mb-1 sm:mb-1.5">
                                    {{ $ad['campaign'] }}
                                </a>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-muted-foreground">
                                    <span class="inline-flex items-center gap-1 font-medium text-foreground">
                                        <i class="ph-bold ph-buildings text-muted-foreground"></i>
                                        {{ $ad['client'] }}
                                    </span>
                                    <span class="hidden sm:inline text-border">•</span>
                                    <span class="inline-flex items-center gap-1">
                                        <i class="ph-bold ph-map-pin"></i>
                                        {{ $ad['zone'] }}
                                    </span>
                                    <span class="hidden sm:inline text-border">•</span>
                                    <span class="inline-flex items-center gap-1">
                                        <i class="ph-bold ph-calendar-blank"></i>
                                        Ends: {{ $ad['end_date'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Right Side: Stats, Status & Actions --}}
                        <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto mt-2 lg:mt-0 pt-4 lg:pt-0 border-t border-border lg:border-0">

                            {{-- Ad Performance Stats --}}
                            <div class="flex items-center gap-4 mr-2">
                                <div class="flex flex-col items-center sm:items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-eye"></i> Impr.</span>
                                    <span class="text-sm font-semibold text-foreground">{{ $ad['impressions'] }}</span>
                                </div>
                                <div class="hidden sm:block h-8 w-px bg-border"></div>
                                <div class="hidden sm:flex flex-col items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-cursor-click"></i> Clicks</span>
                                    <span class="text-sm font-semibold text-foreground">{{ $ad['clicks'] }}</span>
                                </div>
                                <div class="hidden md:block h-8 w-px bg-border"></div>
                                <div class="hidden md:flex flex-col items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-percent"></i> CTR</span>
                                    <span class="text-sm font-semibold text-foreground">{{ $ad['ctr'] }}</span>
                                </div>
                            </div>

                            {{-- Status Badge --}}
                            <div class="w-24 flex justify-end shrink-0">
                                @if($ad['status'] === 'Active')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">
                                        <span class="h-1.5 w-1.5 rounded-full bg-success animate-pulse"></span>
                                        Active
                                    </span>
                                @elseif($ad['status'] === 'Scheduled')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-info/10 px-2 py-0.5 text-xs font-medium text-info">
                                        <span class="h-1.5 w-1.5 rounded-full bg-info"></span>
                                        Scheduled
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-muted px-2 py-0.5 text-xs font-medium text-muted-foreground border border-border">
                                        <span class="h-1.5 w-1.5 rounded-full bg-muted-foreground"></span>
                                        Inactive
                                    </span>
                                @endif
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-1 shrink-0">

                                {{-- NEW: Report Download Dropdown --}}
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <button @click="open = !open" @click.away="open = false" class="inline-flex items-center justify-center rounded-lg p-2 text-muted-foreground transition-colors hover:bg-info/10 hover:text-info focus:outline-none focus:ring-2 focus:ring-info/20" title="Download Report">
                                        <i class="ph-bold ph-download-simple text-lg"></i>
                                    </button>

                                    <div x-show="open"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         class="absolute right-0 z-50 mt-2 w-40 origin-top-right rounded-xl border border-border bg-card shadow-lg focus:outline-none overflow-hidden"
                                         x-cloak>
                                        <div class="py-1 flex flex-col">
                                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-muted-foreground hover:bg-muted hover:text-foreground transition-colors">
                                                <i class="ph-fill ph-file-pdf text-destructive text-lg"></i>
                                                Export PDF
                                            </a>
                                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-muted-foreground hover:bg-muted hover:text-foreground transition-colors">
                                                <i class="ph-fill ph-file-csv text-success text-lg"></i>
                                                Export CSV
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Quick Toggle Active/Inactive --}}
                                @if($ad['status'] === 'Active')
                                    <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-warning/10 hover:text-warning" title="Pause Campaign">
                                        <i class="ph-bold ph-pause text-lg"></i>
                                    </button>
                                @else
                                    <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-success/10 hover:text-success" title="Activate Campaign">
                                        <i class="ph-bold ph-play text-lg"></i>
                                    </button>
                                @endif

                                <a href="{{ route('ads.edit', $ad['id']) }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground" title="Edit Ad">
                                    <i class="ph-bold ph-pencil-simple text-lg"></i>
                                </a>
                                <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive" title="Delete Ad">
                                    <i class="ph-bold ph-trash text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-4 flex items-center justify-between rounded-xl border border-border bg-card px-4 py-3 sm:mt-6 sm:px-6 shadow-sm">
            <p class="text-xs text-muted-foreground sm:text-sm">
                Showing <span class="font-medium text-foreground">1</span> to <span class="font-medium text-foreground">4</span> of <span class="font-medium text-foreground">12</span> ads
            </p>
            <div class="flex items-center gap-1">
                <button class="rounded-lg border border-border p-2 text-muted-foreground transition-colors hover:bg-muted disabled:opacity-50" disabled>
                    <i class="ph-bold ph-caret-left text-sm"></i>
                </button>
                <button class="rounded-lg bg-primary px-3 py-1.5 text-xs font-medium text-primary-foreground">1</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">2</button>
                <button class="rounded-lg border border-border p-2 text-muted-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-caret-right text-sm"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
