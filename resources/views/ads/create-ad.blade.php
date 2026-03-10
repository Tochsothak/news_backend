@extends('layouts.app')

@section('title', 'Create Advertisement')
@section('breadcrumb', 'Ads / Create')

@section('content')
<div class="p-4 sm:p-6" x-data="{
    campaignName: '',
    status: 'active',
    mediaPreview: null,
    mediaType: null,
    selectedZones: [],

    // Handle File Upload Preview
    handleFile(event) {
        const file = event.target.files[0];
        if (!file) return;

        if (file.type.startsWith('video/')) {
            this.mediaType = 'video';
        } else {
            this.mediaType = 'image';
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            this.mediaPreview = e.target.result;
        };
        reader.readAsDataURL(file);
    },

    // Remove Media
    removeMedia() {
        this.mediaPreview = null;
        this.mediaType = null;
        this.$refs.fileInput.value = '';
    }
}">
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Page Header --}}
        <div class="mb-4 sm:mb-6 border-b border-border pb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-foreground sm:text-2xl">Create Advertisement</h1>
                <p class="mt-1 text-sm text-muted-foreground">Upload media, set destination URLs, and configure display zones.</p>
            </div>
            <a href="{{ route('ads.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                <i class="ph-bold ph-arrow-left"></i>
                Back to Ads
            </a>
        </div>

        {{-- Main Form Grid --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 items-start">

            {{-- Left Column: Main Ad Content --}}
            <div class="flex flex-col gap-6 lg:col-span-2">

                {{-- Campaign Details (Directly inline as it's the core of the form) --}}
                <div class="rounded-xl border border-border bg-card shadow-sm overflow-hidden p-6">
                    <h2 class="text-lg font-semibold text-foreground mb-4">Campaign Details</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="campaign" class="block text-sm font-medium text-foreground mb-1.5">Campaign Name <span class="text-destructive">*</span></label>
                            <input type="text" id="campaign" name="campaign" x-model="campaignName" placeholder="e.g., Summer Promo 2026" class="w-full rounded-lg border border-border bg-background px-4 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="client" class="block text-sm font-medium text-foreground mb-1.5">Client / Sponsor</label>
                                <div class="relative">
                                    <i class="ph-bold ph-buildings absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
                                    <input type="text" id="client" name="client" placeholder="e.g., Smart Axiata" class="w-full rounded-lg border border-border bg-background py-2.5 pl-10 pr-4 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                                </div>
                            </div>
                            <div>
                                <label for="url" class="block text-sm font-medium text-foreground mb-1.5">Destination URL <span class="text-destructive">*</span></label>
                                <div class="relative">
                                    <i class="ph-bold ph-link absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
                                    <input type="url" id="url" name="url" placeholder="https://example.com/promo" class="w-full rounded-lg border border-border bg-background py-2.5 pl-10 pr-4 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Componentized Ad Media --}}
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
                <i class="ph-bold ph-megaphone text-lg mr-2"></i>
                Save Advertisement
            </button>
        </div>

    </form>
</div>
@endsection
