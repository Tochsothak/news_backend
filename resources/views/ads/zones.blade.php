@extends('layouts.app')

@section('title', 'Ad Zones')
@section('breadcrumb', 'Ads / Zones')

@section('content')
    @php
        // Dummy Data tailored for Ad Zones
        $homepageZones = [
            [
                'id' => 'home_top',
                'name' => 'Top Banner',
                'description' => 'Appears just below the main navigation menu.',
                'dimensions' => '970x250 px',
                'active_campaigns' => 3,
                'is_active' => true,
                'icon' => 'ph-align-top'
            ],
            [
                'id' => 'home_middle',
                'name' => 'Middle Banner',
                'description' => 'Inserted between the latest news and trending sections.',
                'dimensions' => '970x250 px',
                'active_campaigns' => 1,
                'is_active' => true,
                'icon' => 'ph-align-center-vertical'
            ],
            [
                'id' => 'home_bottom',
                'name' => 'Bottom Banner',
                'description' => 'Located just above the footer area.',
                'dimensions' => '970x250 px',
                'active_campaigns' => 0,
                'is_active' => true,
                'icon' => 'ph-align-bottom'
            ],
            [
                'id' => 'home_popup',
                'name' => 'Pop Up (Modal)',
                'description' => 'Appears as an overlay after 5 seconds of browsing.',
                'dimensions' => '600x600 px',
                'active_campaigns' => 2,
                'is_active' => false, // Currently disabled globally
                'icon' => 'ph-browsers'
            ],
            [
                'id' => 'home_footer',
                'name' => 'Sticky Footer',
                'description' => 'Sticks to the bottom of the viewport on mobile devices.',
                'dimensions' => '320x50 px',
                'active_campaigns' => 4,
                'is_active' => true,
                'icon' => 'ph-push-pin'
            ],
        ];

        $articleZones = [
            [
                'id' => 'article_top',
                'name' => 'Top Banner',
                'description' => 'Appears above the article headline.',
                'dimensions' => '728x90 px',
                'active_campaigns' => 5,
                'is_active' => true,
                'icon' => 'ph-align-top'
            ],
            [
                'id' => 'article_middle',
                'name' => 'In-Article (Middle)',
                'description' => 'Automatically inserted after the 4th paragraph of the article.',
                'dimensions' => '300x250 px',
                'active_campaigns' => 8,
                'is_active' => true,
                'icon' => 'ph-text-align-center'
            ],
            [
                'id' => 'article_bottom',
                'name' => 'Bottom Banner',
                'description' => 'Appears at the end of the article, before comments.',
                'dimensions' => '728x90 px',
                'active_campaigns' => 2,
                'is_active' => true,
                'icon' => 'ph-align-bottom'
            ],
            [
                'id' => 'article_popup',
                'name' => 'Exit Intent Pop Up',
                'description' => 'Triggers when the user moves their mouse to leave the page.',
                'dimensions' => '600x600 px',
                'active_campaigns' => 1,
                'is_active' => true,
                'icon' => 'ph-browsers'
            ],
            [
                'id' => 'article_footer',
                'name' => 'Sticky Footer',
                'description' => 'Sticks to the bottom of the viewport while reading.',
                'dimensions' => '320x50 px',
                'active_campaigns' => 3,
                'is_active' => true,
                'icon' => 'ph-push-pin'
            ],
        ];
    @endphp

    <div class="p-4 sm:p-6 lg:max-w-7xl mx-auto">

        {{-- Page Header --}}
        <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-foreground sm:text-2xl">Ad Zones</h1>
                <p class="mt-1 text-sm text-muted-foreground">Manage placement areas, view active capacity, and toggle zones on or off sitewide.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('ads.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90">
                    <i class="ph-bold ph-plus"></i>
                    <span>Create Ad</span>
                </a>
            </div>
        </div>

        {{-- Section 1: Homepage Zones --}}
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-4">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                    <i class="ph-bold ph-house text-lg"></i>
                </div>
                <h2 class="text-lg font-semibold text-foreground">Homepage Placements</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($homepageZones as $zone)
                    <div class="rounded-xl border border-border bg-card shadow-sm overflow-hidden flex flex-col transition-all hover:border-primary/30">
                        <div class="p-5 flex-1">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-2 text-foreground font-semibold">
                                    <i class="ph-bold {{ $zone['icon'] }} text-muted-foreground"></i>
                                    {{ $zone['name'] }}
                                </div>

                                {{-- Alpine Toggle Switch --}}
                                <button x-data="{ active: {{ $zone['is_active'] ? 'true' : 'false' }} }"
                                        @click="active = !active"
                                        :class="active ? 'bg-success' : 'bg-muted'"
                                        class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-card"
                                        title="Toggle Zone Globally">
                                    <span :class="active ? 'translate-x-4' : 'translate-x-1'" class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                                </button>
                            </div>

                            <p class="text-sm text-muted-foreground mb-4 line-clamp-2 min-h-[40px]">
                                {{ $zone['description'] }}
                            </p>

                            <div class="inline-flex items-center gap-1.5 rounded-md bg-muted px-2 py-1 text-xs font-medium text-foreground">
                                <i class="ph-bold ph-ruler"></i>
                                {{ $zone['dimensions'] }}
                            </div>
                        </div>

                        <div class="border-t border-border bg-muted/30 px-5 py-3 flex items-center justify-between">
                            <span class="text-xs font-medium text-muted-foreground uppercase tracking-wider">Capacity</span>
                            @if($zone['active_campaigns'] > 0)
                                <a href="{{ route('ads.index') }}" class="text-sm font-semibold text-primary hover:text-primary/80 transition-colors flex items-center gap-1">
                                    <span class="relative flex h-2 w-2 mr-1">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                                    </span>
                                    {{ $zone['active_campaigns'] }} Active Ads
                                </a>
                            @else
                                <span class="text-sm font-medium text-muted-foreground">Empty</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Section 2: Article Page Zones --}}
        <div>
            <div class="flex items-center gap-3 mb-4">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent/10 text-accent">
                    <i class="ph-bold ph-article text-lg"></i>
                </div>
                <h2 class="text-lg font-semibold text-foreground">Article Page Placements</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($articleZones as $zone)
                    <div class="rounded-xl border border-border bg-card shadow-sm overflow-hidden flex flex-col transition-all hover:border-accent/30">
                        <div class="p-5 flex-1">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-2 text-foreground font-semibold">
                                    <i class="ph-bold {{ $zone['icon'] }} text-muted-foreground"></i>
                                    {{ $zone['name'] }}
                                </div>

                                {{-- Alpine Toggle Switch --}}
                                <button x-data="{ active: {{ $zone['is_active'] ? 'true' : 'false' }} }"
                                        @click="active = !active"
                                        :class="active ? 'bg-success' : 'bg-muted'"
                                        class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-card"
                                        title="Toggle Zone Globally">
                                    <span :class="active ? 'translate-x-4' : 'translate-x-1'" class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                                </button>
                            </div>

                            <p class="text-sm text-muted-foreground mb-4 line-clamp-2 min-h-[40px]">
                                {{ $zone['description'] }}
                            </p>

                            <div class="inline-flex items-center gap-1.5 rounded-md bg-muted px-2 py-1 text-xs font-medium text-foreground">
                                <i class="ph-bold ph-ruler"></i>
                                {{ $zone['dimensions'] }}
                            </div>
                        </div>

                        <div class="border-t border-border bg-muted/30 px-5 py-3 flex items-center justify-between">
                            <span class="text-xs font-medium text-muted-foreground uppercase tracking-wider">Capacity</span>
                            @if($zone['active_campaigns'] > 0)
                                <a href="{{ route('ads.index') }}" class="text-sm font-semibold text-accent hover:text-accent/80 transition-colors flex items-center gap-1">
                                    <span class="relative flex h-2 w-2 mr-1">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
                                    </span>
                                    {{ $zone['active_campaigns'] }} Active Ads
                                </a>
                            @else
                                <span class="text-sm font-medium text-muted-foreground">Empty</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
