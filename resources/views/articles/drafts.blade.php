@extends('layouts.app')

@section('title', 'Draft Articles')
@section('breadcrumb', 'Drafts')

@section('content')
    @php
        // Dummy Data tailored for Drafts
        $dummyDrafts = [
            [
                'id' => 101,
                'title' => 'Understanding Tailwind CSS Typography in Depth',
                'slug' => 'understanding-tailwind-css-typography',
                'category' => 'Technology',
                'author' => 'Haru Malik',
                'status' => 'Draft',
                'words' => '1,420',
                'read_time' => '6 min',
                'date' => 'Last edited 2 hours ago',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 102,
                'title' => 'Khmer Language Support: Best Fonts and Practices',
                'slug' => 'khmer-language-support-fonts',
                'category' => 'Development',
                'author' => 'Jane Doe',
                'status' => 'Draft',
                'words' => '850',
                'read_time' => '4 min',
                'date' => 'Last edited yesterday',
                'image' => 'https://images.unsplash.com/photo-1517842645767-c639042777db?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 103,
                'title' => 'Top 5 Local Restaurants to Try in Poipet',
                'slug' => 'top-5-local-restaurants-poipet',
                'category' => 'Lifestyle',
                'author' => 'Alex Smith',
                'status' => 'Draft',
                'words' => '320',
                'read_time' => '2 min',
                'date' => 'Last edited Oct 20, 2026',
                // Example of a missing image for a draft
                'image' => 'https://ui-avatars.com/api/?name=Draft&background=random&color=fff&size=150'
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
                <h1 class="text-xl font-bold text-foreground sm:text-2xl">Draft Articles</h1>
                <p class="mt-1 text-sm text-muted-foreground">Resume writing and manage your unpublished work.</p>
            </div>
            <div class="flex items-center gap-2">
                <button
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-export"></i>
                    <span class="hidden sm:inline">Export</span>
                </button>
                <a href="{{ route('articles.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90">
                    <i class="ph-bold ph-plus"></i>
                    <span>Create Article</span>
                </a>
            </div>
        </div>

        {{-- Stats Cards (Tailored for Drafts) --}}
        <div class="mb-4 grid grid-cols-2 gap-3 sm:mb-6 sm:gap-4 lg:grid-cols-4">
            {{-- Total Drafts --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Total Drafts</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">145</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-file-dashed text-lg text-accent sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Edited This Week --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Edited This Week</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">32</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-clock-counter-clockwise text-lg text-primary sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Missing Images --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Missing Images</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">18</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-destructive/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-image-broken text-lg text-destructive sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Ready for Review --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Ready for Review</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">12</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-list-checks text-lg text-info sm:text-xl"></i>
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
                    <input type="checkbox" x-model="selectAll" @change="selected = selectAll ? [{{ implode(',', array_column($dummyDrafts, 'id')) }}] : []"
                           class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background cursor-pointer">
                </div>

                <div class="relative flex-1">
                    <i class="ph-bold ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
                    <input type="text" placeholder="Search drafts..."
                        class="w-full rounded-xl border border-border bg-card py-2.5 pl-10 pr-4 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
            </div>

            {{-- Filters --}}
            <div class="flex flex-wrap items-center gap-2">
                <select class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="">All Categories</option>
                    <option value="technology">Technology</option>
                    <option value="development">Development</option>
                    <option value="lifestyle">Lifestyle</option>
                </select>
                {{-- Swapped Status filter for Author filter since all items are Drafts --}}
                <select class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="">All Authors</option>
                    <option value="haru">Haru Malik</option>
                    <option value="jane">Jane Doe</option>
                    <option value="alex">Alex Smith</option>
                </select>

                {{-- Conditional Bulk Actions Container --}}
                <div x-show="selected.length > 0" x-cloak x-transition class="flex items-center gap-2">
                    <button class="inline-flex items-center gap-2 rounded-xl border border-border bg-card text-foreground px-3 py-2.5 text-sm font-medium transition-colors hover:bg-muted">
                        <i class="ph-bold ph-check-circle"></i>
                        <span class="hidden sm:inline">Publish Selected</span>
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
            @foreach($dummyDrafts as $draft)
                <div class="rounded-xl border border-border bg-card overflow-hidden shadow-sm transition-all hover:shadow-md hover:border-primary/30">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between p-4 sm:p-5 gap-4">

                        {{-- Left Side: Checkbox, Image & Main Info --}}
                        <div class="flex items-start sm:items-center gap-3 sm:gap-4 flex-1 min-w-0">
                            {{-- Checkbox --}}
                            <div class="pt-1 sm:pt-0 shrink-0">
                                <input type="checkbox" value="{{ $draft['id'] }}" x-model="selected" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background cursor-pointer">
                            </div>

                            {{-- Thumbnail --}}
                            <img src="{{ $draft['image'] }}" alt="Thumbnail" class="h-16 w-24 sm:h-20 sm:w-32 rounded-lg object-cover border border-border shrink-0 opacity-80 grayscale-[20%]">

                            {{-- Article Info --}}
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('articles.edit', $draft['id']) }}" class="font-semibold text-foreground text-base hover:text-primary transition-colors line-clamp-2 mb-1 sm:mb-1.5">
                                    {{ $draft['title'] }}
                                </a>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-muted-foreground">
                                    <span class="inline-flex items-center gap-1 font-medium text-foreground">
                                        <i class="ph-bold ph-folder text-muted-foreground"></i>
                                        {{ $draft['category'] }}
                                    </span>
                                    <span class="hidden sm:inline text-border">•</span>
                                    <span class="inline-flex items-center gap-1">
                                        <i class="ph-bold ph-user"></i>
                                        {{ $draft['author'] }}
                                    </span>
                                    <span class="hidden sm:inline text-border">•</span>
                                    <span class="inline-flex items-center gap-1">
                                        <i class="ph-bold ph-clock"></i>
                                        {{ $draft['date'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Right Side: Stats, Status & Actions --}}
                        <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto mt-2 lg:mt-0 pt-4 lg:pt-0 border-t border-border lg:border-0">

                            {{-- Writing Progress Stats (Replaces Views/Comments for Drafts) --}}
                            <div class="flex items-center gap-4 mr-2">
                                <div class="flex flex-col items-center sm:items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-text-aa"></i> Words</span>
                                    <span class="text-sm font-semibold text-foreground">{{ $draft['words'] }}</span>
                                </div>
                                <div class="hidden sm:block h-8 w-px bg-border"></div>
                                <div class="hidden sm:flex flex-col items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-hourglass-high"></i> Read Time</span>
                                    <span class="text-sm font-semibold text-foreground">{{ $draft['read_time'] }}</span>
                                </div>
                            </div>

                            {{-- Status Badge --}}
                            <div class="w-24 flex justify-end shrink-0">
                                <span class="inline-flex items-center gap-1 rounded-full bg-accent/10 px-2 py-0.5 text-xs font-medium text-accent">
                                    <span class="h-1.5 w-1.5 rounded-full bg-accent"></span>
                                    Draft
                                </span>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-1 shrink-0">
                                {{-- Changed 'View Live' to 'Preview' --}}
                                <a href="#" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-primary/10 hover:text-primary" title="Preview Draft">
                                    <i class="ph-bold ph-eye"></i>
                                </a>
                                <a href="{{ route('articles.edit', $draft['id']) }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground" title="Continue Editing">
                                    <i class="ph-bold ph-pencil-simple"></i>
                                </a>
                                <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive" title="Delete Draft">
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
                Showing <span class="font-medium text-foreground">1</span> to <span class="font-medium text-foreground">3</span> of <span class="font-medium text-foreground">145</span> drafts
            </p>
            <div class="flex items-center gap-1">
                <button class="rounded-lg border border-border p-2 text-muted-foreground transition-colors hover:bg-muted disabled:opacity-50" disabled>
                    <i class="ph-bold ph-caret-left text-sm"></i>
                </button>
                <button class="rounded-lg bg-primary px-3 py-1.5 text-xs font-medium text-primary-foreground">1</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">2</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">3</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">...</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">15</button>
                <button class="rounded-lg border border-border p-2 text-muted-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-caret-right text-sm"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
