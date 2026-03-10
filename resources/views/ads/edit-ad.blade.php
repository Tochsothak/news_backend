@extends('layouts.app')

@section('title', 'Edit Advertisement')
@section('breadcrumb', 'Ads / Edit')

@section('content')
@php
    // Dummy Data simulating an existing ad fetched from the database
    $ad = [
        'id' => $id ?? 501,
        'campaign' => 'Smart 5G Unlimited Plan',
        'client' => 'Smart Axiata',
        'url' => 'https://smart.com.kh/5g-promo',
        'status' => 'active', // active, scheduled, inactive
        'start_date' => '',
        'end_date' => '2026-12-31T23:59',
        'zones' => ['home_popup', 'article_middle'], // Pre-selected zones
        'priority' => 8,
        'last_edited' => '2 hours ago',
    ];
@endphp

{{--
    Notice how we initialize Alpine's x-data with the existing $ad data.
    Because your components use x-model="status" and x-model="selectedZones",
    they will automatically read these values and pre-fill the form!
--}}
<div class="p-4 sm:p-6" x-data="{
    campaignName: '{{ addslashes($ad['campaign']) }}',
    status: '{{ $ad['status'] }}',
    selectedZones: {{ json_encode($ad['zones']) }}
}">
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Page Header --}}
        <div class="mb-4 sm:mb-6 border-b border-border pb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-xl font-bold text-foreground sm:text-2xl">Edit Advertisement</h1>

                    {{-- Dynamic Status Badge --}}
                    @if($ad['status'] === 'active')
                        <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">
                            <span class="h-1.5 w-1.5 rounded-full bg-success animate-pulse"></span>
                            Active
                        </span>
                    @elseif($ad['status'] === 'scheduled')
                        <span class="inline-flex items-center gap-1 rounded-full bg-info/10 px-2 py-0.5 text-xs font-medium text-info">
                            <span class="h-1.5 w-1.5 rounded-full bg-info"></span>
                            Scheduled
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 rounded-full bg-muted px-2 py-0.5 text-xs font-medium text-muted-foreground border border-border">
                            <span class="h-1.5 w-1.5 rounded-full bg-muted-foreground"></span>
                            Inactive
                        </span>
                    @endif
                </div>
                <p class="mt-1 text-sm text-muted-foreground">Last edited {{ $ad['last_edited'] }}</p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('ads.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                    <i class="ph-bold ph-arrow-left"></i>
                    <span class="hidden sm:inline">Back</span>
                </a>
                <a href="{{ route('ads.reports') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-primary transition-colors hover:bg-primary/10">
                    <i class="ph-bold ph-chart-line-up"></i>
                    <span class="hidden sm:inline">View Report</span>
                </a>
            </div>
        </div>

        {{-- Main Form Grid --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 items-start">

            {{-- Left Column: Main Ad Content --}}
            <div class="flex flex-col gap-6 lg:col-span-2">

                {{-- Campaign Details --}}
                <div class="rounded-xl border border-border bg-card shadow-sm overflow-hidden p-6">
                    <h2 class="text-lg font-semibold text-foreground mb-4">Campaign Details</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="campaign" class="block text-sm font-medium text-foreground mb-1.5">Campaign Name <span class="text-destructive">*</span></label>
                            <input type="text" id="campaign" name="campaign" x-model="campaignName" class="w-full rounded-lg border border-border bg-background px-4 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="client" class="block text-sm font-medium text-foreground mb-1.5">Client / Sponsor</label>
                                <div class="relative">
                                    <i class="ph-bold ph-buildings absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
                                    <input type="text" id="client" name="client" value="{{ $ad['client'] }}" class="w-full rounded-lg border border-border bg-background py-2.5 pl-10 pr-4 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                                </div>
                            </div>
                            <div>
                                <label for="url" class="block text-sm font-medium text-foreground mb-1.5">Destination URL <span class="text-destructive">*</span></label>
                                <div class="relative">
                                    <i class="ph-bold ph-link absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
                                    <input type="url" id="url" name="url" value="{{ $ad['url'] }}" class="w-full rounded-lg border border-border bg-background py-2.5 pl-10 pr-4 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Componentized Ad Media --}}
                {{-- Note: To pre-fill images in a real app, you would pass the existing media URLs as props to this component! --}}
                <x-ad.media-widget />

            </div>

            {{-- Right Column: Settings & Widgets (Componentized) --}}
            <div class="flex flex-col gap-6 lg:sticky lg:top-6">
                <x-ad.status-widget />
                <x-ad.zones-widget />
                <x-ad.priority-widget />
            </div>

        </div>

        {{-- Form Actions --}}
        <div class="mt-8 flex items-center justify-end gap-4 border-t border-border pt-6 pb-2">
            <button type="button" class="inline-flex items-center justify-center rounded-lg border border-border bg-card px-6 py-2.5 text-sm font-medium text-foreground shadow-sm transition-all hover:bg-muted active:scale-[0.98]">
                Cancel
            </button>
            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-primary px-8 py-2.5 text-sm font-medium text-primary-foreground shadow-sm transition-all hover:bg-primary/90 active:scale-[0.98]">
                <i class="ph-bold ph-floppy-disk text-lg mr-2"></i>
                Update Advertisement
            </button>
        </div>

    </form>
</div>
@endsection
