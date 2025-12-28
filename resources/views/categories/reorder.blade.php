@extends('layouts.app')

@section('title', 'Reorder Categories')
@section('breadcrumb', 'Categories / Reorder')

@section('content')
    <div x-data="{
        hasChanges: false,
        saving: false,
        markChanged() { this.hasChanges = true },
        async saveOrder() {
            this.saving = true;
            // Simulate API call
            await new Promise(resolve => setTimeout(resolve, 1500));
            this.saving = false;
            this.hasChanges = false;
        }
    }">
        {{-- Page Header --}}
        <div class="mb-4 flex flex-col gap-4 sm:mb-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-muted-foreground">
                    <a href="{{ url('/categories') }}" class="hover:text-foreground">Categories</a>
                    <i class="ph-bold ph-caret-right text-xs"></i>
                    <span class="text-foreground">Reorder</span>
                </div>
                <h1 class="mt-2 text-xl font-bold text-foreground sm:text-2xl">Reorder Categories</h1>
                <p class="mt-1 text-sm text-muted-foreground">Drag and drop to reorder categories and sub-categories.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ url('/categories') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                    <i class="ph-bold ph-x"></i>
                    <span>Cancel</span>
                </a>
                <button @click="saveOrder()" :disabled="!hasChanges || saving"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-50">
                    <i class="ph-bold" :class="saving ? 'ph-spinner animate-spin' : 'ph-floppy-disk'"></i>
                    <span x-text="saving ? 'Saving...' : 'Save Order'"></span>
                </button>
            </div>
        </div>

        {{-- Unsaved Changes Warning --}}
        <div x-show="hasChanges" x-transition
            class="mb-4 flex items-center gap-3 rounded-lg border border-warning/30 bg-warning/5 p-4 sm:mb-6">
            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-warning/10">
                <i class="ph-bold ph-warning text-lg text-warning"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-foreground">You have unsaved changes</p>
                <p class="text-xs text-muted-foreground">Don't forget to save your new category order.</p>
            </div>
        </div>

        {{-- Instructions --}}
        <div class="mb-4 rounded-lg border border-border bg-card p-4 sm:mb-6">
            <div class="flex items-start gap-3">
                <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-info/10">
                    <i class="ph-bold ph-info text-sm text-info"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-foreground">How to Reorder</p>
                    <ul class="mt-1 space-y-1 text-xs text-muted-foreground">
                        <li class="flex items-center gap-1">
                            <i class="ph-bold ph-dots-six-vertical text-muted-foreground"></i>
                            Drag the handle to move categories up or down
                        </li>
                        <li class="flex items-center gap-1">
                            <i class="ph-bold ph-arrows-out-cardinal text-muted-foreground"></i>
                            Drop a category onto another to make it a sub-category
                        </li>
                        <li class="flex items-center gap-1">
                            <i class="ph-bold ph-floppy-disk text-muted-foreground"></i>
                            Click "Save Order" to apply changes
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">
            {{-- Reorder List --}}
            <div class="lg:col-span-2">
                <div class="rounded-lg border border-border bg-card">
                    <div class="border-b border-border p-4 sm:p-6">
                        <h3 class="text-base font-semibold text-foreground sm:text-lg">Categories Order</h3>
                        <p class="mt-1 text-xs text-muted-foreground">Categories are displayed in this order on the frontend.</p>
                    </div>

                    {{-- Sortable Categories List --}}
                    <div class="divide-y divide-border" id="sortable-categories">
                        {{-- Category 1: Technology --}}
                        <div class="group" @mousedown="markChanged()">
                            {{-- Parent Category --}}
                            <div class="flex items-center gap-3 p-4 transition-colors hover:bg-muted/50">
                                <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing"
                                    title="Drag to reorder">
                                    <i class="ph-bold ph-dots-six-vertical text-lg"></i>
                                </button>
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                    <i class="ph-bold ph-cpu text-lg text-primary"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-foreground">Technology</p>
                                    <p class="text-xs text-muted-foreground">8 sub-categories • 342 articles</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="rounded-full bg-primary/10 px-2 py-0.5 text-xs font-medium text-primary">#1</span>
                                    <button class="rounded-lg p-2 text-muted-foreground opacity-0 transition-all hover:bg-muted hover:text-foreground group-hover:opacity-100"
                                        title="Expand sub-categories">
                                        <i class="ph-bold ph-caret-down"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Sub-Categories (Nested Sortable) --}}
                            <div class="divide-y divide-border border-t border-border bg-muted/20 pl-8">
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-device-mobile text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Mobile</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#1.1</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-desktop text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Computers</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#1.2</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-cloud text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Cloud</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#1.3</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-robot text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">AI & ML</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#1.4</span>
                                </div>
                            </div>
                        </div>

                        {{-- Category 2: Sports --}}
                        <div class="group" @mousedown="markChanged()">
                            <div class="flex items-center gap-3 p-4 transition-colors hover:bg-muted/50">
                                <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing"
                                    title="Drag to reorder">
                                    <i class="ph-bold ph-dots-six-vertical text-lg"></i>
                                </button>
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-accent/10">
                                    <i class="ph-bold ph-soccer-ball text-lg text-accent"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-foreground">Sports</p>
                                    <p class="text-xs text-muted-foreground">6 sub-categories • 287 articles</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="rounded-full bg-accent/10 px-2 py-0.5 text-xs font-medium text-accent">#2</span>
                                    <button class="rounded-lg p-2 text-muted-foreground opacity-0 transition-all hover:bg-muted hover:text-foreground group-hover:opacity-100"
                                        title="Expand sub-categories">
                                        <i class="ph-bold ph-caret-down"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Sub-Categories --}}
                            <div class="divide-y divide-border border-t border-border bg-muted/20 pl-8">
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-soccer-ball text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Football</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#2.1</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-basketball text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Basketball</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#2.2</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-tennis-ball text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Tennis</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#2.3</span>
                                </div>
                            </div>
                        </div>

                        {{-- Category 3: Business --}}
                        <div class="group" @mousedown="markChanged()">
                            <div class="flex items-center gap-3 p-4 transition-colors hover:bg-muted/50">
                                <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing"
                                    title="Drag to reorder">
                                    <i class="ph-bold ph-dots-six-vertical text-lg"></i>
                                </button>
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-info/10">
                                    <i class="ph-bold ph-chart-line-up text-lg text-info"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-foreground">Business</p>
                                    <p class="text-xs text-muted-foreground">5 sub-categories • 234 articles</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="rounded-full bg-info/10 px-2 py-0.5 text-xs font-medium text-info">#3</span>
                                    <button class="rounded-lg p-2 text-muted-foreground opacity-0 transition-all hover:bg-muted hover:text-foreground group-hover:opacity-100"
                                        title="Expand sub-categories">
                                        <i class="ph-bold ph-caret-down"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Sub-Categories --}}
                            <div class="divide-y divide-border border-t border-border bg-muted/20 pl-8">
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-currency-dollar text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Finance</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#3.1</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-rocket-launch text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Startups</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#3.2</span>
                                </div>
                            </div>
                        </div>

                        {{-- Category 4: Entertainment --}}
                        <div class="group" @mousedown="markChanged()">
                            <div class="flex items-center gap-3 p-4 transition-colors hover:bg-muted/50">
                                <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing"
                                    title="Drag to reorder">
                                    <i class="ph-bold ph-dots-six-vertical text-lg"></i>
                                </button>
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-destructive/10">
                                    <i class="ph-bold ph-film-slate text-lg text-destructive"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-foreground">Entertainment</p>
                                    <p class="text-xs text-muted-foreground">7 sub-categories • 198 articles</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="rounded-full bg-destructive/10 px-2 py-0.5 text-xs font-medium text-destructive">#4</span>
                                    <button class="rounded-lg p-2 text-muted-foreground opacity-0 transition-all hover:bg-muted hover:text-foreground group-hover:opacity-100"
                                        title="Expand sub-categories">
                                        <i class="ph-bold ph-caret-down"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Sub-Categories --}}
                            <div class="divide-y divide-border border-t border-border bg-muted/20 pl-8">
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-film-strip text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Movies</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#4.1</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-music-notes text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Music</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#4.2</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 transition-colors hover:bg-muted/50">
                                    <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing">
                                        <i class="ph-bold ph-dots-six-vertical"></i>
                                    </button>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-muted">
                                        <i class="ph-bold ph-star text-sm text-muted-foreground"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-foreground">Celebrity</p>
                                    </div>
                                    <span class="text-xs text-muted-foreground">#4.3</span>
                                </div>
                            </div>
                        </div>

                        {{-- Category 5: World News --}}
                        <div class="group" @mousedown="markChanged()">
                            <div class="flex items-center gap-3 p-4 transition-colors hover:bg-muted/50">
                                <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing"
                                    title="Drag to reorder">
                                    <i class="ph-bold ph-dots-six-vertical text-lg"></i>
                                </button>
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success/10">
                                    <i class="ph-bold ph-globe text-lg text-success"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-foreground">World News</p>
                                    <p class="text-xs text-muted-foreground">4 sub-categories • 173 articles</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">#5</span>
                                    <button class="rounded-lg p-2 text-muted-foreground opacity-0 transition-all hover:bg-muted hover:text-foreground group-hover:opacity-100"
                                        title="Expand sub-categories">
                                        <i class="ph-bold ph-caret-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Category 6: Health (Inactive) --}}
                        <div class="group opacity-60" @mousedown="markChanged()">
                            <div class="flex items-center gap-3 p-4 transition-colors hover:bg-muted/50">
                                <button class="cursor-grab text-muted-foreground hover:text-foreground active:cursor-grabbing"
                                    title="Drag to reorder">
                                    <i class="ph-bold ph-dots-six-vertical text-lg"></i>
                                </button>
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-muted">
                                    <i class="ph-bold ph-heart-pulse text-lg text-muted-foreground"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-foreground">Health</p>
                                    <p class="text-xs text-muted-foreground">3 sub-categories • 89 articles</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="rounded-full bg-muted px-2 py-0.5 text-xs font-medium text-muted-foreground">#6</span>
                                    <span class="rounded-full bg-muted px-2 py-0.5 text-xs font-medium text-muted-foreground">Inactive</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-4 sm:space-y-6">
                {{-- Quick Actions --}}
                <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                    <h3 class="mb-4 text-base font-semibold text-foreground sm:text-lg">Quick Actions</h3>

                    <div class="space-y-2">
                        <button @click="markChanged()"
                            class="flex w-full items-center gap-3 rounded-lg border border-border p-3 text-left transition-colors hover:bg-muted">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10">
                                <i class="ph-bold ph-sort-ascending text-sm text-primary"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Sort A-Z</p>
                                <p class="text-xs text-muted-foreground">Alphabetical order</p>
                            </div>
                        </button>
                        <button @click="markChanged()"
                            class="flex w-full items-center gap-3 rounded-lg border border-border p-3 text-left transition-colors hover:bg-muted">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent/10">
                                <i class="ph-bold ph-sort-descending text-sm text-accent"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Sort Z-A</p>
                                <p class="text-xs text-muted-foreground">Reverse alphabetical</p>
                            </div>
                        </button>
                        <button @click="markChanged()"
                            class="flex w-full items-center gap-3 rounded-lg border border-border p-3 text-left transition-colors hover:bg-muted">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-info/10">
                                <i class="ph-bold ph-chart-bar text-sm text-info"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Sort by Articles</p>
                                <p class="text-xs text-muted-foreground">Most articles first</p>
                            </div>
                        </button>
                        <button @click="markChanged()"
                            class="flex w-full items-center gap-3 rounded-lg border border-border p-3 text-left transition-colors hover:bg-muted">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-warning/10">
                                <i class="ph-bold ph-arrow-counter-clockwise text-sm text-warning"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Reset Order</p>
                                <p class="text-xs text-muted-foreground">Restore default order</p>
                            </div>
                        </button>
                    </div>
                </div>

                {{-- Preview --}}
                <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                    <h3 class="mb-4 text-base font-semibold text-foreground sm:text-lg">Frontend Preview</h3>
                    <p class="mb-4 text-xs text-muted-foreground">How categories appear in navigation:</p>

                    {{-- Mini Navigation Preview --}}
                    <div class="rounded-lg border border-border bg-muted/30 p-3">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2 rounded px-2 py-1.5 text-xs font-medium text-foreground">
                                <i class="ph-bold ph-cpu text-primary"></i>
                                Technology
                            </div>
                            <div class="flex items-center gap-2 rounded px-2 py-1.5 text-xs font-medium text-foreground">
                                <i class="ph-bold ph-soccer-ball text-accent"></i>
                                Sports
                            </div>
                            <div class="flex items-center gap-2 rounded px-2 py-1.5 text-xs font-medium text-foreground">
                                <i class="ph-bold ph-chart-line-up text-info"></i>
                                Business
                            </div>
                            <div class="flex items-center gap-2 rounded px-2 py-1.5 text-xs font-medium text-foreground">
                                <i class="ph-bold ph-film-slate text-destructive"></i>
                                Entertainment
                            </div>
                            <div class="flex items-center gap-2 rounded px-2 py-1.5 text-xs font-medium text-foreground">
                                <i class="ph-bold ph-globe text-success"></i>
                                World News
                            </div>
                        </div>
                    </div>

                    <a href="#" target="_blank"
                        class="mt-4 flex items-center justify-center gap-1 text-xs font-medium text-primary hover:underline">
                        <i class="ph-bold ph-arrow-square-out"></i>
                        View Live Site
                    </a>
                </div>

                {{-- Statistics --}}
                <div class="rounded-lg border border-border bg-card p-4 sm:p-6">
                    <h3 class="mb-4 text-base font-semibold text-foreground sm:text-lg">Statistics</h3>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-muted-foreground">Total Categories</span>
                            <span class="text-sm font-semibold text-foreground">12</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-muted-foreground">Sub-Categories</span>
                            <span class="text-sm font-semibold text-foreground">34</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-muted-foreground">Active</span>
                            <span class="text-sm font-semibold text-success">10</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-muted-foreground">Inactive</span>
                            <span class="text-sm font-semibold text-muted-foreground">2</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-muted-foreground">Last Reordered</span>
                            <span class="text-sm font-semibold text-foreground">Dec 15, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
