@extends('layouts.app')

@section('title', 'Dashboard - News Portal')
@section('breadcrumb', 'Dashboard')

@section('content')
    {{-- Welcome Card --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-foreground">Welcome to News Portal</h1>
        <p class="mt-1 text-muted-foreground">Manage your content and monitor your news portal from here.</p>
    </div>

    {{-- Stats Grid --}}
    <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        {{-- Total Articles --}}
        <div class="rounded-lg border border-border bg-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Total Articles</p>
                    <p class="mt-1 text-2xl font-bold text-foreground">1,234</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-primary/10">
                    <i class="ph-bold ph-article text-xl text-primary"></i>
                </div>
            </div>
            <p class="mt-2 text-xs text-success">
                <i class="ph-bold ph-trend-up"></i> +12% from last month
            </p>
        </div>

        {{-- Total Users --}}
        <div class="rounded-lg border border-border bg-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Total Users</p>
                    <p class="mt-1 text-2xl font-bold text-foreground">5,678</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-accent/10">
                    <i class="ph-bold ph-users text-xl text-accent"></i>
                </div>
            </div>
            <p class="mt-2 text-xs text-success">
                <i class="ph-bold ph-trend-up"></i> +8% from last month
            </p>
        </div>

        {{-- Page Views --}}
        <div class="rounded-lg border border-border bg-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Page Views</p>
                    <p class="mt-1 text-2xl font-bold text-foreground">89.2K</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-info/10">
                    <i class="ph-bold ph-eye text-xl text-info"></i>
                </div>
            </div>
            <p class="mt-2 text-xs text-success">
                <i class="ph-bold ph-trend-up"></i> +24% from last month
            </p>
        </div>

        {{-- Categories --}}
        <div class="rounded-lg border border-border bg-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Categories</p>
                    <p class="mt-1 text-2xl font-bold text-foreground">24</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-success/10">
                    <i class="ph-bold ph-folders text-xl text-success"></i>
                </div>
            </div>
            <p class="mt-2 text-xs text-muted-foreground">
                <i class="ph-bold ph-minus"></i> No change
            </p>
        </div>
    </div>

    {{-- Theme Test Card --}}
    <div class="rounded-lg border border-border bg-card p-6">
        <h2 class="text-lg font-semibold text-foreground">Theme Components</h2>
        <p class="mt-1 text-muted-foreground">Theme tokens working ✅</p>

        <div class="mt-4 flex flex-wrap gap-2">
            <button class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90">
                Primary
            </button>
            <button class="rounded-lg bg-accent px-4 py-2 text-sm font-medium text-accent-foreground hover:bg-accent/90">
                Accent
            </button>
            <button class="rounded-lg bg-destructive px-4 py-2 text-sm font-medium text-destructive-foreground hover:bg-destructive/90">
                Destructive
            </button>
            <button class="rounded-lg border border-border bg-background px-4 py-2 text-sm font-medium text-foreground hover:bg-muted">
                Outline
            </button>
            <button class="rounded-lg bg-secondary px-4 py-2 text-sm font-medium text-secondary-foreground hover:bg-secondary/80">
                Secondary
            </button>
        </div>
    </div>
@endsection
