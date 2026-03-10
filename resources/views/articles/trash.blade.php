@extends('layouts.app')

@section('title', 'Trash')
@section('breadcrumb', 'Trash')

@section('content')
    @php
        // Dummy Data tailored for Trashed Articles
        $dummyTrash = [
            [
                'id' => 401,
                'title' => 'Old Event Announcement: New Year 2025',
                'slug' => 'old-event-announcement-2025',
                'category' => 'News',
                'author' => 'Admin',
                'deleted_at' => 'Mar 09, 2026',
                'days_left' => '29 Days',
                'original_status' => 'Published',
                'image' => 'https://images.unsplash.com/photo-1542382257-80dedb725088?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 402,
                'title' => 'Draft: Unfinished Interview with Local Chef',
                'slug' => 'draft-unfinished-interview',
                'category' => 'Lifestyle',
                'author' => 'Haru Malik',
                'deleted_at' => 'Mar 05, 2026',
                'days_left' => '25 Days',
                'original_status' => 'Draft',
                'image' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 403,
                'title' => 'Deprecated: V1 App Release Notes',
                'slug' => 'deprecated-v1-app-release',
                'category' => 'Technology',
                'author' => 'Jane Doe',
                'deleted_at' => 'Feb 12, 2026',
                'days_left' => '2 Days',
                'original_status' => 'Published',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=150&h=100&q=80'
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
                <h1 class="text-xl font-bold text-foreground sm:text-2xl">Trash</h1>
                <p class="mt-1 text-sm text-muted-foreground">Manage deleted articles. Items are permanently removed after 30 days.</p>
            </div>
            <div class="flex items-center gap-2">
                <button
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-funnel"></i>
                    <span class="hidden sm:inline">Filter</span>
                </button>
                <button
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-destructive px-4 py-2 text-sm font-medium text-destructive-foreground transition-colors hover:bg-destructive/90">
                    <i class="ph-bold ph-trash"></i>
                    <span>Empty Trash</span>
                </button>
            </div>
        </div>

        {{-- Stats Cards (Tailored for Trash/Recovery) --}}
        <div class="mb-4 grid grid-cols-2 gap-3 sm:mb-6 sm:gap-4 lg:grid-cols-4">
            {{-- Total in Trash --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Total in Trash</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">45</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-destructive/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-trash text-lg text-destructive sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Deleted Today --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Deleted Today</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">3</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-clock-counter-clockwise text-lg text-accent sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Expiring Soon --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Expiring Soon</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">12</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-warning/10 sm:h-12 sm:w-12 text-yellow-500">
                        <i class="ph-bold ph-warning-circle text-lg sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Auto-Delete Policy --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Auto-Delete</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">30 Days</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-calendar-x text-lg text-info sm:text-xl"></i>
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
                    <input type="checkbox" x-model="selectAll" @change="selected = selectAll ? [{{ implode(',', array_column($dummyTrash, 'id')) }}] : []"
                           class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background cursor-pointer">
                </div>

                <div class="relative flex-1">
                    <i class="ph-bold ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
                    <input type="text" placeholder="Search deleted articles..."
                        class="w-full rounded-xl border border-border bg-card py-2.5 pl-10 pr-4 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
            </div>

            {{-- Filters --}}
            <div class="flex flex-wrap items-center gap-2">
                <select class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="">Original Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
                <select class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="">Sort by</option>
                    <option value="newest">Recently Deleted</option>
                    <option value="expiring">Expiring Soon</option>
                </select>

                {{-- Conditional Bulk Actions Container --}}
                <div x-show="selected.length > 0" x-cloak x-transition class="flex items-center gap-2">
                    <button class="inline-flex items-center gap-2 rounded-xl border border-success/20 bg-success/10 text-success px-3 py-2.5 text-sm font-medium transition-colors hover:bg-success hover:text-success-foreground">
                        <i class="ph-bold ph-arrow-u-up-left"></i>
                        <span class="hidden sm:inline">Restore Selected</span>
                    </button>
                    <button class="inline-flex items-center gap-2 rounded-xl border border-destructive/20 bg-destructive/10 text-destructive px-3 py-2.5 text-sm font-medium transition-colors hover:bg-destructive hover:text-destructive-foreground">
                        <i class="ph-bold ph-warning"></i>
                        <span class="hidden sm:inline">Delete Permanently</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Articles List (Card Based) --}}
        <div class="space-y-3">
            @foreach($dummyTrash as $article)
                <div class="rounded-xl border border-border bg-card overflow-hidden shadow-sm transition-all hover:shadow-md hover:border-destructive/30">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between p-4 sm:p-5 gap-4">

                        {{-- Left Side: Checkbox, Image & Main Info --}}
                        <div class="flex items-start sm:items-center gap-3 sm:gap-4 flex-1 min-w-0">
                            {{-- Checkbox --}}
                            <div class="pt-1 sm:pt-0 shrink-0">
                                <input type="checkbox" value="{{ $article['id'] }}" x-model="selected" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background cursor-pointer">
                            </div>

                            {{-- Thumbnail (Grayscale for Trash) --}}
                            <div class="relative shrink-0">
                                <img src="{{ $article['image'] }}" alt="Thumbnail" class="h-16 w-24 sm:h-20 sm:w-32 rounded-lg object-cover border border-border grayscale opacity-75">
                            </div>

                            {{-- Article Info --}}
                            <div class="flex-1 min-w-0">
                                <span class="font-semibold text-foreground text-base line-clamp-2 mb-1 sm:mb-1.5 opacity-80">
                                    {{ $article['title'] }}
                                </span>
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
                                    <span class="hidden sm:inline text-border">•</span>
                                    <span class="inline-flex items-center gap-1">
                                        <i class="ph-bold ph-tag"></i>
                                        Was {{ $article['original_status'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Right Side: Stats, Status & Actions --}}
                        <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto mt-2 lg:mt-0 pt-4 lg:pt-0 border-t border-border lg:border-0">

                            {{-- Deletion Stats --}}
                            <div class="flex items-center gap-4 mr-2">
                                <div class="flex flex-col items-center sm:items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-trash"></i> Deleted On</span>
                                    <span class="text-sm font-semibold text-foreground">{{ $article['deleted_at'] }}</span>
                                </div>
                                <div class="hidden sm:block h-8 w-px bg-border"></div>
                                <div class="hidden sm:flex flex-col items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-hourglass-low"></i> Auto-Delete</span>
                                    <span class="text-sm font-semibold {{ (int)$article['days_left'] <= 3 ? 'text-destructive' : 'text-warning' }}">
                                        {{ $article['days_left'] }}
                                    </span>
                                </div>
                            </div>

                            {{-- Status Badge --}}
                            <div class="w-24 flex justify-end shrink-0">
                                <span class="inline-flex items-center gap-1 rounded-full bg-destructive/10 px-2 py-0.5 text-xs font-medium text-destructive">
                                    <span class="h-1.5 w-1.5 rounded-full bg-destructive"></span>
                                    Trashed
                                </span>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-1 shrink-0">
                                <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-success/10 hover:text-success" title="Restore Article">
                                    <i class="ph-bold ph-arrow-u-up-left"></i>
                                </button>
                                <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive" title="Delete Permanently">
                                    <i class="ph-bold ph-x-circle"></i>
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
                Showing <span class="font-medium text-foreground">1</span> to <span class="font-medium text-foreground">3</span> of <span class="font-medium text-foreground">45</span> trashed articles
            </p>
            <div class="flex items-center gap-1">
                <button class="rounded-lg border border-border p-2 text-muted-foreground transition-colors hover:bg-muted disabled:opacity-50" disabled>
                    <i class="ph-bold ph-caret-left text-sm"></i>
                </button>
                <button class="rounded-lg bg-primary px-3 py-1.5 text-xs font-medium text-primary-foreground">1</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">2</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">3</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">...</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">5</button>
                <button class="rounded-lg border border-border p-2 text-muted-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-caret-right text-sm"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
