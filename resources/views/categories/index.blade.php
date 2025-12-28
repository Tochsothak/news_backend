@extends('layouts.app')

@section('title', 'All Categories')
@section('breadcrumb', 'Categories')

@section('content')
    {{-- Page Header --}}
    <div class="mb-4 flex flex-col gap-4 sm:mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl font-bold text-foreground sm:text-2xl">All Categories</h1>
            <p class="mt-1 text-sm text-muted-foreground">Manage your content categories and sub-categories.</p>
        </div>
        <a href="{{ url('/categories/create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90">
            <i class="ph-bold ph-plus"></i>
            <span>Create Category</span>
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="mb-4 grid grid-cols-2 gap-3 sm:mb-6 sm:gap-4 lg:grid-cols-4">
        {{-- Total Categories --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-muted-foreground sm:text-sm">Total Categories</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">12</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-folders text-lg text-primary sm:text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Sub-Categories --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-muted-foreground sm:text-sm">Sub-Categories</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">34</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-accent/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-folder-open text-lg text-accent sm:text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Active Categories --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-muted-foreground sm:text-sm">Active</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">10</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-check-circle text-lg text-success sm:text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Inactive Categories --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-muted-foreground sm:text-sm">Inactive</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">2</p>
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
            <input type="text" placeholder="Search categories..."
                class="w-full rounded-lg border border-border bg-card py-2 pl-10 pr-4 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary/20">
        </div>

        {{-- Filters --}}
        <div class="flex items-center gap-2">
            <select
                class="rounded-lg border border-border bg-card px-3 py-2 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary/20">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <a href="{{ url('/categories/reorder') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-border bg-card px-3 py-2 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                <i class="ph-bold ph-arrows-out-cardinal"></i>
                <span class="hidden sm:inline">Reorder</span>
            </a>
        </div>
    </div>

    {{-- Categories Table --}}
    <div class="rounded-lg border border-border bg-card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-border">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-muted-foreground sm:px-6">
                            Category
                        </th>
                        <th class="hidden px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-muted-foreground sm:table-cell sm:px-6">
                            Slug
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider text-muted-foreground sm:px-6">
                            Articles
                        </th>
                        <th class="hidden px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider text-muted-foreground md:table-cell sm:px-6">
                            Sub-Categories
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider text-muted-foreground sm:px-6">
                            Status
                        </th>
                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-muted-foreground sm:px-6">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    {{-- Category Row 1: Technology --}}
                    <tr class="transition-colors hover:bg-muted/50">
                        <td class="px-4 py-4 sm:px-6">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                    <i class="ph-bold ph-cpu text-lg text-primary"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-foreground">Technology</p>
                                    <p class="text-xs text-muted-foreground sm:hidden">technology</p>
                                </div>
                            </div>
                        </td>
                        <td class="hidden px-4 py-4 sm:table-cell sm:px-6">
                            <span class="text-sm text-muted-foreground">technology</span>
                        </td>
                        <td class="px-4 py-4 text-center sm:px-6">
                            <span class="inline-flex items-center justify-center rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium text-primary">
                                342
                            </span>
                        </td>
                        <td class="hidden px-4 py-4 text-center md:table-cell sm:px-6">
                            <span class="text-sm text-muted-foreground">8</span>
                        </td>
                        <td class="px-4 py-4 text-center sm:px-6">
                            <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-0.5 text-xs font-medium text-success">
                                <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                                Active
                            </span>
                        </td>
                        <td class="px-4 py-4 text-right sm:px-6">
                            <div class="flex items-center justify-end gap-1">
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
                        </td>
                    </tr>

                    {{-- Category Row 2: Sports --}}
                    <tr class="transition-colors hover:bg-muted/50">
                        <td class="px-4 py-4 sm:px-6">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-accent/10">
                                    <i class="ph-bold ph-soccer-ball text-lg text-accent"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-foreground">Sports</p>
                                    <p class="text-xs text-muted-foreground sm:hidden">sports</p>
                                </div>
                            </div>
                        </td>
                        <td class="hidden px-4 py-4 sm:table-cell sm:px-6">
                            <span class="text-sm text-muted-foreground">sports</span>
                        </td>
                        <td class="px-4 py-4 text-center sm:px-6">
                            <span class="inline-flex items-center justify-center rounded-full bg-accent/10 px-2.5 py-0.5 text-xs font-medium text-accent">
                                287
                            </span>
                        </td>
                        <td class="hidden px-4 py-4 text-center md:table-cell sm:px-6">
                            <span class="text-sm text-muted-foreground">6</span>
                        </td>
                        <td class="px-4 py-4 text-center sm:px-6">
                            <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-0.5 text-xs font-medium text-success">
                                <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                                Active
                            </span>
                        </td>
                        <td class="px-4 py-4 text-right sm:px-6">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ url('/categories/2/edit') }}"
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
                        </td>
                    </tr>

                    {{-- Category Row 3: Business --}}
                    <tr class="transition-colors hover:bg-muted/50">
                        <td class="px-4 py-4 sm:px-6">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-info/10">
                                    <i class="ph-bold ph-chart-line-up text-lg text-info"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-foreground">Business</p>
                                    <p class="text-xs text-muted-foreground sm:hidden">business</p>
                                </div>
                            </div>
                        </td>
                        <td class="hidden px-4 py-4 sm:table-cell sm:px-6">
                            <span class="text-sm text-muted-foreground">business</span>
                        </td>
                        <td class="px-4 py-4 text-center sm:px-6">
                            <span class="inline-flex items-center justify-center rounded-full bg-info/10 px-2.5 py-0.5 text-xs font-medium text-info">
                                234
                            </span>
                        </td>
                        <td class="hidden px-4 py-4 text-center md:table-cell sm:px-6">
                            <span class="text-sm text-muted-foreground">5</span>
                        </td>
                        <td class="px-4 py-4 text-center sm:px-6">
                            <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-0.5 text-xs font-medium text-success">
                                <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                                Active
                            </span>
                        </td>
                        <td class="px-4 py-4 text-right sm:px-6">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ url('/categories/3/edit') }}"
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
                        </td>
                    </tr>

                    {{-- Category Row 4: Entertainment --}}
                    <tr class="transition-colors hover:bg-muted/50">
                        <td class="px-4 py-4 sm:px-6">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-destructive/10">
                                    <i class="ph-bold ph-film-slate text-lg text-destructive"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-foreground">Entertainment</p>
                                    <p class="text-xs text-muted-foreground sm:hidden">entertainment</p>
                                </div>
                            </div>
                        </td>
                        <td class="hidden px-4 py-4 sm:table-cell sm:px-6">
                            <span class="text-sm text-muted-foreground">entertainment</span>
                        </td>
                        <td class="px-4 py-4 text-center sm:px-6">
                            <span class="inline-flex items-center justify-center rounded-full bg-destructive/10 px-2.5 py-0.5 text-xs font-medium text-destructive">
                                198
                            </span>
                        </td>
                        <td class="hidden px-4 py-4 text-center md:table-cell sm:px-6">
                            <span class="text-sm text-muted-foreground">7</span>
                        </td>
                        <td class="px-4 py-4 text-center sm:px-6">
                            <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-0.5 text-xs font-medium text-success">
                                <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                                Active
                            </span>
                        </td>
                        <td class="px-4 py-4 text-right sm:px-6">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ url('/categories/4/edit') }}"
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
                        </td>
                    </tr>

                    {{-- Category Row 5: World News (Inactive) --}}
                    <tr class="transition-colors hover:bg-muted/50">
                        <td class="px-4 py-4 sm:px-6">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success/10">
                                    <i class="ph-bold ph-globe text-lg text-success"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-foreground">World News</p>
                                    <p class="text-xs text-muted-foreground sm:hidden">world-news</p>
                                </div>
                            </div>
                        </td>
                        <td class="hidden px-4 py-4 sm:table-cell sm:px-6">
                            <span class="text-sm text-muted-foreground">world-news</span>
                        </td>
                        <td class="px-4 py-4 text-center sm:px-6">
                            <span class="inline-flex items-center justify-center rounded-full bg-success/10 px-2.5 py-0.5 text-xs font-medium text-success">
                                173
                            </span>
                        </td>
                        <td class="hidden px-4 py-4 text-center md:table-cell sm:px-6">
                            <span class="text-sm text-muted-foreground">4</span>
                        </td>
                        <td class="px-4 py-4 text-center sm:px-6">
                            <span class="inline-flex items-center gap-1 rounded-full bg-muted px-2.5 py-0.5 text-xs font-medium text-muted-foreground">
                                <span class="h-1.5 w-1.5 rounded-full bg-muted-foreground"></span>
                                Inactive
                            </span>
                        </td>
                        <td class="px-4 py-4 text-right sm:px-6">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ url('/categories/5/edit') }}"
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
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="flex items-center justify-between border-t border-border px-4 py-3 sm:px-6">
            <p class="text-xs text-muted-foreground sm:text-sm">
                Showing <span class="font-medium text-foreground">1</span> to <span class="font-medium text-foreground">5</span> of <span class="font-medium text-foreground">12</span> categories
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
