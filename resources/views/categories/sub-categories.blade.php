@extends('layouts.app')

@section('title', 'Sub-Categories')
@section('breadcrumb', 'Categories / Sub-Categories')

@section('content')
    {{-- Page Header --}}
    <div class="mb-4 flex flex-col gap-4 sm:mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                <a href="{{ url('/categories') }}" class="hover:text-foreground">Categories</a>
                <i class="ph-bold ph-caret-right text-xs"></i>
                <span class="text-foreground">Sub-Categories</span>
            </div>
            <h1 class="mt-2 text-xl font-bold text-foreground sm:text-2xl">Sub-Categories</h1>
            <p class="mt-1 text-sm text-muted-foreground">Manage sub-categories within parent categories.</p>
        </div>
        <a href="{{ url('/categories/create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90">
            <i class="ph-bold ph-plus"></i>
            <span>Add Sub-Category</span>
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="mb-4 grid grid-cols-2 gap-3 sm:mb-6 sm:gap-4 lg:grid-cols-4">
        {{-- Total Sub-Categories --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-muted-foreground sm:text-sm">Total Sub-Categories</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">34</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-folder-open text-lg text-primary sm:text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Parent Categories --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-muted-foreground sm:text-sm">Parent Categories</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">12</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-accent/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-folders text-lg text-accent sm:text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Active --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-muted-foreground sm:text-sm">Active</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">30</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-check-circle text-lg text-success sm:text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Inactive --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-muted-foreground sm:text-sm">Inactive</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">4</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-muted sm:h-12 sm:w-12">
                    <i class="ph-bold ph-minus-circle text-lg text-muted-foreground sm:text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters & Search --}}
    <div class="mb-4 flex flex-col gap-3 sm:mb-6 sm:flex-row sm:items-center sm:justify-between">
        {{-- Search --}}
        <div class="relative w-full sm:max-w-xs">
            <i class="ph-bold ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
            <input type="text" placeholder="Search sub-categories..."
                class="w-full rounded-lg border border-border bg-card py-2 pl-10 pr-4 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary/20">
        </div>

        {{-- Filters --}}
        <div class="flex flex-wrap items-center gap-2">
            <select
                class="rounded-lg border border-border bg-card px-3 py-2 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary/20">
                <option value="">All Parents</option>
                <option value="1">Technology</option>
                <option value="2">Sports</option>
                <option value="3">Business</option>
                <option value="4">Entertainment</option>
                <option value="5">World News</option>
            </select>
            <select
                class="rounded-lg border border-border bg-card px-3 py-2 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary/20">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>

    {{-- Sub-Categories by Parent --}}
    <div class="space-y-4 sm:space-y-6">

        {{-- Technology Sub-Categories --}}
        <div class="rounded-lg border border-border bg-card">
            {{-- Parent Header --}}
            <div class="flex items-center justify-between border-b border-border p-4 sm:p-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                        <i class="ph-bold ph-cpu text-lg text-primary"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground">Technology</h3>
                        <p class="text-xs text-muted-foreground">8 sub-categories • 342 articles</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ url('/categories/1/edit') }}"
                        class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"
                        title="Edit Parent">
                        <i class="ph-bold ph-pencil-simple"></i>
                    </a>
                    <a href="{{ url('/categories/create?parent=1') }}"
                        class="inline-flex items-center gap-1 rounded-lg bg-primary/10 px-3 py-1.5 text-xs font-medium text-primary transition-colors hover:bg-primary/20">
                        <i class="ph-bold ph-plus"></i>
                        Add
                    </a>
                </div>
            </div>

            {{-- Sub-Categories List --}}
            <div class="divide-y divide-border">
                {{-- Mobile --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-device-mobile text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Mobile</p>
                            <p class="text-xs text-muted-foreground">mobile • 45 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/1/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Computers --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-desktop text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Computers</p>
                            <p class="text-xs text-muted-foreground">computers • 38 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/2/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Cloud --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-cloud text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Cloud</p>
                            <p class="text-xs text-muted-foreground">cloud • 32 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/3/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- AI & ML --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-robot text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">AI & ML</p>
                            <p class="text-xs text-muted-foreground">ai-ml • 28 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/4/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sports Sub-Categories --}}
        <div class="rounded-lg border border-border bg-card">
            {{-- Parent Header --}}
            <div class="flex items-center justify-between border-b border-border p-4 sm:p-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-accent/10">
                        <i class="ph-bold ph-soccer-ball text-lg text-accent"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground">Sports</h3>
                        <p class="text-xs text-muted-foreground">6 sub-categories • 287 articles</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ url('/categories/2/edit') }}"
                        class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"
                        title="Edit Parent">
                        <i class="ph-bold ph-pencil-simple"></i>
                    </a>
                    <a href="{{ url('/categories/create?parent=2') }}"
                        class="inline-flex items-center gap-1 rounded-lg bg-accent/10 px-3 py-1.5 text-xs font-medium text-accent transition-colors hover:bg-accent/20">
                        <i class="ph-bold ph-plus"></i>
                        Add
                    </a>
                </div>
            </div>

            {{-- Sub-Categories List --}}
            <div class="divide-y divide-border">
                {{-- Football --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-soccer-ball text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Football</p>
                            <p class="text-xs text-muted-foreground">football • 89 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/5/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Basketball --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-basketball text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Basketball</p>
                            <p class="text-xs text-muted-foreground">basketball • 67 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/6/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Tennis --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-tennis-ball text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Tennis</p>
                            <p class="text-xs text-muted-foreground">tennis • 45 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-muted px-2 py-0.5 text-xs font-medium text-muted-foreground sm:inline-flex">
                            Inactive
                        </span>
                        <a href="{{ url('/categories/sub/7/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Business Sub-Categories --}}
        <div class="rounded-lg border border-border bg-card">
            {{-- Parent Header --}}
            <div class="flex items-center justify-between border-b border-border p-4 sm:p-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-info/10">
                        <i class="ph-bold ph-chart-line-up text-lg text-info"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground">Business</h3>
                        <p class="text-xs text-muted-foreground">5 sub-categories • 234 articles</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ url('/categories/3/edit') }}"
                        class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"
                        title="Edit Parent">
                        <i class="ph-bold ph-pencil-simple"></i>
                    </a>
                    <a href="{{ url('/categories/create?parent=3') }}"
                        class="inline-flex items-center gap-1 rounded-lg bg-info/10 px-3 py-1.5 text-xs font-medium text-info transition-colors hover:bg-info/20">
                        <i class="ph-bold ph-plus"></i>
                        Add
                    </a>
                </div>
            </div>

            {{-- Sub-Categories List --}}
            <div class="divide-y divide-border">
                {{-- Finance --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-currency-dollar text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Finance</p>
                            <p class="text-xs text-muted-foreground">finance • 78 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/8/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Startups --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-rocket-launch text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Startups</p>
                            <p class="text-xs text-muted-foreground">startups • 56 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/9/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Real Estate --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-buildings text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Real Estate</p>
                            <p class="text-xs text-muted-foreground">real-estate • 42 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/10/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Entertainment Sub-Categories --}}
        <div class="rounded-lg border border-border bg-card">
            {{-- Parent Header --}}
            <div class="flex items-center justify-between border-b border-border p-4 sm:p-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-destructive/10">
                        <i class="ph-bold ph-film-slate text-lg text-destructive"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground">Entertainment</h3>
                        <p class="text-xs text-muted-foreground">7 sub-categories • 198 articles</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ url('/categories/4/edit') }}"
                        class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"
                        title="Edit Parent">
                        <i class="ph-bold ph-pencil-simple"></i>
                    </a>
                    <a href="{{ url('/categories/create?parent=4') }}"
                        class="inline-flex items-center gap-1 rounded-lg bg-destructive/10 px-3 py-1.5 text-xs font-medium text-destructive transition-colors hover:bg-destructive/20">
                        <i class="ph-bold ph-plus"></i>
                        Add
                    </a>
                </div>
            </div>

            {{-- Sub-Categories List --}}
            <div class="divide-y divide-border">
                {{-- Movies --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-film-strip text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Movies</p>
                            <p class="text-xs text-muted-foreground">movies • 65 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/11/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Music --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-music-notes text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Music</p>
                            <p class="text-xs text-muted-foreground">music • 52 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/12/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Celebrity --}}
                <div class="flex items-center justify-between p-4 transition-colors hover:bg-muted/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                            <i class="ph-bold ph-star text-sm text-muted-foreground"></i>
                        </div>
                        <div>
                            <p class="font-medium text-foreground">Celebrity</p>
                            <p class="text-xs text-muted-foreground">celebrity • 41 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">
                            Active
                        </span>
                        <a href="{{ url('/categories/sub/13/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-pencil-simple text-sm"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                            <i class="ph-bold ph-trash text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-4 flex items-center justify-between rounded-lg border border-border bg-card px-4 py-3 sm:mt-6 sm:px-6">
        <p class="text-xs text-muted-foreground sm:text-sm">
            Showing <span class="font-medium text-foreground">4</span> parent categories with <span class="font-medium text-foreground">26</span> sub-categories
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
@endsection
