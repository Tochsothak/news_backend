@extends('layouts.app')

@section('title', 'All Categories')
@section('breadcrumb', 'Categories')

@section('content')
    <div x-data="{
        expandedCategories: {},
        toggleCategory(id) {
            this.expandedCategories[id] = !this.expandedCategories[id];
        }
    }">
        {{-- Page Header --}}
        <div class="mb-4 flex flex-col gap-4 sm:mb-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-foreground sm:text-2xl">All Categories</h1>
                <p class="mt-1 text-sm text-muted-foreground">Manage your content categories and sub-categories.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ url('/categories/sub-categories/create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-folder-plus"></i>
                    <span class="hidden sm:inline">Add Sub-Category</span>
                </a>
                <a href="{{ url('/categories/create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90">
                    <i class="ph-bold ph-plus"></i>
                    <span>Create Category</span>
                </a>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="mb-4 grid grid-cols-2 gap-3 sm:mb-6 sm:gap-4 lg:grid-cols-4">

            {{-- Total Articles (NEW) --}}
            {{-- <div class="rounded-xl border border-border bg-card p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Total Articles</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">1,234</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-article text-lg text-info sm:text-xl"></i>
                    </div>
                </div>
            </div> --}}

            {{-- Total Categories --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Categories</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">12</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-folders text-lg text-primary sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Sub-Categories --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Sub-Categories</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">34</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-folder-open text-lg text-accent sm:text-xl"></i>
                    </div>
                </div>
            </div>


            {{-- Active --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Active</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">42</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-success/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-check-circle text-lg text-success sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Inactive --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Inactive</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">4</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-muted sm:h-12 sm:w-12">
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
                <input type="text" placeholder="Search categories..."
                    class="w-full rounded-xl border border-border bg-card py-2.5 pl-10 pr-4 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
            </div>

            {{-- Filters --}}
            <div class="flex flex-wrap items-center gap-2">
                <select
                    class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <button
                    @click="Object.keys(expandedCategories).length ? expandedCategories = {} : expandedCategories = {1: true, 2: true, 3: true, 4: true, 5: true}"
                    class="inline-flex items-center gap-2 rounded-xl border border-border bg-card px-3 py-2.5 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-arrows-out-simple"></i>
                    <span class="hidden sm:inline">Toggle All</span>
                </button>
                <a href="{{ url('/categories/reorder') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-border bg-card px-3 py-2.5 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-arrows-out-cardinal"></i>
                    <span class="hidden sm:inline">Reorder</span>
                </a>
            </div>
        </div>

        {{-- Categories List with Expandable Sub-Categories --}}
        <div class="space-y-3">

            {{-- Category 1: Technology --}}
            <div class="rounded-xl border border-border bg-card overflow-hidden">
                {{-- Category Header --}}
                <div class="flex items-center justify-between p-4 sm:p-5 transition-colors hover:bg-muted/30">
                    <div class="flex items-center gap-3 flex-1">
                        {{-- Expand Button --}}
                        <button @click="toggleCategory(1)"
                            class="flex h-8 w-8 items-center justify-center rounded-lg text-muted-foreground transition-all hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-caret-right text-sm transition-transform duration-200"
                                :class="expandedCategories[1] ? 'rotate-90' : ''"></i>
                        </button>
                        {{-- Category Icon --}}
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10">
                            <i class="ph-bold ph-cpu text-lg text-primary"></i>
                        </div>
                        {{-- Category Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-semibold text-foreground">Technology</p>
                                <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">
                                    <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                                    Active
                                </span>
                            </div>
                            <p class="text-xs text-muted-foreground">technology • 8 sub-categories • 342 articles</p>
                        </div>
                    </div>
                    {{-- Actions --}}
                    <div class="flex items-center gap-1">
                        <a href="{{ url('/categories/sub-categories/create?parent=1') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-primary/10 hover:text-primary"
                            title="Add Sub-Category">
                            <i class="ph-bold ph-folder-plus"></i>
                        </a>
                        <a href="{{ url('/categories/1/edit') }}"
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"
                            title="Edit">
                            <i class="ph-bold ph-pencil-simple"></i>
                        </a>
                        <button
                            class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive"
                            title="Delete">
                            <i class="ph-bold ph-trash"></i>
                        </button>
                    </div>
                </div>

                {{-- Sub-Categories (Expandable) --}}
                <div x-show="expandedCategories[1]" x-collapse>
                    <div class="border-t border-border bg-muted/20">
                        {{-- Sub-Category: Mobile --}}
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-device-mobile text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">Mobile</p>
                                    <p class="text-xs text-muted-foreground">mobile • 45 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">Active</span>
                                <a href="{{ url('/categories/sub-categories/1/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                        {{-- Sub-Category: Computers --}}
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11 border-t border-border/50">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-desktop text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">Computers</p>
                                    <p class="text-xs text-muted-foreground">computers • 38 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">Active</span>
                                <a href="{{ url('/categories/sub-categories/2/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                        {{-- Sub-Category: Cloud --}}
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11 border-t border-border/50">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-cloud text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">Cloud</p>
                                    <p class="text-xs text-muted-foreground">cloud • 32 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">Active</span>
                                <a href="{{ url('/categories/sub-categories/3/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                        {{-- Sub-Category: AI & ML --}}
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11 border-t border-border/50">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-robot text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">AI & ML</p>
                                    <p class="text-xs text-muted-foreground">ai-ml • 28 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">Active</span>
                                <a href="{{ url('/categories/sub-categories/4/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Category 2: Sports --}}
            <div class="rounded-xl border border-border bg-card overflow-hidden">
                <div class="flex items-center justify-between p-4 sm:p-5 transition-colors hover:bg-muted/30">
                    <div class="flex items-center gap-3 flex-1">
                        <button @click="toggleCategory(2)"
                            class="flex h-8 w-8 items-center justify-center rounded-lg text-muted-foreground transition-all hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-caret-right text-sm transition-transform duration-200"
                                :class="expandedCategories[2] ? 'rotate-90' : ''"></i>
                        </button>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10">
                            <i class="ph-bold ph-soccer-ball text-lg text-accent"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-semibold text-foreground">Sports</p>
                                <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">
                                    <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                                    Active
                                </span>
                            </div>
                            <p class="text-xs text-muted-foreground">sports • 6 sub-categories • 287 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <a href="{{ url('/categories/sub-categories/create?parent=2') }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-accent/10 hover:text-accent" title="Add Sub-Category">
                            <i class="ph-bold ph-folder-plus"></i>
                        </a>
                        <a href="{{ url('/categories/2/edit') }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground" title="Edit">
                            <i class="ph-bold ph-pencil-simple"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive" title="Delete">
                            <i class="ph-bold ph-trash"></i>
                        </button>
                    </div>
                </div>
                <div x-show="expandedCategories[2]" x-collapse>
                    <div class="border-t border-border bg-muted/20">
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-soccer-ball text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">Football</p>
                                    <p class="text-xs text-muted-foreground">football • 89 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">Active</span>
                                <a href="{{ url('/categories/sub-categories/5/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11 border-t border-border/50">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-basketball text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">Basketball</p>
                                    <p class="text-xs text-muted-foreground">basketball • 67 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">Active</span>
                                <a href="{{ url('/categories/sub-categories/6/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11 border-t border-border/50">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-tennis-ball text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">Tennis</p>
                                    <p class="text-xs text-muted-foreground">tennis • 45 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-muted px-2 py-0.5 text-xs font-medium text-muted-foreground sm:inline-flex">Inactive</span>
                                <a href="{{ url('/categories/sub-categories/7/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Category 3: Business --}}
            <div class="rounded-xl border border-border bg-card overflow-hidden">
                <div class="flex items-center justify-between p-4 sm:p-5 transition-colors hover:bg-muted/30">
                    <div class="flex items-center gap-3 flex-1">
                        <button @click="toggleCategory(3)"
                            class="flex h-8 w-8 items-center justify-center rounded-lg text-muted-foreground transition-all hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-caret-right text-sm transition-transform duration-200"
                                :class="expandedCategories[3] ? 'rotate-90' : ''"></i>
                        </button>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10">
                            <i class="ph-bold ph-chart-line-up text-lg text-info"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-semibold text-foreground">Business</p>
                                <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">
                                    <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                                    Active
                                </span>
                            </div>
                            <p class="text-xs text-muted-foreground">business • 5 sub-categories • 234 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <a href="{{ url('/categories/sub-categories/create?parent=3') }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-info/10 hover:text-info" title="Add Sub-Category">
                            <i class="ph-bold ph-folder-plus"></i>
                        </a>
                        <a href="{{ url('/categories/3/edit') }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground" title="Edit">
                            <i class="ph-bold ph-pencil-simple"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive" title="Delete">
                            <i class="ph-bold ph-trash"></i>
                        </button>
                    </div>
                </div>
                <div x-show="expandedCategories[3]" x-collapse>
                    <div class="border-t border-border bg-muted/20">
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-currency-dollar text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">Finance</p>
                                    <p class="text-xs text-muted-foreground">finance • 78 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">Active</span>
                                <a href="{{ url('/categories/sub-categories/8/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11 border-t border-border/50">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-rocket-launch text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">Startups</p>
                                    <p class="text-xs text-muted-foreground">startups • 56 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">Active</span>
                                <a href="{{ url('/categories/sub-categories/9/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Category 4: Entertainment --}}
            <div class="rounded-xl border border-border bg-card overflow-hidden">
                <div class="flex items-center justify-between p-4 sm:p-5 transition-colors hover:bg-muted/30">
                    <div class="flex items-center gap-3 flex-1">
                        <button @click="toggleCategory(4)"
                            class="flex h-8 w-8 items-center justify-center rounded-lg text-muted-foreground transition-all hover:bg-muted hover:text-foreground">
                            <i class="ph-bold ph-caret-right text-sm transition-transform duration-200"
                                :class="expandedCategories[4] ? 'rotate-90' : ''"></i>
                        </button>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-destructive/10">
                            <i class="ph-bold ph-film-slate text-lg text-destructive"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-semibold text-foreground">Entertainment</p>
                                <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">
                                    <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                                    Active
                                </span>
                            </div>
                            <p class="text-xs text-muted-foreground">entertainment • 7 sub-categories • 198 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <a href="{{ url('/categories/sub-categories/create?parent=4') }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive" title="Add Sub-Category">
                            <i class="ph-bold ph-folder-plus"></i>
                        </a>
                        <a href="{{ url('/categories/4/edit') }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground" title="Edit">
                            <i class="ph-bold ph-pencil-simple"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive" title="Delete">
                            <i class="ph-bold ph-trash"></i>
                        </button>
                    </div>
                </div>
                <div x-show="expandedCategories[4]" x-collapse>
                    <div class="border-t border-border bg-muted/20">
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-film-strip text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">Movies</p>
                                    <p class="text-xs text-muted-foreground">movies • 65 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">Active</span>
                                <a href="{{ url('/categories/sub-categories/10/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between px-4 py-3 sm:px-5 transition-colors hover:bg-muted/30 ml-11 border-t border-border/50">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-music-notes text-sm text-muted-foreground"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-foreground">Music</p>
                                    <p class="text-xs text-muted-foreground">music • 52 articles</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="hidden rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success sm:inline-flex">Active</span>
                                <a href="{{ url('/categories/sub-categories/11/edit') }}" class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <button class="rounded-lg p-1.5 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Category 5: World News (Inactive, No Sub-Categories) --}}
            <div class="rounded-xl border border-border bg-card overflow-hidden">
                <div class="flex items-center justify-between p-4 sm:p-5 transition-colors hover:bg-muted/30">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg text-muted-foreground/30">
                            {{-- No expand button - no sub-categories --}}
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-success/10">
                            <i class="ph-bold ph-globe text-lg text-success"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-semibold text-foreground">World News</p>
                                <span class="inline-flex items-center gap-1 rounded-full bg-muted px-2 py-0.5 text-xs font-medium text-muted-foreground">
                                    <span class="h-1.5 w-1.5 rounded-full bg-muted-foreground"></span>
                                    Inactive
                                </span>
                            </div>
                            <p class="text-xs text-muted-foreground">world-news • 0 sub-categories • 173 articles</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <a href="{{ url('/categories/sub-categories/create?parent=5') }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-success/10 hover:text-success" title="Add Sub-Category">
                            <i class="ph-bold ph-folder-plus"></i>
                        </a>
                        <a href="{{ url('/categories/5/edit') }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground" title="Edit">
                            <i class="ph-bold ph-pencil-simple"></i>
                        </a>
                        <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive" title="Delete">
                            <i class="ph-bold ph-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        {{-- Pagination --}}
        <div class="mt-4 flex items-center justify-between rounded-xl border border-border bg-card px-4 py-3 sm:mt-6 sm:px-6">
            <p class="text-xs text-muted-foreground sm:text-sm">
                Showing <span class="font-medium text-foreground">5</span> categories with <span class="font-medium text-foreground">26</span> sub-categories
            </p>
            <div class="flex items-center gap-1">
                <button class="rounded-lg border border-border p-2 text-muted-foreground transition-colors hover:bg-muted disabled:opacity-50" disabled>
                    <i class="ph-bold ph-caret-left text-sm"></i>
                </button>
                <button class="rounded-lg bg-primary px-3 py-1.5 text-xs font-medium text-primary-foreground">1</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">2</button>
                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-medium text-foreground transition-colors hover:bg-muted">3</button>
                <button class="rounded-lg border border-border p-2 text-muted-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-caret-right text-sm"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
