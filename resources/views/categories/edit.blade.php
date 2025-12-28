@extends('layouts.app')

@section('title', 'Edit Category')
@section('breadcrumb', 'Categories / Edit')

@section('content')
    <div x-data="{
        selectedIcon: 'cpu',
        selectedColor: '#6366f1',
        showColorPicker: false,
        categoryName: 'Technology',
        icons: [
            'newspaper', 'article', 'broadcast', 'television', 'radio', 'microphone', 'video-camera', 'camera', 'film-slate', 'music-notes',
            'cpu', 'desktop', 'device-mobile', 'robot', 'atom', 'flask', 'rocket', 'lightning', 'cloud', 'code',
            'chart-line-up', 'bank', 'currency-dollar', 'chart-pie', 'briefcase', 'buildings', 'handshake', 'shopping-cart', 'storefront', 'wallet',
            'soccer-ball', 'basketball', 'football', 'tennis-ball', 'barbell', 'bicycle', 'person-simple-run', 'trophy', 'medal', 'game-controller',
            'heart-pulse', 'first-aid-kit', 'pill', 'heartbeat', 'brain', 'apple-logo', 'leaf', 'sun', 'moon', 'eye',
            'graduation-cap', 'book-open', 'student', 'chalkboard-teacher', 'books', 'pen', 'palette', 'mask-happy', 'guitar', 'landmark',
            'globe', 'airplane', 'car', 'train', 'boat', 'map-pin', 'compass', 'mountains', 'beach', 'tent',
            'house', 'fork-knife', 'cooking-pot', 'wine', 'bed', 'bathtub', 'couch', 'plant', 'paw-print', 'baby',
            'chat-circle', 'envelope', 'phone', 'megaphone', 'bell', 'at', 'hash', 'link', 'share-network', 'users',
            'lock', 'shield-check', 'key', 'fingerprint', 'eye-slash', 'warning', 'bug', 'virus', 'scan', 'detective',
            'cloud-sun', 'cloud-rain', 'snowflake', 'wind', 'thermometer', 'drop', 'fire', 'rainbow', 'umbrella', 'waves',
            'gear', 'wrench', 'hammer', 'screwdriver', 'toolbox', 'plug', 'battery-full', 'cpu', 'hard-drive', 'printer',
            'file-text', 'folder', 'archive', 'clipboard-text', 'note', 'notebook', 'calendar-blank', 'list-checks', 'kanban', 'presentation-chart',
            'clock', 'calendar', 'hourglass', 'timer', 'alarm', 'calendar-check', 'calendar-plus', 'watch', 'stopwatch', 'infinity',
            'bag', 'basket', 'credit-card', 'receipt', 'barcode', 'qr-code', 'gift', 'percent', 'coins', 'piggy-bank',
            'confetti', 'party-popper', 'balloon', 'cake', 'champagne', 'ticket', 'mask-happy', 'smiley', 'alien', 'ghost',
            'arrow-up', 'arrows-clockwise', 'map-trifold', 'signpost', 'path', 'crosshair', 'gps', 'navigation-arrow', 'arrow-bend-up-right', 'shuffle',
            'play', 'pause', 'stop', 'fast-forward', 'rewind', 'skip-forward', 'skip-back', 'repeat', 'shuffle', 'playlist',
            'chart-bar', 'chart-line', 'database', 'table', 'graph', 'trend-up', 'trend-down', 'activity', 'pulse', 'chart-scatter',
            'flag', 'bookmark', 'lightbulb', 'crown', 'diamond', 'star', 'sparkle', 'magic-wand', 'hand-waving', 'peace'
        ]
    }">
        {{-- Page Header --}}
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                <a href="{{ url('/categories') }}" class="hover:text-foreground transition-colors">Categories</a>
                <i class="ph-bold ph-caret-right text-xs"></i>
                <span class="text-foreground">Edit</span>
            </div>
            <div class="mt-2 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold text-foreground sm:text-2xl">Edit Category</h1>
                    <p class="mt-1 text-sm text-muted-foreground">Update category information and settings.</p>
                </div>
                <a href="{{ url('/categories/1') }}" target="_blank"
                    class="inline-flex items-center gap-2 text-sm font-medium text-primary hover:underline">
                    <i class="ph-bold ph-eye"></i>
                    View on Site
                </a>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ url('/categories/' . ($category->id ?? 1)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">
                {{-- Main Content --}}
                <div class="space-y-4 sm:space-y-6 lg:col-span-2">
                    {{-- Basic Information --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10">
                                <i class="ph-bold ph-text-aa text-lg text-primary"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Basic Information</h3>
                                <p class="text-xs text-muted-foreground">Category name, URL and description</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            {{-- Category Name --}}
                            <div>
                                <label for="name" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-text-t text-muted-foreground"></i>
                                    Category Name <span class="text-destructive">*</span>
                                </label>
                                <input type="text" id="name" name="name" required
                                    x-model="categoryName"
                                    value="Technology"
                                    placeholder="e.g., Technology, Sports, Business"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                <p class="mt-1.5 flex items-center gap-1 text-xs text-muted-foreground">
                                    <i class="ph ph-info"></i>
                                    The name will be displayed on the frontend.
                                </p>
                            </div>

                            {{-- URL Slug --}}
                            <div>
                                <label for="slug" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-link text-muted-foreground"></i>
                                    URL Slug
                                </label>
                                <div class="flex items-stretch">
                                    <span class="inline-flex items-center rounded-l-xl border border-r-0 border-border bg-muted px-4 text-sm text-muted-foreground">
                                        /category/
                                    </span>
                                    <input type="text" id="slug" name="slug"
                                        value="technology"
                                        placeholder="auto-generated-from-name"
                                        class="flex-1 rounded-r-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                </div>
                                <p class="mt-1.5 flex items-center gap-1 text-xs text-muted-foreground">
                                    <i class="ph ph-magic-wand"></i>
                                    Leave empty to auto-generate from name.
                                </p>
                            </div>

                            {{-- Description --}}
                            <div>
                                <label for="description" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-align-left text-muted-foreground"></i>
                                    Description
                                </label>
                                <textarea id="description" name="description" rows="4"
                                    placeholder="Brief description of this category. This will be shown on the category page and used for SEO purposes..."
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none">Latest technology news, gadgets, software updates, and tech industry insights.</textarea>
                                <div class="mt-1.5 flex items-center justify-between text-xs text-muted-foreground">
                                    <span class="flex items-center gap-1">
                                        <i class="ph ph-note"></i>
                                        Optional. Used for SEO and category pages.
                                    </span>
                                    <span>85/500</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Appearance Section --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10">
                                <i class="ph-bold ph-palette text-lg text-accent"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Appearance</h3>
                                <p class="text-xs text-muted-foreground">Choose an icon and color for your category</p>
                            </div>
                        </div>

                        {{-- Live Preview --}}
                        <div class="mb-6 rounded-xl border border-border bg-muted/30 p-4">
                            <p class="mb-3 text-center text-xs font-medium uppercase tracking-wider text-muted-foreground">Preview</p>
                            <div class="flex items-center justify-center">
                                <div class="flex items-center gap-3 rounded-xl border border-border bg-card px-4 py-3 shadow-sm">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300"
                                        :style="'background-color: ' + selectedColor + '20'">
                                        <i class="text-2xl transition-all duration-300"
                                            :class="'ph-bold ph-' + selectedIcon"
                                            :style="'color: ' + selectedColor"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-foreground" x-text="categoryName || 'Category Name'"></p>
                                        <p class="text-xs text-muted-foreground">342 articles</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-5">
                            {{-- Icon Selection --}}
                            <div>
                                <label class="mb-2 flex items-center justify-between text-sm font-medium text-foreground">
                                    <span class="flex items-center gap-1">
                                        <i class="ph-bold ph-shapes text-muted-foreground"></i>
                                        Select Icon
                                    </span>
                                    <span class="text-xs text-muted-foreground">200 icons available</span>
                                </label>
                                <div class="max-h-80 overflow-y-auto rounded-xl border border-border bg-muted/30 p-3">
                                    <div class="flex flex-wrap gap-1.5">
                                        @php
                                            $icons = [
                                                'newspaper', 'article', 'broadcast', 'television', 'radio', 'microphone', 'video-camera', 'camera', 'film-slate', 'music-notes',
                                                'cpu', 'desktop', 'device-mobile', 'robot', 'atom', 'flask', 'rocket', 'lightning', 'cloud', 'code',
                                                'chart-line-up', 'bank', 'currency-dollar', 'chart-pie', 'briefcase', 'buildings', 'handshake', 'shopping-cart', 'storefront', 'wallet',
                                                'soccer-ball', 'basketball', 'football', 'tennis-ball', 'barbell', 'bicycle', 'person-simple-run', 'trophy', 'medal', 'game-controller',
                                                'heart-pulse', 'first-aid-kit', 'pill', 'heartbeat', 'brain', 'apple-logo', 'leaf', 'sun', 'moon', 'eye',
                                                'graduation-cap', 'book-open', 'student', 'chalkboard-teacher', 'books', 'pen', 'palette', 'mask-happy', 'guitar', 'landmark',
                                                'globe', 'airplane', 'car', 'train', 'boat', 'map-pin', 'compass', 'mountains', 'beach', 'tent',
                                                'house', 'fork-knife', 'cooking-pot', 'wine', 'bed', 'bathtub', 'couch', 'plant', 'paw-print', 'baby',
                                                'chat-circle', 'envelope', 'phone', 'megaphone', 'bell', 'share-network', 'users', 'user-circle', 'link', 'at',
                                                'lock', 'shield-check', 'key', 'fingerprint', 'password', 'detective', 'warning', 'prohibit', 'check-circle', 'x-circle',
                                                'cloud-sun', 'cloud-rain', 'cloud-lightning', 'snowflake', 'thermometer', 'wind', 'drop', 'fire', 'tree', 'recycle',
                                                'gear', 'wrench', 'hammer', 'screwdriver', 'paint-brush', 'scissors', 'ruler', 'magnet', 'plug', 'faders',
                                                'file-text', 'folder', 'archive', 'clipboard-text', 'note', 'notebook', 'file-pdf', 'file-image', 'file-video', 'file-audio',
                                                'clock', 'calendar', 'calendar-check', 'hourglass', 'timer', 'alarm', 'calendar-blank', 'clock-countdown', 'calendar-star', 'watch',
                                                'bag', 'basket', 'credit-card', 'receipt', 'tag', 'percent', 'gift', 'barcode', 'package', 'truck',
                                                'confetti', 'party-popper', 'balloon', 'cake', 'popcorn', 'ticket', 'magic-wand', 'star', 'heart', 'smiley',
                                                'arrow-up', 'arrow-down', 'arrow-left', 'arrow-right', 'arrows-clockwise', 'map-trifold', 'navigation-arrow', 'signpost', 'path', 'crosshair',
                                                'play', 'pause', 'stop', 'fast-forward', 'rewind', 'skip-forward', 'skip-back', 'shuffle', 'repeat', 'speaker-high',
                                                'chart-bar', 'chart-line', 'chart-donut', 'graph', 'trend-up', 'trend-down', 'database', 'table', 'funnel', 'pulse',
                                                'flag', 'bookmark', 'puzzle-piece', 'lightbulb', 'target', 'crown', 'diamond', 'coin', 'hand-coins', 'piggy-bank'
                                            ];
                                        @endphp
                                        @foreach($icons as $icon)
                                            <button type="button" @click="selectedIcon = '{{ $icon }}'"
                                                class="relative flex size-10 shrink-0 items-center justify-center rounded-lg border transition-all duration-200 hover:scale-105"
                                                :class="selectedIcon === '{{ $icon }}'
                                                    ? 'border-primary bg-primary/10 text-primary ring-2 ring-primary/20'
                                                    : 'border-border bg-card text-muted-foreground hover:border-primary/50 hover:text-foreground'">
                                                <i class="ph-bold ph-{{ $icon }} text-lg"></i>
                                                <span x-show="selectedIcon === '{{ $icon }}'"
                                                    class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] text-primary-foreground">
                                                    <i class="ph-bold ph-check"></i>
                                                </span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                                <input type="hidden" name="icon" :value="selectedIcon">
                            </div>

                            {{-- Icon Color --}}
                            <div>
                                <label class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-paint-brush text-muted-foreground"></i>
                                    Icon Color
                                </label>

                                {{-- Selected Color Display --}}
                                <div class="mb-3 flex items-center gap-3">
                                    <button type="button" @click="showColorPicker = !showColorPicker"
                                        class="relative flex h-14 w-14 items-center justify-center rounded-xl border-2 border-border transition-all duration-200 hover:scale-105 hover:border-primary/50"
                                        :style="'background-color: ' + selectedColor">
                                        <i class="ph-bold ph-eyedropper text-xl text-white drop-shadow-md"></i>
                                        <span class="absolute -bottom-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-card border border-border text-xs text-muted-foreground">
                                            <i class="ph-bold" :class="showColorPicker ? 'ph-caret-up' : 'ph-caret-down'"></i>
                                        </span>
                                    </button>
                                    <div>
                                        <p class="text-sm font-medium text-foreground">Selected Color</p>
                                        <div class="flex items-center gap-2">
                                            <input type="text" x-model="selectedColor"
                                                class="w-24 rounded-lg border border-border bg-background px-2 py-1 text-xs font-mono text-foreground uppercase focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary/20">
                                            <div class="h-6 w-6 rounded border border-border" :style="'background-color: ' + selectedColor"></div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Preset Colors Grid --}}
                                <div>
                                    <p class="mb-2 text-xs font-medium text-muted-foreground uppercase tracking-wider">Quick Select</p>
                                    <div class="flex flex-wrap gap-2 rounded-xl border border-border bg-muted/30 p-3">
                                        {{-- Row 1: Blues & Purples --}}
                                        <button type="button" @click="selectedColor = '#6366f1'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #6366f1"
                                            :class="selectedColor === '#6366f1' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#6366f1'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#8b5cf6'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #8b5cf6"
                                            :class="selectedColor === '#8b5cf6' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#8b5cf6'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#a855f7'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #a855f7"
                                            :class="selectedColor === '#a855f7' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#a855f7'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#d946ef'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #d946ef"
                                            :class="selectedColor === '#d946ef' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#d946ef'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#ec4899'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #ec4899"
                                            :class="selectedColor === '#ec4899' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#ec4899'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#f43f5e'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #f43f5e"
                                            :class="selectedColor === '#f43f5e' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#f43f5e'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>

                                        {{-- Row 2: Reds & Oranges --}}
                                        <button type="button" @click="selectedColor = '#ef4444'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #ef4444"
                                            :class="selectedColor === '#ef4444' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#ef4444'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#f97316'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #f97316"
                                            :class="selectedColor === '#f97316' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#f97316'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#f59e0b'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #f59e0b"
                                            :class="selectedColor === '#f59e0b' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#f59e0b'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#eab308'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #eab308"
                                            :class="selectedColor === '#eab308' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#eab308'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#84cc16'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #84cc16"
                                            :class="selectedColor === '#84cc16' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#84cc16'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#22c55e'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #22c55e"
                                            :class="selectedColor === '#22c55e' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#22c55e'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>

                                        {{-- Row 3: Greens & Teals --}}
                                        <button type="button" @click="selectedColor = '#10b981'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #10b981"
                                            :class="selectedColor === '#10b981' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#10b981'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#14b8a6'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #14b8a6"
                                            :class="selectedColor === '#14b8a6' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#14b8a6'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#06b6d4'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #06b6d4"
                                            :class="selectedColor === '#06b6d4' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#06b6d4'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#0ea5e9'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #0ea5e9"
                                            :class="selectedColor === '#0ea5e9' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#0ea5e9'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#3b82f6'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #3b82f6"
                                            :class="selectedColor === '#3b82f6' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#3b82f6'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#1d4ed8'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #1d4ed8"
                                            :class="selectedColor === '#1d4ed8' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#1d4ed8'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>

                                        {{-- Row 4: Neutrals & Darks --}}
                                        <button type="button" @click="selectedColor = '#64748b'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #64748b"
                                            :class="selectedColor === '#64748b' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#64748b'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#475569'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #475569"
                                            :class="selectedColor === '#475569' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#475569'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#334155'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #334155"
                                            :class="selectedColor === '#334155' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#334155'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#1e293b'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #1e293b"
                                            :class="selectedColor === '#1e293b' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#1e293b'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#0f172a'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #0f172a"
                                            :class="selectedColor === '#0f172a' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#0f172a'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                        <button type="button" @click="selectedColor = '#000000'"
                                            class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                            style="background-color: #000000"
                                            :class="selectedColor === '#000000' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                            <span x-show="selectedColor === '#000000'" class="absolute inset-0 flex items-center justify-center text-white">
                                                <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                {{-- Custom Color Picker --}}
                                <div x-show="showColorPicker" x-collapse class="mt-3">
                                    <div class="rounded-xl border border-border bg-muted/30 p-3">
                                        <div class="flex items-center gap-3">
                                            <i class="ph-bold ph-palette text-muted-foreground"></i>
                                            <span class="text-xs text-muted-foreground">Custom:</span>
                                            <input type="color" x-model="selectedColor"
                                                class="h-8 flex-1 cursor-pointer rounded-lg border-0 bg-transparent p-0">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="color" :value="selectedColor">
                            </div>
                        </div>
                    </div>

                    {{-- SEO Settings --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10">
                                <i class="ph-bold ph-magnifying-glass text-lg text-info"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">SEO Settings</h3>
                                <p class="text-xs text-muted-foreground">Optimize for search engines</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            {{-- Meta Title --}}
                            <div>
                                <label for="meta_title" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-text-h-one text-muted-foreground"></i>
                                    Meta Title
                                </label>
                                <input type="text" id="meta_title" name="meta_title"
                                    value="Technology News & Updates | Poipet Insider"
                                    placeholder="SEO title for this category"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                <div class="mt-1.5 flex items-center justify-between text-xs text-muted-foreground">
                                    <span class="flex items-center gap-1">
                                        <i class="ph ph-info"></i>
                                        Leave empty to use category name.
                                    </span>
                                    <span>47/60</span>
                                </div>
                            </div>

                            {{-- Meta Description --}}
                            <div>
                                <label for="meta_description" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-article text-muted-foreground"></i>
                                    Meta Description
                                </label>
                                <textarea id="meta_description" name="meta_description" rows="3"
                                    placeholder="SEO description for search engines. Recommended: 150-160 characters..."
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none">Stay updated with the latest technology news, gadget reviews, software updates, and tech industry insights from Poipet Insider.</textarea>
                                <div class="mt-1.5 flex items-center justify-between text-xs text-muted-foreground">
                                    <span class="flex items-center gap-1">
                                        <i class="ph ph-target"></i>
                                        Recommended: 150-160 characters.
                                    </span>
                                    <span class="text-success">142/160</span>
                                </div>
                            </div>

                            {{-- SEO Preview --}}
                            <div class="rounded-xl border border-border bg-background p-4">
                                <p class="mb-3 flex items-center gap-1 text-xs font-medium text-muted-foreground">
                                    <i class="ph-bold ph-google-logo"></i>
                                    Search Preview
                                </p>
                                <div class="space-y-1">
                                    <p class="text-base font-medium text-primary hover:underline cursor-pointer">Technology News & Updates | Poipet Insider</p>
                                    <p class="text-xs text-success">https://poipetinsider.com/category/technology</p>
                                    <p class="text-sm text-muted-foreground line-clamp-2">Stay updated with the latest technology news, gadget reviews, software updates, and tech industry insights from Poipet Insider.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sub-Categories (Edit page only) --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-warning/10">
                                    <i class="ph-bold ph-folder-open text-lg text-warning"></i>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-foreground sm:text-lg">Sub-Categories</h3>
                                    <p class="text-xs text-muted-foreground">8 sub-categories in this parent</p>
                                </div>
                            </div>
                            <a href="{{ url('/categories/create?parent=1') }}"
                                class="inline-flex items-center gap-1 rounded-lg bg-primary/10 px-3 py-1.5 text-xs font-medium text-primary transition-colors hover:bg-primary/20">
                                <i class="ph-bold ph-plus"></i>
                                Add New
                            </a>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between rounded-xl bg-muted/30 p-3 transition-colors hover:bg-muted/50">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10">
                                        <i class="ph-bold ph-device-mobile text-sm text-primary"></i>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-foreground">Mobile</span>
                                        <span class="ml-2 text-xs text-muted-foreground">45 articles</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1">
                                    <a href="{{ url('/categories/sub/1/edit') }}" class="rounded-lg p-1.5 text-muted-foreground hover:bg-muted hover:text-foreground">
                                        <i class="ph-bold ph-pencil-simple text-sm"></i>
                                    </a>
                                    <button type="button" class="rounded-lg p-1.5 text-muted-foreground hover:bg-destructive/10 hover:text-destructive">
                                        <i class="ph-bold ph-trash text-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between rounded-xl bg-muted/30 p-3 transition-colors hover:bg-muted/50">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent/10">
                                        <i class="ph-bold ph-desktop text-sm text-accent"></i>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-foreground">Computers</span>
                                        <span class="ml-2 text-xs text-muted-foreground">38 articles</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1">
                                    <a href="{{ url('/categories/sub/2/edit') }}" class="rounded-lg p-1.5 text-muted-foreground hover:bg-muted hover:text-foreground">
                                        <i class="ph-bold ph-pencil-simple text-sm"></i>
                                    </a>
                                    <button type="button" class="rounded-lg p-1.5 text-muted-foreground hover:bg-destructive/10 hover:text-destructive">
                                        <i class="ph-bold ph-trash text-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between rounded-xl bg-muted/30 p-3 transition-colors hover:bg-muted/50">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-info/10">
                                        <i class="ph-bold ph-cloud text-sm text-info"></i>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-foreground">Cloud</span>
                                        <span class="ml-2 text-xs text-muted-foreground">32 articles</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1">
                                    <a href="{{ url('/categories/sub/3/edit') }}" class="rounded-lg p-1.5 text-muted-foreground hover:bg-muted hover:text-foreground">
                                        <i class="ph-bold ph-pencil-simple text-sm"></i>
                                    </a>
                                    <button type="button" class="rounded-lg p-1.5 text-muted-foreground hover:bg-destructive/10 hover:text-destructive">
                                        <i class="ph-bold ph-trash text-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between rounded-xl bg-muted/30 p-3 transition-colors hover:bg-muted/50">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-success/10">
                                        <i class="ph-bold ph-robot text-sm text-success"></i>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-foreground">AI & ML</span>
                                        <span class="ml-2 text-xs text-muted-foreground">28 articles</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1">
                                    <a href="{{ url('/categories/sub/4/edit') }}" class="rounded-lg p-1.5 text-muted-foreground hover:bg-muted hover:text-foreground">
                                        <i class="ph-bold ph-pencil-simple text-sm"></i>
                                    </a>
                                    <button type="button" class="rounded-lg p-1.5 text-muted-foreground hover:bg-destructive/10 hover:text-destructive">
                                        <i class="ph-bold ph-trash text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <a href="{{ url('/categories/sub-categories?parent=1') }}"
                            class="mt-4 flex items-center justify-center gap-1 text-xs font-medium text-primary hover:underline">
                            View all 8 sub-categories
                            <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-4 sm:space-y-6 lg:sticky lg:top-4 lg:self-start">
                    {{-- Publish Settings --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-success/10">
                                <i class="ph-bold ph-paper-plane-tilt text-lg text-success"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Publish</h3>
                                <p class="text-xs text-muted-foreground">Configure visibility</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            {{-- Status --}}
                            <div>
                                <label for="status" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-toggle-left text-muted-foreground"></i>
                                    Status
                                </label>
                                <select id="status" name="status"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                    <option value="active" selected>✅ Active</option>
                                    <option value="inactive">⏸️ Inactive</option>
                                </select>
                            </div>

                            {{-- Parent Category --}}
                            <div>
                                <label for="parent_id" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-git-branch text-muted-foreground"></i>
                                    Parent Category
                                </label>
                                <select id="parent_id" name="parent_id"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                    <option value="" selected>📁 None (Top Level)</option>
                                    <option value="2">Sports</option>
                                    <option value="3">Business</option>
                                    <option value="4">Entertainment</option>
                                    <option value="5">World News</option>
                                </select>
                                <p class="mt-1.5 flex items-center gap-1 text-xs text-muted-foreground">
                                    <i class="ph ph-info"></i>
                                    Select to make this a sub-category.
                                </p>
                            </div>

                            {{-- Display Order --}}
                            <div>
                                <label for="order" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-sort-ascending text-muted-foreground"></i>
                                    Display Order
                                </label>
                                <input type="number" id="order" name="order" value="1" min="0"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                <p class="mt-1.5 flex items-center gap-1 text-xs text-muted-foreground">
                                    <i class="ph ph-arrow-up"></i>
                                    Lower number = higher priority.
                                </p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-6 flex flex-col gap-2">
                            <button type="submit"
                                class="group w-full rounded-xl bg-primary px-4 py-3 text-sm font-medium text-primary-foreground transition-all duration-200 hover:bg-primary/90 hover:shadow-lg hover:shadow-primary/25 active:scale-[0.98]">
                                <i class="ph-bold ph-check mr-2 transition-transform group-hover:scale-110"></i>
                                Update Category
                            </button>
                            <a href="{{ url('/categories') }}"
                                class="group w-full rounded-xl border border-border bg-card px-4 py-3 text-center text-sm font-medium text-foreground transition-all duration-200 hover:bg-muted active:scale-[0.98]">
                                <i class="ph-bold ph-x mr-2"></i>
                                Cancel
                            </a>
                        </div>
                    </div>

                    {{-- Category Stats --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10">
                                <i class="ph-bold ph-chart-bar text-lg text-info"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Statistics</h3>
                                <p class="text-xs text-muted-foreground">Category performance</p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <i class="ph-bold ph-article text-primary"></i>
                                    Total Articles
                                </span>
                                <span class="text-sm font-bold text-foreground">342</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <i class="ph-bold ph-folder-open text-accent"></i>
                                    Sub-Categories
                                </span>
                                <span class="text-sm font-bold text-foreground">8</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <i class="ph-bold ph-eye text-info"></i>
                                    Total Views
                                </span>
                                <span class="text-sm font-bold text-foreground">45.2K</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <i class="ph-bold ph-calendar-plus text-success"></i>
                                    Created
                                </span>
                                <span class="text-sm font-bold text-foreground">Jan 15, 2025</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <i class="ph-bold ph-clock-clockwise text-warning"></i>
                                    Last Updated
                                </span>
                                <span class="text-sm font-bold text-foreground">Dec 20, 2025</span>
                            </div>
                        </div>
                    </div>

                    {{-- Featured Image --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10">
                                <i class="ph-bold ph-image text-lg text-accent"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Featured Image</h3>
                                <p class="text-xs text-muted-foreground">Category cover image</p>
                            </div>
                        </div>

                        {{-- Current Image Preview --}}
                        <div class="mb-4 overflow-hidden rounded-xl border border-border">
                            <img src="https://placehold.co/400x200/6366f1/FFFFFF?text=Technology"
                                alt="Technology Category"
                                class="h-32 w-full object-cover transition-transform duration-300 hover:scale-105">
                        </div>

                        <label class="group flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-border p-4 transition-all duration-200 hover:border-primary/50 hover:bg-muted/30">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-muted transition-transform duration-200 group-hover:scale-110">
                                <i class="ph-bold ph-swap text-xl text-muted-foreground group-hover:text-primary"></i>
                            </div>
                            <p class="mt-2 text-sm font-medium text-foreground">Replace Image</p>
                            <p class="mt-1 text-xs text-muted-foreground">or drag and drop</p>
                            <span class="mt-2 rounded-full bg-muted px-3 py-1 text-xs text-muted-foreground">
                                PNG, JPG up to 2MB
                            </span>
                            <input type="file" name="featured_image" class="hidden" accept="image/*">
                        </label>
                    </div>

                    {{-- Danger Zone --}}
                    <div class="rounded-xl border border-destructive/30 bg-destructive/5 p-4 sm:p-6">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-destructive/10">
                                <i class="ph-bold ph-warning text-lg text-destructive"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-destructive sm:text-lg">Danger Zone</h3>
                                <p class="text-xs text-muted-foreground">Irreversible actions</p>
                            </div>
                        </div>

                        <p class="mb-4 text-xs text-muted-foreground">
                            Deleting this category will move all <strong class="text-foreground">342 articles</strong> to "Uncategorized".
                            All <strong class="text-foreground">8 sub-categories</strong> will also be deleted. This action cannot be undone.
                        </p>

                        <button type="button"
                            class="group w-full rounded-xl border border-destructive bg-transparent px-4 py-3 text-sm font-medium text-destructive transition-all duration-200 hover:bg-destructive hover:text-destructive-foreground active:scale-[0.98]">
                            <i class="ph-bold ph-trash mr-2 transition-transform group-hover:scale-110"></i>
                            Delete Category
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
