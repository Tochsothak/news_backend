@extends('layouts.app')

@section('title', 'Dashboard - News Portal')
@section('breadcrumb', 'Dashboard')

@section('content')
    {{-- Welcome Card --}}
    <div class="mb-4 sm:mb-6">
        <h1 class="text-xl font-bold text-foreground sm:text-2xl">Welcome to News Portal</h1>
        <p class="mt-1 text-sm text-muted-foreground sm:text-base">Manage your content and monitor your news portal from here.</p>
    </div>

    {{-- Stats Grid --}}
    <div class="mb-4 grid grid-cols-2 gap-3 sm:mb-6 sm:gap-4 lg:grid-cols-4">
        {{-- Total Articles --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <div class="min-w-0">
                    <p class="truncate text-xs font-medium text-muted-foreground sm:text-sm">Total Articles</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">1,234</p>
                </div>
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-primary/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-article text-lg text-primary sm:text-xl"></i>
                </div>
            </div>
            <p class="mt-2 hidden text-xs text-success sm:block">
                <i class="ph-bold ph-trend-up"></i> +12% from last month
            </p>
        </div>

        {{-- Total Users --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <div class="min-w-0">
                    <p class="truncate text-xs font-medium text-muted-foreground sm:text-sm">Total Users</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">5,678</p>
                </div>
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-accent/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-users text-lg text-accent sm:text-xl"></i>
                </div>
            </div>
            <p class="mt-2 hidden text-xs text-success sm:block">
                <i class="ph-bold ph-trend-up"></i> +8% from last month
            </p>
        </div>

        {{-- Page Views --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <div class="min-w-0">
                    <p class="truncate text-xs font-medium text-muted-foreground sm:text-sm">Page Views</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">89.2K</p>
                </div>
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-info/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-eye text-lg text-info sm:text-xl"></i>
                </div>
            </div>
            <p class="mt-2 hidden text-xs text-success sm:block">
                <i class="ph-bold ph-trend-up"></i> +24% from last month
            </p>
        </div>

        {{-- Categories --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <div class="min-w-0">
                    <p class="truncate text-xs font-medium text-muted-foreground sm:text-sm">Categories</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">24</p>
                </div>
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-success/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-folders text-lg text-success sm:text-xl"></i>
                </div>
            </div>
            <p class="mt-2 hidden text-xs text-muted-foreground sm:block">
                <i class="ph-bold ph-minus"></i> No change
            </p>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">

        {{-- Left Column: Charts & Tables --}}
        <div class="space-y-4 sm:space-y-6 lg:col-span-2">

            {{-- Traffic Overview Chart --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-foreground sm:text-lg">Traffic Overview</h3>
                        <p class="text-xs text-muted-foreground sm:text-sm">Daily page views for the last 7 days</p>
                    </div>
                    <select class="w-full rounded-lg border border-border bg-card px-3 py-2 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 sm:w-auto">
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 90 days</option>
                    </select>
                </div>
                {{-- Chart Placeholder --}}
                <div class="flex h-48 items-end justify-between gap-1 rounded-lg bg-muted/30 p-3 sm:h-64 sm:gap-2 sm:p-4">
                    <div class="flex h-full flex-1 flex-col justify-end gap-1">
                        <div class="w-full rounded-t bg-primary/80" style="height: 60%"></div>
                        <span class="text-center text-[10px] text-muted-foreground sm:text-xs">Mon</span>
                    </div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-1">
                        <div class="w-full rounded-t bg-primary/80" style="height: 80%"></div>
                        <span class="text-center text-[10px] text-muted-foreground sm:text-xs">Tue</span>
                    </div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-1">
                        <div class="w-full rounded-t bg-primary/80" style="height: 45%"></div>
                        <span class="text-center text-[10px] text-muted-foreground sm:text-xs">Wed</span>
                    </div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-1">
                        <div class="w-full rounded-t bg-primary/80" style="height: 70%"></div>
                        <span class="text-center text-[10px] text-muted-foreground sm:text-xs">Thu</span>
                    </div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-1">
                        <div class="w-full rounded-t bg-primary/80" style="height: 90%"></div>
                        <span class="text-center text-[10px] text-muted-foreground sm:text-xs">Fri</span>
                    </div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-1">
                        <div class="w-full rounded-t bg-primary/80" style="height: 55%"></div>
                        <span class="text-center text-[10px] text-muted-foreground sm:text-xs">Sat</span>
                    </div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-1">
                        <div class="w-full rounded-t bg-accent" style="height: 75%"></div>
                        <span class="text-center text-[10px] text-muted-foreground sm:text-xs">Sun</span>
                    </div>
                </div>
            </div>

            {{-- Recent Articles Table --}}
            <div class="rounded-lg border border-border bg-card">
                <div class="flex flex-col gap-3 border-b border-border p-4 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <div>
                        <h3 class="text-base font-semibold text-foreground sm:text-lg">Recent Articles</h3>
                        <p class="text-xs text-muted-foreground sm:text-sm">Latest published articles</p>
                    </div>
                    <a href="{{ url('/articles') }}" class="inline-flex items-center gap-1 text-sm font-medium text-primary hover:underline">
                        View all
                        <i class="ph-bold ph-arrow-right"></i>
                    </a>
                </div>

                {{-- Mobile Card View --}}
                <div class="divide-y divide-border sm:hidden">
                    <div class="p-4">
                        <div class="flex items-start gap-3">
                            <div class="h-12 w-12 shrink-0 rounded-lg bg-muted"></div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-foreground">Breaking: New Tech Innovation Announced</p>
                                <p class="mt-0.5 text-xs text-muted-foreground">Dec 24, 2025 • John Doe</p>
                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <span class="rounded-full bg-primary/10 px-2 py-0.5 text-xs font-medium text-primary">Technology</span>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">
                                        <i class="ph-bold ph-check-circle"></i>
                                        Published
                                    </span>
                                    <span class="text-xs text-muted-foreground">2,345 views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-start gap-3">
                            <div class="h-12 w-12 shrink-0 rounded-lg bg-muted"></div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-foreground">Sports: Championship Finals Results</p>
                                <p class="mt-0.5 text-xs text-muted-foreground">Dec 23, 2025 • Jane Smith</p>
                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <span class="rounded-full bg-accent/10 px-2 py-0.5 text-xs font-medium text-accent">Sports</span>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">
                                        <i class="ph-bold ph-check-circle"></i>
                                        Published
                                    </span>
                                    <span class="text-xs text-muted-foreground">1,876 views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-start gap-3">
                            <div class="h-12 w-12 shrink-0 rounded-lg bg-muted"></div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-foreground">Economy: Market Update This Week</p>
                                <p class="mt-0.5 text-xs text-muted-foreground">Dec 23, 2025 • Mike Johnson</p>
                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <span class="rounded-full bg-info/10 px-2 py-0.5 text-xs font-medium text-info">Business</span>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-warning/10 px-2 py-0.5 text-xs font-medium text-warning">
                                        <i class="ph-bold ph-clock"></i>
                                        Draft
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Desktop Table View --}}
                <div class="hidden overflow-x-auto sm:block">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-border bg-muted/30">
                                <th class="whitespace-nowrap px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-muted-foreground">Article</th>
                                <th class="whitespace-nowrap px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-muted-foreground">Category</th>
                                <th class="whitespace-nowrap px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-muted-foreground">Author</th>
                                <th class="whitespace-nowrap px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-muted-foreground">Status</th>
                                <th class="whitespace-nowrap px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-muted-foreground">Views</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            <tr class="hover:bg-muted/30">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-muted"></div>
                                        <div class="max-w-[200px]">
                                            <p class="truncate text-sm font-medium text-foreground">Breaking: New Tech Innovation Announced</p>
                                            <p class="text-xs text-muted-foreground">Dec 24, 2025</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="rounded-full bg-primary/10 px-2.5 py-1 text-xs font-medium text-primary">Technology</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-foreground">John Doe</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-1 text-xs font-medium text-success">
                                        <i class="ph-bold ph-check-circle"></i>
                                        Published
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-foreground">2,345</td>
                            </tr>
                            <tr class="hover:bg-muted/30">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-muted"></div>
                                        <div class="max-w-[200px]">
                                            <p class="truncate text-sm font-medium text-foreground">Sports: Championship Finals Results</p>
                                            <p class="text-xs text-muted-foreground">Dec 23, 2025</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="rounded-full bg-accent/10 px-2.5 py-1 text-xs font-medium text-accent">Sports</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-foreground">Jane Smith</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-1 text-xs font-medium text-success">
                                        <i class="ph-bold ph-check-circle"></i>
                                        Published
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-foreground">1,876</td>
                            </tr>
                            <tr class="hover:bg-muted/30">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-muted"></div>
                                        <div class="max-w-[200px]">
                                            <p class="truncate text-sm font-medium text-foreground">Economy: Market Update This Week</p>
                                            <p class="text-xs text-muted-foreground">Dec 23, 2025</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="rounded-full bg-info/10 px-2.5 py-1 text-xs font-medium text-info">Business</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-foreground">Mike Johnson</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-warning/10 px-2.5 py-1 text-xs font-medium text-warning">
                                        <i class="ph-bold ph-clock"></i>
                                        Draft
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-foreground">—</td>
                            </tr>
                            <tr class="hover:bg-muted/30">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-muted"></div>
                                        <div class="max-w-[200px]">
                                            <p class="truncate text-sm font-medium text-foreground">Entertainment: Movie Premiere Review</p>
                                            <p class="text-xs text-muted-foreground">Dec 22, 2025</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="rounded-full bg-destructive/10 px-2.5 py-1 text-xs font-medium text-destructive">Entertainment</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-foreground">Sarah Wilson</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-1 text-xs font-medium text-success">
                                        <i class="ph-bold ph-check-circle"></i>
                                        Published
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-foreground">3,102</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pending Comments --}}
            <div class="rounded-lg border border-border bg-card">
                <div class="flex flex-col gap-3 border-b border-border p-4 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <div>
                        <h3 class="text-base font-semibold text-foreground sm:text-lg">Pending Comments</h3>
                        <p class="text-xs text-muted-foreground sm:text-sm">Comments awaiting moderation</p>
                    </div>
                    <span class="inline-flex w-fit items-center rounded-full bg-warning/10 px-2.5 py-1 text-xs font-medium text-warning">
                        5 pending
                    </span>
                </div>
                <div class="divide-y divide-border">
                    <div class="flex gap-3 p-4 sm:gap-4 sm:p-6">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary sm:h-10 sm:w-10">
                            <span class="text-xs font-medium text-primary-foreground sm:text-sm">JD</span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-col gap-0.5 sm:flex-row sm:items-center sm:justify-between sm:gap-1">
                                <p class="text-sm font-medium text-foreground">John Doe</p>
                                <span class="text-xs text-muted-foreground">2 hours ago</span>
                            </div>
                            <p class="mt-1 text-xs text-muted-foreground sm:text-sm">Great article! Really enjoyed reading this piece about the new technology trends...</p>
                            <p class="mt-1.5 text-xs text-muted-foreground sm:mt-2">
                                On: <a href="#" class="text-primary hover:underline">Breaking: New Tech Innovation</a>
                            </p>
                            <div class="mt-2 flex flex-wrap gap-2 sm:mt-3">
                                <button class="inline-flex items-center gap-1 rounded-lg bg-success/10 px-2.5 py-1 text-xs font-medium text-success hover:bg-success/20 sm:px-3 sm:py-1.5">
                                    <i class="ph-bold ph-check"></i>
                                    <span class="hidden xs:inline">Approve</span>
                                </button>
                                <button class="inline-flex items-center gap-1 rounded-lg bg-destructive/10 px-2.5 py-1 text-xs font-medium text-destructive hover:bg-destructive/20 sm:px-3 sm:py-1.5">
                                    <i class="ph-bold ph-x"></i>
                                    <span class="hidden xs:inline">Reject</span>
                                </button>
                                <button class="inline-flex items-center gap-1 rounded-lg bg-muted px-2.5 py-1 text-xs font-medium text-foreground hover:bg-muted/80 sm:px-3 sm:py-1.5">
                                    <i class="ph-bold ph-flag"></i>
                                    <span class="hidden xs:inline">Spam</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-3 p-4 sm:gap-4 sm:p-6">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-accent sm:h-10 sm:w-10">
                            <span class="text-xs font-medium text-accent-foreground sm:text-sm">AS</span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-col gap-0.5 sm:flex-row sm:items-center sm:justify-between sm:gap-1">
                                <p class="text-sm font-medium text-foreground">Alice Smith</p>
                                <span class="text-xs text-muted-foreground">5 hours ago</span>
                            </div>
                            <p class="mt-1 text-xs text-muted-foreground sm:text-sm">This is very informative. Would love to see more content like this in the future!</p>
                            <p class="mt-1.5 text-xs text-muted-foreground sm:mt-2">
                                On: <a href="#" class="text-primary hover:underline">Sports: Championship Finals</a>
                            </p>
                            <div class="mt-2 flex flex-wrap gap-2 sm:mt-3">
                                <button class="inline-flex items-center gap-1 rounded-lg bg-success/10 px-2.5 py-1 text-xs font-medium text-success hover:bg-success/20 sm:px-3 sm:py-1.5">
                                    <i class="ph-bold ph-check"></i>
                                    <span class="hidden xs:inline">Approve</span>
                                </button>
                                <button class="inline-flex items-center gap-1 rounded-lg bg-destructive/10 px-2.5 py-1 text-xs font-medium text-destructive hover:bg-destructive/20 sm:px-3 sm:py-1.5">
                                    <i class="ph-bold ph-x"></i>
                                    <span class="hidden xs:inline">Reject</span>
                                </button>
                                <button class="inline-flex items-center gap-1 rounded-lg bg-muted px-2.5 py-1 text-xs font-medium text-foreground hover:bg-muted/80 sm:px-3 sm:py-1.5">
                                    <i class="ph-bold ph-flag"></i>
                                    <span class="hidden xs:inline">Spam</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-t border-border p-3 sm:p-4">
                    <a href="{{ url('/comments/pending') }}" class="flex items-center justify-center gap-1 text-sm font-medium text-primary hover:underline">
                        View all pending comments
                        <i class="ph-bold ph-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Right Column: Widgets --}}
        <div class="space-y-4 sm:space-y-6">

            {{-- Quick Actions --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                <h3 class="mb-3 text-base font-semibold text-foreground sm:mb-4 sm:text-lg">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-2 sm:gap-3">
                    <a href="{{ url('/articles/create') }}" class="flex flex-col items-center gap-1.5 rounded-lg border border-border p-3 transition-colors hover:bg-muted sm:gap-2 sm:p-4">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 sm:h-10 sm:w-10">
                            <i class="ph-bold ph-plus text-lg text-primary sm:text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-foreground sm:text-sm">New Article</span>
                    </a>
                    <a href="{{ url('/media/upload') }}" class="flex flex-col items-center gap-1.5 rounded-lg border border-border p-3 transition-colors hover:bg-muted sm:gap-2 sm:p-4">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent/10 sm:h-10 sm:w-10">
                            <i class="ph-bold ph-upload text-lg text-accent sm:text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-foreground sm:text-sm">Upload Media</span>
                    </a>
                    <a href="{{ url('/categories/create') }}" class="flex flex-col items-center gap-1.5 rounded-lg border border-border p-3 transition-colors hover:bg-muted sm:gap-2 sm:p-4">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-success/10 sm:h-10 sm:w-10">
                            <i class="ph-bold ph-folder-plus text-lg text-success sm:text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-foreground sm:text-sm">New Category</span>
                    </a>
                    <a href="{{ url('/users/create') }}" class="flex flex-col items-center gap-1.5 rounded-lg border border-border p-3 transition-colors hover:bg-muted sm:gap-2 sm:p-4">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-info/10 sm:h-10 sm:w-10">
                            <i class="ph-bold ph-user-plus text-lg text-info sm:text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-foreground sm:text-sm">Add User</span>
                    </a>
                </div>
            </div>

            {{-- Top Categories --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                <div class="mb-3 flex items-center justify-between sm:mb-4">
                    <h3 class="text-base font-semibold text-foreground sm:text-lg">Top Categories</h3>
                    <a href="{{ url('/categories') }}" class="text-xs font-medium text-primary hover:underline sm:text-sm">View all</a>
                </div>
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 sm:h-8 sm:w-8">
                                <i class="ph-bold ph-cpu text-sm text-primary sm:text-base"></i>
                            </div>
                            <span class="text-xs font-medium text-foreground sm:text-sm">Technology</span>
                        </div>
                        <span class="text-xs text-muted-foreground sm:text-sm">342</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-accent/10 sm:h-8 sm:w-8">
                                <i class="ph-bold ph-soccer-ball text-sm text-accent sm:text-base"></i>
                            </div>
                            <span class="text-xs font-medium text-foreground sm:text-sm">Sports</span>
                        </div>
                        <span class="text-xs text-muted-foreground sm:text-sm">287</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-info/10 sm:h-8 sm:w-8">
                                <i class="ph-bold ph-chart-line-up text-sm text-info sm:text-base"></i>
                            </div>
                            <span class="text-xs font-medium text-foreground sm:text-sm">Business</span>
                        </div>
                        <span class="text-xs text-muted-foreground sm:text-sm">234</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-destructive/10 sm:h-8 sm:w-8">
                                <i class="ph-bold ph-film-slate text-sm text-destructive sm:text-base"></i>
                            </div>
                            <span class="text-xs font-medium text-foreground sm:text-sm">Entertainment</span>
                        </div>
                        <span class="text-xs text-muted-foreground sm:text-sm">198</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-success/10 sm:h-8 sm:w-8">
                                <i class="ph-bold ph-globe text-sm text-success sm:text-base"></i>
                            </div>
                            <span class="text-xs font-medium text-foreground sm:text-sm">World News</span>
                        </div>
                        <span class="text-xs text-muted-foreground sm:text-sm">173</span>
                    </div>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                <h3 class="mb-3 text-base font-semibold text-foreground sm:mb-4 sm:text-lg">Recent Activity</h3>
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex gap-2 sm:gap-3">
                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-success/10 sm:h-8 sm:w-8">
                            <i class="ph-bold ph-article text-xs text-success sm:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-foreground sm:text-sm"><span class="font-medium">John Doe</span> published a new article</p>
                            <p class="text-[10px] text-muted-foreground sm:text-xs">2 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex gap-2 sm:gap-3">
                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-info/10 sm:h-8 sm:w-8">
                            <i class="ph-bold ph-user-plus text-xs text-info sm:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-foreground sm:text-sm"><span class="font-medium">New user</span> registered</p>
                            <p class="text-[10px] text-muted-foreground sm:text-xs">15 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex gap-2 sm:gap-3">
                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-warning/10 sm:h-8 sm:w-8">
                            <i class="ph-bold ph-pencil text-xs text-warning sm:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-foreground sm:text-sm"><span class="font-medium">Jane Smith</span> updated an article</p>
                            <p class="text-[10px] text-muted-foreground sm:text-xs">1 hour ago</p>
                        </div>
                    </div>
                    <div class="flex gap-2 sm:gap-3">
                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10 sm:h-8 sm:w-8">
                            <i class="ph-bold ph-chat-circle text-xs text-primary sm:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-foreground sm:text-sm"><span class="font-medium">5 new comments</span> need approval</p>
                            <p class="text-[10px] text-muted-foreground sm:text-xs">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex gap-2 sm:gap-3">
                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-accent/10 sm:h-8 sm:w-8">
                            <i class="ph-bold ph-folder-plus text-xs text-accent sm:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-foreground sm:text-sm"><span class="font-medium">Admin</span> created a new category</p>
                            <p class="text-[10px] text-muted-foreground sm:text-xs">3 hours ago</p>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/logs/user-activity') }}" class="mt-3 flex items-center justify-center gap-1 text-xs font-medium text-primary hover:underline sm:mt-4 sm:text-sm">
                    View all activity
                    <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>

            {{-- Popular Tags --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                <div class="mb-3 flex items-center justify-between sm:mb-4">
                    <h3 class="text-base font-semibold text-foreground sm:text-lg">Popular Tags</h3>
                    <a href="{{ url('/tags') }}" class="text-xs font-medium text-primary hover:underline sm:text-sm">View all</a>
                </div>
                <div class="flex flex-wrap gap-1.5 sm:gap-2">
                    <a href="#" class="rounded-full border border-border bg-muted/50 px-2 py-1 text-[10px] font-medium text-foreground transition-colors hover:bg-muted sm:px-3 sm:py-1.5 sm:text-xs">
                        #breaking-news
                    </a>
                    <a href="#" class="rounded-full border border-border bg-muted/50 px-2 py-1 text-[10px] font-medium text-foreground transition-colors hover:bg-muted sm:px-3 sm:py-1.5 sm:text-xs">
                        #technology
                    </a>
                    <a href="#" class="rounded-full border border-border bg-muted/50 px-2 py-1 text-[10px] font-medium text-foreground transition-colors hover:bg-muted sm:px-3 sm:py-1.5 sm:text-xs">
                        #sports
                    </a>
                    <a href="#" class="rounded-full border border-border bg-muted/50 px-2 py-1 text-[10px] font-medium text-foreground transition-colors hover:bg-muted sm:px-3 sm:py-1.5 sm:text-xs">
                        #politics
                    </a>
                    <a href="#" class="rounded-full border border-border bg-muted/50 px-2 py-1 text-[10px] font-medium text-foreground transition-colors hover:bg-muted sm:px-3 sm:py-1.5 sm:text-xs">
                        #entertainment
                    </a>
                    <a href="#" class="rounded-full border border-border bg-muted/50 px-2 py-1 text-[10px] font-medium text-foreground transition-colors hover:bg-muted sm:px-3 sm:py-1.5 sm:text-xs">
                        #business
                    </a>
                    <a href="#" class="rounded-full border border-border bg-muted/50 px-2 py-1 text-[10px] font-medium text-foreground transition-colors hover:bg-muted sm:px-3 sm:py-1.5 sm:text-xs">
                        #world
                    </a>
                    <a href="#" class="rounded-full border border-border bg-muted/50 px-2 py-1 text-[10px] font-medium text-foreground transition-colors hover:bg-muted sm:px-3 sm:py-1.5 sm:text-xs">
                        #health
                    </a>
                </div>
            </div>

            {{-- System Status --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                <h3 class="mb-3 text-base font-semibold text-foreground sm:mb-4 sm:text-lg">System Status</h3>
                <div class="space-y-2 sm:space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-success"></span>
                            <span class="text-xs text-foreground sm:text-sm">Server Status</span>
                        </div>
                        <span class="text-xs font-medium text-success sm:text-sm">Online</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-success"></span>
                            <span class="text-xs text-foreground sm:text-sm">Database</span>
                        </div>
                        <span class="text-xs font-medium text-success sm:text-sm">Connected</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-success"></span>
                            <span class="text-xs text-foreground sm:text-sm">Cache</span>
                        </div>
                        <span class="text-xs font-medium text-success sm:text-sm">Active</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-warning"></span>
                            <span class="text-xs text-foreground sm:text-sm">Storage</span>
                        </div>
                        <span class="text-xs font-medium text-warning sm:text-sm">72% used</span>
                    </div>
                </div>
                <div class="mt-3 rounded-lg bg-muted/50 p-2 sm:mt-4 sm:p-3">
                    <div class="flex items-center justify-between text-[10px] sm:text-xs">
                        <span class="text-muted-foreground">Last backup</span>
                        <span class="font-medium text-foreground">Dec 24, 2025</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
