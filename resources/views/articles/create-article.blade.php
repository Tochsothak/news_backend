@extends('layouts.app')

@section('title', 'Create Article')
@section('breadcrumb', 'Articles / Create')

@push('styles')
    @vite(['resources/css/tiptap/tiptap.css'])
@endpush

@push('scripts')
    @vite(['resources/js/tiptap/tiptap.js'])
@endpush

@section('content')
<div class="p-4 sm:p-6" x-data="{
    title: '',
    slug: '',
    uniqueId: '',
    init() {
        this.uniqueId = Math.random().toString(36).substring(2, 7);
    },
    generateSlug() {
        let baseSlug = this.title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
        this.slug = baseSlug ? `${baseSlug}-${this.uniqueId}` : '';
    },
    resizeTitle(e) {
        e.target.style.height = 'auto';
        e.target.style.height = e.target.scrollHeight + 'px';
    }
}">
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Page Header (Clean, un-stickied) --}}
        <div class="mb-4 sm:mb-6 border-b border-border pb-5">
            <div>
                <h1 class="text-xl font-bold text-foreground sm:text-2xl">Create Article</h1>
                <p class="mt-1 text-sm text-muted-foreground">Draft and publish a new article for your portal.</p>
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
                <x-tiptap-editor />
            </div>

            {{-- Right Column: Settings & Meta Components --}}
            {{-- Adjusted to top-6 so it sticks neatly without the header in the way --}}
            <div class="flex flex-col gap-6 lg:sticky lg:top-6">
                <x-article.publish-widget />
                <x-article.organization-widget />
                <x-article.featured-image-widget />
            </div>

        </div>

        {{-- Form Actions (Moved to Bottom) --}}
        <div class="mt-8 flex items-center justify-end gap-4 border-t border-border pt-6 pb-2">
            <button type="button" class="inline-flex items-center justify-center rounded-lg border border-border bg-card px-6 py-2.5 text-sm font-medium text-foreground shadow-sm transition-all hover:bg-muted active:scale-[0.98]">
                Save as Draft
            </button>
            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-primary px-8 py-2.5 text-sm font-medium text-primary-foreground shadow-sm transition-all hover:bg-primary/90 active:scale-[0.98]">
                <i class="ph-bold ph-paper-plane-tilt text-lg mr-2"></i>
                Publish
            </button>
        </div>

    </form>
</div>
@endsection
