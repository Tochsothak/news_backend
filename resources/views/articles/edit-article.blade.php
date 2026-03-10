@extends('layouts.app')

@section('title', 'Edit Article')
@section('breadcrumb', 'Articles / Edit')

@push('styles')
    @vite(['resources/css/tiptap/tiptap.css'])
@endpush

@push('scripts')
    @vite(['resources/js/tiptap/tiptap.js'])
@endpush

@section('content')
@php
    // Dummy Data to simulate loading an existing article based on the $id from the route
    $article = [
        'id' => $id ?? 1,
        'title' => 'The Future of Web Development in 2026',
        'slug' => 'future-of-web-development-2026-a1b2c',
        'status' => 'Published', // Could be Draft, Scheduled, etc.
        'last_edited' => '10 mins ago',
    ];
@endphp

<div class="p-4 sm:p-6" x-data="{
    title: '{{ addslashes($article['title']) }}',
    slug: '{{ addslashes($article['slug']) }}',
    uniqueId: '{{ explode('-', $article['slug'])[count(explode('-', $article['slug'])) - 1] ?? '' }}',
    init() {
        // Only generate a new unique ID if one doesn't exist from the slug
        if (!this.uniqueId) {
            this.uniqueId = Math.random().toString(36).substring(2, 7);
        }
        // Ensure the title textarea is the correct height on initial load
        $nextTick(() => {
            let el = document.getElementById('title');
            if(el) {
                el.style.height = 'auto';
                el.style.height = el.scrollHeight + 'px';
            }
        });
    },
    generateSlug() {
        // In an edit view, you might want to prevent auto-updating the slug
        // if it's already published to avoid breaking SEO links.
        // For this UI, it updates dynamically when the title changes.
        let baseSlug = this.title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
        this.slug = baseSlug ? `${baseSlug}-${this.uniqueId}` : '';
    },
    resizeTitle(e) {
        e.target.style.height = 'auto';
        e.target.style.height = e.target.scrollHeight + 'px';
    }
}">
    {{-- Notice the action would eventually point to an update route like route('articles.update', $article['id']) --}}
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Page Header (Contextualized for Editing) --}}
        <div class="mb-4 sm:mb-6 border-b border-border pb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-xl font-bold text-foreground sm:text-2xl">Edit Article</h1>

                    {{-- Dynamic Status Badge --}}
                    @if($article['status'] === 'Published')
                        <span class="inline-flex items-center gap-1 rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">
                            <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                            Published
                        </span>
                    @elseif($article['status'] === 'Draft')
                        <span class="inline-flex items-center gap-1 rounded-full bg-accent/10 px-2 py-0.5 text-xs font-medium text-accent">
                            <span class="h-1.5 w-1.5 rounded-full bg-accent"></span>
                            Draft
                        </span>
                    @endif
                </div>
                <p class="mt-1 text-sm text-muted-foreground">
                    Last edited {{ $article['last_edited'] }}
                </p>
            </div>

            {{-- Quick Actions --}}
            <div class="flex items-center gap-2">
                <a href="#" class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-3 py-1.5 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                    <i class="ph-bold ph-arrow-square-out"></i>
                    <span class="hidden sm:inline">View Live</span>
                </a>
            </div>
        </div>

        {{-- Main Form Grid --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 items-start">

            {{-- Left Column: Unified Document Area --}}
            <div class="flex flex-col lg:col-span-2 rounded-xl border border-border bg-card shadow-sm overflow-hidden">

                {{-- Document Header (Title & Slug) --}}
                <div class="p-6 sm:p-8 sm:pb-4 border-b border-border/40">
                    <textarea
                        id="title"
                        name="title"
                        x-model="title"
                        @input="generateSlug(); resizeTitle($event)"
                        placeholder="Article Title..."
                        class="w-full resize-none overflow-hidden bg-transparent text-3xl sm:text-4xl font-black text-foreground placeholder-muted-foreground focus:outline-none border-0 p-0 focus:ring-0 leading-tight"
                        rows="1"
                        required
                    ></textarea>

                    <div class="mt-4 flex items-center text-sm text-muted-foreground group">
                        <i class="ph-bold ph-link mr-2"></i>
                        <span class="select-none hidden sm:inline">{{ url('/') }}/article/</span>
                        <span class="select-none sm:hidden">/article/</span>
                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            x-model="slug"
                            class="flex-1 bg-transparent px-1 focus:outline-none text-foreground border-b border-transparent focus:border-primary transition-colors group-hover:border-border/60"
                            placeholder="your-url-slug"
                        >
                    </div>
                </div>

                {{-- The Componentized Tiptap Editor --}}
                {{-- Note: In a real app, you would pass the existing content to this component --}}
                {{-- <x-tiptap-editor :content="$article['content']" /> --}}
                <x-tiptap-editor />
            </div>

            {{-- Right Column: Settings & Meta Components --}}
            <div class="flex flex-col gap-6 lg:sticky lg:top-6">
                {{-- Note: In a real app, you would pass the article data to prepopulate these widgets --}}
                {{-- <x-article.publish-widget :article="$article" /> --}}
                <x-article.publish-widget />
                <x-article.organization-widget />
                <x-article.featured-image-widget />
            </div>

        </div>

        {{-- Form Actions (Moved to Bottom) --}}
        <div class="mt-8 flex items-center justify-end gap-4 border-t border-border pt-6 pb-2">
            <button type="button" class="inline-flex items-center justify-center rounded-lg border border-border bg-card px-6 py-2.5 text-sm font-medium text-foreground shadow-sm transition-all hover:bg-muted active:scale-[0.98]">
                <i class="ph-bold ph-eye text-lg mr-2"></i>
                Preview
            </button>
            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-primary px-8 py-2.5 text-sm font-medium text-primary-foreground shadow-sm transition-all hover:bg-primary/90 active:scale-[0.98]">
                <i class="ph-bold ph-floppy-disk text-lg mr-2"></i>
                Update Article
            </button>
        </div>

    </form>
</div>
@endsection
