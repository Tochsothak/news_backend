@extends('layouts.app')

@section('title', 'All Articles')
@section('breadcrumb', 'Articles')

@section('content')
    @php
        // Dummy Data updated to match the new UI needs
        $dummyArticles = [
            [
                'id' => 1,
                'title' => 'The Future of Web Development in 2026',
                'slug' => 'future-of-web-development-2026',
                'category' => 'Technology',
                'author' => 'Haru Malik',
                'status' => 'Published',
                'views' => '12.5k',
                'shares' => '3.2k',
                'date' => 'Oct 24, 2026',
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 2,
                'title' => 'Breaking: Major Market Shifts Expected Next Quarter',
                'slug' => 'major-market-shifts',
                'category' => 'Finance',
                'author' => 'Jane Doe',
                'status' => 'Draft',
                'views' => '0',
                'shares' => '0',
                'date' => 'Oct 25, 2026',
                'image' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=150&h=100&q=80'
            ],
            [
                'id' => 3,
                'title' => 'Top 10 Hidden Gems in Southeast Asia',
                'slug' => 'top-10-hidden-gems-sea',
                'category' => 'Travel',
                'author' => 'Alex Smith',
                'status' => 'Scheduled',
                'views' => '0',
                'shares' => '0',
                'date' => 'Oct 28, 2026',
                'image' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?auto=format&fit=crop&w=150&h=100&q=80'
            ],
        ];
    @endphp

    <div x-data="{
        selectAll: false,
        selected: []
    }">
        {{-- Page Header --}}
        <div class="mb-4 flex flex-col gap-4 sm:mb-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-foreground sm:text-2xl">All Articles</h1>
                <p class="mt-1 text-sm text-muted-foreground">Manage, draft, and publish your news articles.</p>
            </div>
            <div class="flex items-center gap-2">
                <button
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-export"></i>
                    <span class="hidden sm:inline">Export</span>
                </button>
                <a href="{{ route('articles.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90">
                    <i class="ph-bold ph-plus"></i>
                    <span>Create Article</span>
                </a>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="mb-4 grid grid-cols-2 gap-3 sm:mb-6 sm:gap-4 lg:grid-cols-4">
            {{-- Total Articles --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Total Articles</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">1,234</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-article text-lg text-primary sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Published --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Published</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">982</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-success/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-check-circle text-lg text-success sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Drafts --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Drafts</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">145</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-file-dashed text-lg text-accent sm:text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Scheduled --}}
            <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-muted-foreground sm:text-sm">Scheduled</p>
                        <p class="mt-1 text-lg font-bold text-foreground sm:text-2xl">24</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10 sm:h-12 sm:w-12">
                        <i class="ph-bold ph-calendar-blank text-lg text-info sm:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters & Search --}}
        <div class="mb-4 flex flex-col gap-3 sm:mb-6 lg:flex-row lg:items-center lg:justify-between">
            {{-- Search & Bulk Actions --}}
            <div class="flex items-center gap-2 w-full lg:max-w-md">
                {{-- Bulk Select Checkbox --}}
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-border bg-card">
                    <input type="checkbox" x-model="selectAll" @change="selected = selectAll ? [{{ implode(',', array_column($dummyArticles, 'id')) }}] : []"
                           class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background cursor-pointer">
                </div>

                <div class="relative flex-1">
                    <i class="ph-bold ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
                    <input type="text" placeholder="Search articles..."
                        class="w-full rounded-xl border border-border bg-card py-2.5 pl-10 pr-4 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
            </div>

            {{-- Filters --}}
            <div class="flex flex-wrap items-center gap-2">
                <select class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="">All Categories</option>
                    <option value="technology">Technology</option>
                    <option value="finance">Finance</option>
                    <option value="travel">Travel</option>
                </select>
                <select class="rounded-xl border border-border bg-card px-3 py-2.5 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="">All Statuses</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="scheduled">Scheduled</option>
                </select>
                <button x-show="selected.length > 0" x-cloak x-transition
                    class="inline-flex items-center gap-2 rounded-xl border border-destructive/20 bg-destructive/10 text-destructive px-3 py-2.5 text-sm font-medium transition-colors hover:bg-destructive hover:text-destructive-foreground">
                    <i class="ph-bold ph-trash"></i>
                    <span class="hidden sm:inline">Delete Selected</span>
                </button>
            </div>
        </div>

        {{-- Articles List (Card Based) --}}
        <div class="space-y-3">
            @foreach($dummyArticles as $article)
                <div class="rounded-xl border border-border bg-card overflow-hidden shadow-sm transition-all hover:shadow-md hover:border-primary/30">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between p-4 sm:p-5 gap-4">

                        {{-- Left Side: Checkbox, Image & Main Info --}}
                        <div class="flex items-start sm:items-center gap-3 sm:gap-4 flex-1 min-w-0">
                            {{-- Checkbox --}}
                            <div class="pt-1 sm:pt-0 shrink-0">
                                <input type="checkbox" value="{{ $article['id'] }}" x-model="selected" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background cursor-pointer">
                            </div>

                            {{-- Thumbnail --}}
                            <img src="{{ $article['image'] }}" alt="Thumbnail" class="h-16 w-24 sm:h-20 sm:w-32 rounded-lg object-cover border border-border shrink-0">

                            {{-- Article Info --}}
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('articles.edit', $article['id']) }}" class="font-semibold text-foreground text-base hover:text-primary transition-colors line-clamp-2 mb-1 sm:mb-1.5">
                                    {{ $article['title'] }}
                                </a>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-muted-foreground">
                                    <span class="inline-flex items-center gap-1 font-medium text-foreground">
                                        <i class="ph-bold ph-folder text-muted-foreground"></i>
                                        {{ $article['category'] }}
                                    </span>
                                    <span class="hidden sm:inline text-border">•</span>
                                    <span class="inline-flex items-center gap-1">
                                        <i class="ph-bold ph-user"></i>
                                        {{ $article['author'] }}
                                    </span>
                                    <span class="hidden sm:inline text-border">•</span>
                                    <span class="inline-flex items-center gap-1">
                                        <i class="ph-bold ph-calendar-blank"></i>
                                        {{ $article['date'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Right Side: Stats, Status & Actions --}}
                        <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto mt-2 lg:mt-0 pt-4 lg:pt-0 border-t border-border lg:border-0">

                            {{-- Engagement Stats --}}
                            <div class="flex items-center gap-4 mr-2">
                                <div class="flex flex-col items-center sm:items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-eye"></i> Views</span>
                                    <span class="text-sm font-semibold text-foreground">{{ $article['views'] }}</span>
                                </div>
                                <div class="hidden sm:block h-8 w-px bg-border"></div>
                                <div class="hidden sm:flex flex-col items-end">
                                    <span class="text-xs text-muted-foreground flex items-center gap-1"><i class="ph-bold ph-chats-circle"></i> Comment</span>
                                    <span class="text-sm font-semibold text-foreground">{{ $article['shares'] }}</span>
                                </div>
                            </div>

                            {{-- Status Badge --}}
                            <div class="w-24 flex justify-end shrink-0">
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
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-info/10 px-2 py-0.5 text-xs font-medium text-info">
                                        <span class="h-1.5 w-1.5 rounded-full bg-info"></span>
                                        Scheduled
                                    </span>
                                @endif
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-1 shrink-0">
                                <a href="#" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-success/10 hover:text-success" title="View Live">
                                    <i class="ph-bold ph-arrow-square-out"></i>
                                </a>
                                <a href="{{ route('articles.edit', $article['id']) }}" class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground" title="Edit">
                                    <i class="ph-bold ph-pencil-simple"></i>
                                </a>
                                <button class="rounded-lg p-2 text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive" title="Delete">
                                    <i class="ph-bold ph-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-4 flex items-center justify-between rounded-xl border border-border bg-card px-4 py-3 sm:mt-6 sm:px-6 shadow-sm">
            <p class="text-xs text-muted-foreground sm:text-sm">
                Showing <span class="font-medium text-foreground">1</span> to <span class="font-medium text-foreground">3</span> of <span class="font-medium text-foreground">1,234</span> articles
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
