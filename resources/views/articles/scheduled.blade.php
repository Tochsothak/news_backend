@extends('layouts.app')

@section('title', 'Scheduled Articles')
@section('breadcrumb', 'Scheduled')

@section('content')
    @php
        // Dummy Data tailored for Scheduled Articles
        $dummyScheduled = [
            [
                'id' => 301,
                'title' => 'The Rise of Tech Hubs in Southeast Asia',
                'slug' => 'tech-hubs-southeast-asia',
                'category' => 'Technology',
                'author' => 'Haru Malik',
                'scheduled_date' => 'Mar 11, 2026',
                'scheduled_time' => '08:00 AM',
                'publishes_in' => 'Tomorrow',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 302,
                'title' => 'Top 10 Hidden Gems to Visit in Cambodia',
                'slug' => 'hidden-gems-cambodia',
                'category' => 'Travel',
                'author' => 'Jane Doe',
                'scheduled_date' => 'Mar 14, 2026',
                'scheduled_time' => '10:30 AM',
                'publishes_in' => '4 Days',
                'image' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 303,
                'title' => 'Market Analysis: Q3 Economic Projections',
                'slug' => 'market-analysis-q3',
                'category' => 'Finance',
                'author' => 'Alex Smith',
                'scheduled_date' => 'Mar 20, 2026',
                'scheduled_time' => '06:00 AM',
                'publishes_in' => '10 Days',
                'image' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=150&h=100&q=80'
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
                <h1 class="text-xl font-bold text-foreground sm:text-2xl">Scheduled Articles</h1>
                <p class="mt-1 text-sm text-muted-foreground">Review and manage your upcoming content pipeline.</p>
            </div>
            <div class="flex items-center gap-2">
                <button
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-calendar"></i>
                    <span class="hidden sm:inline">View Calendar</span>
                </button>
                <a href="{{ route('articles.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90">
                    <i class="ph-bold ph-plus"></i>
                    <span>Create Article</span>
                </a>
            </div>
        </div>

        {{-- Stats Cards (Tailored for Upcoming Schedule) --}}
        <div class="mb-4 grid grid-cols-2 gap-3 sm:mb-6 sm:gap-4 lg:grid-cols-4">
            {{-- Total Scheduled --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Total Scheduled</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">24</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-calendar-blank text-lg text-info sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Publishing Today --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Publishing Today</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">2</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-success/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-clock text-lg text-success sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Publishing This Week --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">This Week</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">9</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-calendar-plus text-lg text-primary sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Next Empty Slot --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Next Empty Slot</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">Mar 12</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-calendar-x text-lg text-accent sm:text-xl"></i>
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
                    <input type="checkbox" x-model="selectAll" @change="selected = selectAll ? [{{ implode(',', array_column($dummyScheduled, 'id')) }}] : []"
                           class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background cursor-pointer">
                </div>

                <div class="relative flex-1">
                    <i class="ph-bold ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
                    <input type="text" placeholder="Search scheduled articles..."
                        class="w-full rounded-xl border border-border bg-card py-2.5 pl-10 pr-4 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
            </div>

            {{-- Filters --}}
            <div class="flex flex-wrap items-center gap-2">
                <select class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="">All Categories</option>
                    <option value="technology">Technology</option>
                    <option value="finance">Finance</option>
                    <option value="travel">Travel</option>
                </select>
                <select class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="">Any Time</option>
                    <option value="today">Publishing Today</option>
                    <option value="this-week">Publishing This Week</option>
                    <option value="next-week">Publishing Next Week</option>
                </select>

                {{-- Conditional Bulk Actions Container --}}
                <div x-show="selected.length > 0" x-cloak x-transition class="flex items-center gap-2">
                    <button class="inline-flex items-center gap-2 rounded-xl border border-accent/20 bg-accent/10 text-accent px-3 py-2.5 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground">
                        <i class="ph-bold ph-clock-counter-clockwise"></i>
                        <span class="hidden sm:inline">Cancel Schedule</span>
                    </button>
                    <button class="inline-flex items-center gap-2 rounded-xl border border-destructive/20 bg-destructive/10 text-destructive px-3 py-2.5 text-sm font-medium transition-colors hover:bg-destructive hover:text-destructive-foreground">
                        <i class="ph-bold ph-trash"></i>
                        <span class="hidden sm:inline">Delete Selected</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Articles List (Card Based) --}}
        <div class="space-y-3">
            @foreach($dummyScheduled as $article)
                <div class="rounded-xl border border-border bg-card overflow-hidden shadow-sm transition-all hover:shadow-md hover:border-primary/30">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between p-4 sm:p-5 gap-4">

                        {{-- Left Side: Checkbox, Image & Main Info --}}
                        <div class="flex items-start sm:items-center gap-3 sm:gap-4 flex-1 min-w-0">
                            {{-- Checkbox --}}
                            <div class="pt-1 sm:pt-0 shrink-0">
                                <input type="checkbox" value="{{ $article['id'] }}" x-model="selected" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background cursor-pointer">
                            </div>

                            {{-- Thumbnail --}}
                            <div class="relative shrink-0">
                                <img src="{{ $article['image'] }}" alt="Thumbnail" class="h-16 w-24 sm:h-20 sm:w-32 rounded-lg object-cover border border-border">
                                <div class="absolute -top-2 -right-2 flex h-6 w-6 items-center justify-center rounded-full bg-info text-info-foreground shadow-sm">
                                    <i class="ph-bold ph-clock text-xs"></i>
                                </div>
                            </div>

                            {{-- Article Info --}}
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('articles.edit', $article['id']) }}" class="font-semibold text-foreground text-base hover:text-primary transition-colors line-clamp-2 mb-1 sm:mb-1.5">
                                    {{ $article['title'] }}
                                </a>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-muted-foreground">
                                    <span class="inline-flex items-center gap-1 font-medium text-foreground">
                                        <i class="ph-bold ph-folder text-muted-foreground"></i>
                                        {{ $article['category'] }}
                                    </span>
                                    <span class="hidden sm:inline text-border">•</span>
                                    <span class="inline-flex items-center gap-1">
                                        <i class="ph-bold ph-user"></i>
                                        {{ $article['author'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Right Side: Stats, Status & Actions --}}
                        <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto mt-2 lg:mt-0 pt-4 lg:pt-0 border-t border-border lg:border-0">

                            {{-- Schedule Stats --}}
                            <div class="flex items-center gap-4 mr-2">
                                <div class="flex flex-col items-center sm:items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-calendar-blank"></i> Scheduled For</span>
                                    <span class="text-sm font-semibold text-foreground">{{ $article['scheduled_date'] }}</span>
                                    <span class="text-xs text-muted-foreground">{{ $article['scheduled_time'] }}</span>
                                </div>
                                <div class="hidden sm:block h-8 w-px bg-border"></div>
                                <div class="hidden sm:flex flex-col items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-hourglass-high"></i> Publishes In</span>
                                    <span class="text-sm font-semibold text-info">{{ $article['publishes_in'] }}</span>
                                </div>
                            </div>

                            {{-- Status Badge --}}
                            <div class="w-24 flex justify-end shrink-0">
                                <span class="inline-flex items-center gap-1 rounded-full bg-info/10 px-2 py-0.5 text-xs font-medium text-info">
                                    <span class="h-1.5 w-1.5 rounded-full bg-info"></span>
                                    Scheduled
                                </span>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-1 shrink-0">
                                <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-success/10 hover:text-success" title="Publish Now">
                                    <i class="ph-bold ph-paper-plane-tilt"></i>
                                </button>
                                <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-accent/10 hover:text-accent" title="Cancel Schedule (Move to Draft)">
                                    <i class="ph-bold ph-clock-counter-clockwise"></i>
                                </button>
                                <a href="{{ route('articles.edit', $article['id']) }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground" title="Edit Article">
                                    <i class="ph-bold ph-pencil-simple"></i>
                                </a>
                                <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive" title="Delete">
                                    <i class="ph-bold ph-trash"></i>
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
                Showing <span class="font-medium text-foreground">1</span> to <span class="font-medium text-foreground">3</span> of <span class="font-medium text-foreground">24</span> scheduled articles
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
