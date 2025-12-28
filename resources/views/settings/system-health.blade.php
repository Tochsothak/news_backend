@extends('layouts.app')

@section('title', 'System Health - Settings')
@section('breadcrumb', 'Settings / System Health')

@section('content')
    {{-- Page Header --}}
    <div class="mb-4 sm:mb-6">
        <h1 class="text-xl font-bold text-foreground sm:text-2xl">System Health</h1>
        <p class="mt-1 text-sm text-muted-foreground sm:text-base">Monitor your system status, server health, and performance
            metrics.</p>
    </div>

    {{-- Quick Stats Grid --}}
    <div class="mb-4 grid grid-cols-2 gap-3 sm:mb-6 sm:gap-4 lg:grid-cols-4">
        {{-- Server Uptime --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <div class="min-w-0">
                    <p class="truncate text-xs font-medium text-muted-foreground sm:text-sm">Server Uptime</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">99.9%</p>
                </div>
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-success/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-arrow-up text-lg text-success sm:text-xl"></i>
                </div>
            </div>
            <p class="mt-2 hidden text-xs text-success sm:block">
                <i class="ph-bold ph-check-circle"></i> 30 days without downtime
            </p>
        </div>

        {{-- Response Time --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <div class="min-w-0">
                    <p class="truncate text-xs font-medium text-muted-foreground sm:text-sm">Avg Response</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">124ms</p>
                </div>
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-lightning text-lg text-primary sm:text-xl"></i>
                </div>
            </div>
            <p class="mt-2 hidden text-xs text-success sm:block">
                <i class="ph-bold ph-trend-down"></i> -12ms from last week
            </p>
        </div>

        {{-- Memory Usage --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <div class="min-w-0">
                    <p class="truncate text-xs font-medium text-muted-foreground sm:text-sm">Memory Usage</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">2.4 GB</p>
                </div>
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-info/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-memory text-lg text-info sm:text-xl"></i>
                </div>
            </div>
            <p class="mt-2 hidden text-xs text-muted-foreground sm:block">
                <i class="ph-bold ph-minus"></i> 60% of 4 GB
            </p>
        </div>

        {{-- CPU Usage --}}
        <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <div class="min-w-0">
                    <p class="truncate text-xs font-medium text-muted-foreground sm:text-sm">CPU Usage</p>
                    <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">23%</p>
                </div>
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-accent/10 sm:h-12 sm:w-12">
                    <i class="ph-bold ph-cpu text-lg text-accent sm:text-xl"></i>
                </div>
            </div>
            <p class="mt-2 hidden text-xs text-success sm:block">
                <i class="ph-bold ph-check-circle"></i> Normal load
            </p>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">

        {{-- Left Column --}}
        <div class="space-y-4 sm:space-y-6 lg:col-span-2">

            {{-- System Status --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6" x-data="{
                loading: false,
                lastChecked: 'Just now',
                async refresh() {
                    this.loading = true;
                    // Simulate API call - replace with actual endpoint
                    await new Promise(resolve => setTimeout(resolve, 1500));
                    this.loading = false;
                    this.lastChecked = 'Just now';
                }
            }">
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-foreground sm:text-lg">System Status</h3>
                        <p class="text-[10px] text-muted-foreground sm:text-xs">
                            Last checked: <span x-text="lastChecked"></span>
                        </p>
                    </div>
                    <button @click="refresh()" :disabled="loading"
                        class="inline-flex items-center gap-1 rounded-lg bg-primary/10 px-3 py-1.5 text-xs font-medium text-primary transition-colors hover:bg-primary/20 disabled:cursor-not-allowed disabled:opacity-50 sm:text-sm">
                        <i class="ph-bold ph-arrows-clockwise" :class="loading && 'animate-spin'"></i>
                        <span x-text="loading ? 'Checking...' : 'Refresh'"></span>
                    </button>
                </div>

                {{-- Loading Overlay --}}
                <div x-show="loading" class="absolute inset-0 z-10 flex items-center justify-center rounded-lg bg-card/80">
                    <div class="flex items-center gap-2 text-sm text-muted-foreground">
                        <i class="ph-bold ph-spinner animate-spin"></i>
                        Checking services...
                    </div>
                </div>

                <div class="space-y-3 sm:space-y-4">
                    {{-- Web Server --}}
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success/10">
                                <i class="ph-bold ph-globe text-lg text-success"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Web Server (Nginx)</p>
                                <p class="text-xs text-muted-foreground">Running on port 80/443</p>
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-1 text-xs font-medium text-success">
                            <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                            Online
                        </span>
                    </div>

                    {{-- Database --}}
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success/10">
                                <i class="ph-bold ph-database text-lg text-success"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Database (MySQL)</p>
                                <p class="text-xs text-muted-foreground">Version 8.0.32 • 1.2 GB used</p>
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-1 text-xs font-medium text-success">
                            <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                            Connected
                        </span>
                    </div>

                    {{-- Redis Cache --}}
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success/10">
                                <i class="ph-bold ph-lightning text-lg text-success"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Cache (Redis)</p>
                                <p class="text-xs text-muted-foreground">Hit rate: 94.2% • 256 MB used</p>
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-1 text-xs font-medium text-success">
                            <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                            Active
                        </span>
                    </div>

                    {{-- Queue Worker --}}
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success/10">
                                <i class="ph-bold ph-queue text-lg text-success"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Queue Worker</p>
                                <p class="text-xs text-muted-foreground">3 workers • 0 failed jobs</p>
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-1 text-xs font-medium text-success">
                            <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                            Running
                        </span>
                    </div>

                    {{-- Storage --}}
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-warning/10">
                                <i class="ph-bold ph-hard-drives text-lg text-warning"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Disk Storage</p>
                                <p class="text-xs text-muted-foreground">7.2 GB / 10 GB used</p>
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-warning/10 px-2.5 py-1 text-xs font-medium text-warning">
                            <span class="h-1.5 w-1.5 rounded-full bg-warning"></span>
                            72% Used
                        </span>
                    </div>

                    {{-- Mail Server --}}
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success/10">
                                <i class="ph-bold ph-envelope text-lg text-success"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Mail Server (SMTP)</p>
                                <p class="text-xs text-muted-foreground">Last sent: 5 minutes ago</p>
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2.5 py-1 text-xs font-medium text-success">
                            <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                            Connected
                        </span>
                    </div>
                </div>
            </div>

            {{-- PHP & Laravel Info --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                <h3 class="mb-4 text-base font-semibold text-foreground sm:text-lg">Environment Information</h3>

                <div class="grid gap-3 sm:grid-cols-2 sm:gap-4">
                    <div class="rounded-lg bg-muted/30 p-3 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                <i class="ph-bold ph-code text-lg text-primary"></i>
                            </div>
                            <div>
                                <p class="text-xs text-muted-foreground">PHP Version</p>
                                <p class="text-sm font-semibold text-foreground">8.4.1</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-lg bg-muted/30 p-3 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-destructive/10">
                                <i class="ph-bold ph-laravel-logo text-lg text-destructive"></i>
                            </div>
                            <div>
                                <p class="text-xs text-muted-foreground">Laravel Version</p>
                                <p class="text-sm font-semibold text-foreground">12.39.0</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-lg bg-muted/30 p-3 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-info/10">
                                <i class="ph-bold ph-database text-lg text-info"></i>
                            </div>
                            <div>
                                <p class="text-xs text-muted-foreground">MySQL Version</p>
                                <p class="text-sm font-semibold text-foreground">9.4.0</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-lg bg-muted/30 p-3 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-accent/10">
                                <i class="ph-bold ph-git-branch text-lg text-accent"></i>
                            </div>
                            <div>
                                <p class="text-xs text-muted-foreground">App Version</p>
                                <p class="text-sm font-semibold text-foreground">1.0.0</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Environment Mode --}}
                <div class="mt-4 flex items-center justify-between rounded-lg border border-border p-3 sm:p-4">
                    <div class="flex items-center gap-3">
                        <i class="ph-bold ph-gear text-lg text-muted-foreground"></i>
                        <div>
                            <p class="text-sm font-medium text-foreground">Environment Mode</p>
                            <p class="text-xs text-muted-foreground">Current application environment</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-success/10 px-3 py-1 text-xs font-semibold text-success">
                        Production
                    </span>
                </div>

                {{-- Debug Mode --}}
                <div class="mt-3 flex items-center justify-between rounded-lg border border-border p-3 sm:p-4">
                    <div class="flex items-center gap-3">
                        <i class="ph-bold ph-bug text-lg text-muted-foreground"></i>
                        <div>
                            <p class="text-sm font-medium text-foreground">Debug Mode</p>
                            <p class="text-xs text-muted-foreground">APP_DEBUG setting</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-success/10 px-3 py-1 text-xs font-semibold text-success">
                        Disabled
                    </span>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="space-y-4 sm:space-y-6">

            {{-- Quick Actions --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                <h3 class="mb-3 text-base font-semibold text-foreground sm:mb-4 sm:text-lg">Quick Actions</h3>
                <div class="space-y-2 sm:space-y-3">
                    <button
                        class="flex w-full items-center gap-3 rounded-lg border border-border p-3 text-left transition-colors hover:bg-muted">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10">
                            <i class="ph-bold ph-arrows-clockwise text-sm text-primary"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-foreground">Clear Cache</p>
                            <p class="text-xs text-muted-foreground">Clear all application cache</p>
                        </div>
                    </button>

                    <button
                        class="flex w-full items-center gap-3 rounded-lg border border-border p-3 text-left transition-colors hover:bg-muted">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent/10">
                            <i class="ph-bold ph-broom text-sm text-accent"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-foreground">Optimize App</p>
                            <p class="text-xs text-muted-foreground">Run optimization commands</p>
                        </div>
                    </button>

                    <button
                        class="flex w-full items-center gap-3 rounded-lg border border-border p-3 text-left transition-colors hover:bg-muted">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-info/10">
                            <i class="ph-bold ph-database text-sm text-info"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-foreground">Run Migrations</p>
                            <p class="text-xs text-muted-foreground">Execute pending migrations</p>
                        </div>
                    </button>

                    <button
                        class="flex w-full items-center gap-3 rounded-lg border border-border p-3 text-left transition-colors hover:bg-muted">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-warning/10">
                            <i class="ph-bold ph-download text-sm text-warning"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-foreground">Download Logs</p>
                            <p class="text-xs text-muted-foreground">Export system logs</p>
                        </div>
                    </button>
                </div>
            </div>

            {{-- Storage Breakdown --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                <h3 class="mb-3 text-base font-semibold text-foreground sm:mb-4 sm:text-lg">Storage Breakdown</h3>

                {{-- Total Usage with Segmented Colors --}}
                <div class="mb-4">
                    <div class="flex items-center justify-between text-xs sm:text-sm">
                        <span class="text-muted-foreground">Total Used</span>
                        <span class="font-medium text-foreground">7.2 GB / 10 GB</span>
                    </div>

                    {{-- Segmented Progress Bar --}}
                    <div class="mt-2 flex h-3 w-full overflow-hidden rounded-full bg-muted">
                        <div class="h-full bg-primary" style="width: 42%" title="Images: 4.2 GB"></div>
                        <div class="h-full bg-accent" style="width: 21%" title="Videos: 2.1 GB"></div>
                        <div class="h-full bg-info" style="width: 5%" title="Documents: 0.5 GB"></div>
                        <div class="h-full bg-warning" style="width: 4%" title="Database: 0.4 GB"></div>
                    </div>

                    {{-- Status Message --}}
                    <p class="mt-2 flex items-center gap-1 text-[10px] text-warning sm:text-xs">
                        <i class="ph-bold ph-warning"></i>
                        72% used - Storage reaching limit
                    </p>
                </div>

                {{-- Breakdown by Type with Size --}}
                <div class="space-y-2">
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-2 sm:p-2.5">
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-primary"></span>
                            <span class="text-xs text-foreground sm:text-sm">Images</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold text-foreground sm:text-sm">4.2 GB</span>
                            <span
                                class="rounded bg-primary/10 px-1.5 py-0.5 text-[10px] font-medium text-primary">58%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-2 sm:p-2.5">
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-accent"></span>
                            <span class="text-xs text-foreground sm:text-sm">Videos</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold text-foreground sm:text-sm">2.1 GB</span>
                            <span class="rounded bg-accent/10 px-1.5 py-0.5 text-[10px] font-medium text-accent">29%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-2 sm:p-2.5">
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-info"></span>
                            <span class="text-xs text-foreground sm:text-sm">Documents</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold text-foreground sm:text-sm">0.5 GB</span>
                            <span class="rounded bg-info/10 px-1.5 py-0.5 text-[10px] font-medium text-info">7%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-2 sm:p-2.5">
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-warning"></span>
                            <span class="text-xs text-foreground sm:text-sm">Database</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold text-foreground sm:text-sm">0.4 GB</span>
                            <span
                                class="rounded bg-warning/10 px-1.5 py-0.5 text-[10px] font-medium text-warning">6%</span>
                        </div>
                    </div>
                </div>

                {{-- Suggested Actions --}}
                <div class="mt-4 rounded-lg border border-warning/30 bg-warning/5 p-3">
                    <p class="mb-2 text-xs font-medium text-warning">Suggested Actions:</p>
                    <ul class="space-y-1 text-[10px] text-muted-foreground sm:text-xs">
                        <li class="flex items-center gap-1">
                            <i class="ph-bold ph-trash text-muted-foreground"></i>
                            Empty trash & delete unused media
                        </li>
                        <li class="flex items-center gap-1">
                            <i class="ph-bold ph-file-archive text-muted-foreground"></i>
                            Compress large images
                        </li>
                        <li class="flex items-center gap-1">
                            <i class="ph-bold ph-cloud-arrow-up text-muted-foreground"></i>
                            Move videos to external CDN
                        </li>
                    </ul>
                </div>

                <a href="{{ url('/media') }}"
                    class="mt-4 flex items-center justify-center gap-1 text-xs font-medium text-primary hover:underline sm:text-sm">
                    Manage Storage
                    <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>

            {{-- Recent Backups --}}
            <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                <div class="mb-3 flex items-center justify-between sm:mb-4">
                    <h3 class="text-base font-semibold text-foreground sm:text-lg">Recent Backups</h3>
                    <a href="{{ url('/backup/create') }}"
                        class="text-xs font-medium text-primary hover:underline sm:text-sm">
                        Create New
                    </a>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                        <div class="flex items-center gap-2">
                            <i class="ph-bold ph-check-circle text-success"></i>
                            <div>
                                <p class="text-xs font-medium text-foreground sm:text-sm">Full Backup</p>
                                <p class="text-[10px] text-muted-foreground sm:text-xs">Dec 24, 2025 • 2.3 GB</p>
                            </div>
                        </div>
                        <button class="text-xs text-primary hover:underline">
                            <i class="ph-bold ph-download"></i>
                        </button>
                    </div>

                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                        <div class="flex items-center gap-2">
                            <i class="ph-bold ph-check-circle text-success"></i>
                            <div>
                                <p class="text-xs font-medium text-foreground sm:text-sm">Database Only</p>
                                <p class="text-[10px] text-muted-foreground sm:text-xs">Dec 23, 2025 • 0.4 GB</p>
                            </div>
                        </div>
                        <button class="text-xs text-primary hover:underline">
                            <i class="ph-bold ph-download"></i>
                        </button>
                    </div>

                    <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                        <div class="flex items-center gap-2">
                            <i class="ph-bold ph-check-circle text-success"></i>
                            <div>
                                <p class="text-xs font-medium text-foreground sm:text-sm">Full Backup</p>
                                <p class="text-[10px] text-muted-foreground sm:text-xs">Dec 17, 2025 • 2.1 GB</p>
                            </div>
                        </div>
                        <button class="text-xs text-primary hover:underline">
                            <i class="ph-bold ph-download"></i>
                        </button>
                    </div>
                </div>

                <a href="{{ url('/backup/restore') }}"
                    class="mt-4 flex items-center justify-center gap-1 text-xs font-medium text-primary hover:underline sm:text-sm">
                    View All Backups
                    <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
