@extends('layouts.app')

@section('title', 'Create Category')
@section('breadcrumb', 'Categories / Create')

@section('content')
    <div x-data="{
        selectedIcon: 'cpu',
        selectedColor: '#6366f1',
        showColorPicker: false,
        icons: [
            // Row 1 - News & Media
            { name: 'newspaper', label: 'News' },
            { name: 'article', label: 'Article' },
            { name: 'broadcast', label: 'Broadcast' },
            { name: 'television', label: 'Television' },
            { name: 'radio', label: 'Radio' },
            { name: 'microphone', label: 'Microphone' },
            { name: 'video-camera', label: 'Video' },
            { name: 'camera', label: 'Photography' },
            { name: 'film-slate', label: 'Entertainment' },
            { name: 'music-notes', label: 'Music' },
            // Row 2 - Technology & Science
            { name: 'cpu', label: 'Technology' },
            { name: 'desktop', label: 'Computer' },
            { name: 'device-mobile', label: 'Mobile' },
            { name: 'robot', label: 'AI/Robot' },
            { name: 'atom', label: 'Science' },
            { name: 'flask', label: 'Research' },
            { name: 'rocket', label: 'Space' },
            { name: 'lightning', label: 'Energy' },
            { name: 'cloud', label: 'Cloud' },
            { name: 'code', label: 'Code' },
            // Row 3 - Business & Finance
            { name: 'chart-line-up', label: 'Business' },
            { name: 'bank', label: 'Finance' },
            { name: 'currency-dollar', label: 'Money' },
            { name: 'chart-pie', label: 'Analytics' },
            { name: 'briefcase', label: 'Work' },
            { name: 'buildings', label: 'Corporate' },
            { name: 'handshake', label: 'Partnership' },
            { name: 'shopping-cart', label: 'Shopping' },
            { name: 'storefront', label: 'Store' },
            { name: 'wallet', label: 'Wallet' },
            // Row 4 - Sports & Lifestyle
            { name: 'soccer-ball', label: 'Soccer' },
            { name: 'basketball', label: 'Basketball' },
            { name: 'football', label: 'Football' },
            { name: 'tennis-ball', label: 'Tennis' },
            { name: 'barbell', label: 'Fitness' },
            { name: 'bicycle', label: 'Cycling' },
            { name: 'person-simple-run', label: 'Running' },
            { name: 'trophy', label: 'Sports' },
            { name: 'medal', label: 'Achievement' },
            { name: 'game-controller', label: 'Gaming' },
            // Row 5 - Health & Wellness
            { name: 'heart-pulse', label: 'Health' },
            { name: 'first-aid-kit', label: 'Medical' },
            { name: 'pill', label: 'Medicine' },
            { name: 'heartbeat', label: 'Cardio' },
            { name: 'brain', label: 'Mental' },
            { name: 'apple-logo', label: 'Nutrition' },
            { name: 'leaf', label: 'Organic' },
            { name: 'sun', label: 'Wellness' },
            { name: 'moon', label: 'Sleep' },
            { name: 'eye', label: 'Vision' },
            // Row 6 - Education & Culture
            { name: 'graduation-cap', label: 'Education' },
            { name: 'book-open', label: 'Books' },
            { name: 'student', label: 'Student' },
            { name: 'chalkboard-teacher', label: 'Teaching' },
            { name: 'books', label: 'Library' },
            { name: 'pen', label: 'Writing' },
            { name: 'palette', label: 'Art' },
            { name: 'mask-happy', label: 'Theater' },
            { name: 'guitar', label: 'Music' },
            { name: 'landmark', label: 'Culture' },
            // Row 7 - Travel & Places
            { name: 'globe', label: 'World' },
            { name: 'airplane', label: 'Travel' },
            { name: 'car', label: 'Automotive' },
            { name: 'train', label: 'Train' },
            { name: 'boat', label: 'Maritime' },
            { name: 'map-pin', label: 'Location' },
            { name: 'compass', label: 'Explore' },
            { name: 'mountains', label: 'Nature' },
            { name: 'beach', label: 'Beach' },
            { name: 'tent', label: 'Camping' },
            // Row 8 - Home & Living
            { name: 'house', label: 'Home' },
            { name: 'fork-knife', label: 'Food' },
            { name: 'cooking-pot', label: 'Cooking' },
            { name: 'wine', label: 'Drinks' },
            { name: 'bed', label: 'Bedroom' },
            { name: 'bathtub', label: 'Bathroom' },
            { name: 'couch', label: 'Living' },
            { name: 'plant', label: 'Plants' },
            { name: 'paw-print', label: 'Pets' },
            { name: 'baby', label: 'Family' },
            // Row 9 - Communication & Social
            { name: 'chat-circle', label: 'Chat' },
            { name: 'envelope', label: 'Email' },
            { name: 'phone', label: 'Phone' },
            { name: 'megaphone', label: 'Announce' },
            { name: 'bell', label: 'Notification' },
            { name: 'share-network', label: 'Share' },
            { name: 'users', label: 'Community' },
            { name: 'user-circle', label: 'Profile' },
            { name: 'link', label: 'Link' },
            { name: 'at', label: 'Mention' },
            // Row 10 - Security & Privacy
            { name: 'lock', label: 'Security' },
            { name: 'shield-check', label: 'Protected' },
            { name: 'key', label: 'Access' },
            { name: 'fingerprint', label: 'Biometric' },
            { name: 'password', label: 'Password' },
            { name: 'detective', label: 'Investigation' },
            { name: 'warning', label: 'Warning' },
            { name: 'prohibit', label: 'Prohibited' },
            { name: 'check-circle', label: 'Verified' },
            { name: 'x-circle', label: 'Rejected' },
            // Row 11 - Weather & Environment
            { name: 'cloud-sun', label: 'Weather' },
            { name: 'cloud-rain', label: 'Rain' },
            { name: 'cloud-lightning', label: 'Storm' },
            { name: 'snowflake', label: 'Winter' },
            { name: 'thermometer', label: 'Temperature' },
            { name: 'wind', label: 'Wind' },
            { name: 'drop', label: 'Water' },
            { name: 'fire', label: 'Fire' },
            { name: 'tree', label: 'Forest' },
            { name: 'recycle', label: 'Recycle' },
            // Row 12 - Tools & Settings
            { name: 'gear', label: 'Settings' },
            { name: 'wrench', label: 'Tools' },
            { name: 'hammer', label: 'Build' },
            { name: 'screwdriver', label: 'Repair' },
            { name: 'paint-brush', label: 'Design' },
            { name: 'scissors', label: 'Cut' },
            { name: 'ruler', label: 'Measure' },
            { name: 'magnet', label: 'Attract' },
            { name: 'plug', label: 'Connect' },
            { name: 'faders', label: 'Adjust' },
            // Row 13 - Files & Documents
            { name: 'file-text', label: 'Document' },
            { name: 'folder', label: 'Folder' },
            { name: 'archive', label: 'Archive' },
            { name: 'clipboard-text', label: 'Clipboard' },
            { name: 'note', label: 'Note' },
            { name: 'notebook', label: 'Notebook' },
            { name: 'file-pdf', label: 'PDF' },
            { name: 'file-image', label: 'Image File' },
            { name: 'file-video', label: 'Video File' },
            { name: 'file-audio', label: 'Audio File' },
            // Row 14 - Time & Calendar
            { name: 'clock', label: 'Time' },
            { name: 'calendar', label: 'Calendar' },
            { name: 'calendar-check', label: 'Scheduled' },
            { name: 'hourglass', label: 'Waiting' },
            { name: 'timer', label: 'Timer' },
            { name: 'alarm', label: 'Alarm' },
            { name: 'calendar-blank', label: 'Date' },
            { name: 'clock-countdown', label: 'Countdown' },
            { name: 'calendar-star', label: 'Event' },
            { name: 'watch', label: 'Watch' },
            // Row 15 - Shopping & Commerce
            { name: 'bag', label: 'Bag' },
            { name: 'basket', label: 'Basket' },
            { name: 'credit-card', label: 'Payment' },
            { name: 'receipt', label: 'Receipt' },
            { name: 'tag', label: 'Tag' },
            { name: 'percent', label: 'Discount' },
            { name: 'gift', label: 'Gift' },
            { name: 'barcode', label: 'Barcode' },
            { name: 'package', label: 'Package' },
            { name: 'truck', label: 'Delivery' },
            // Row 16 - Entertainment & Fun
            { name: 'confetti', label: 'Celebration' },
            { name: 'party-popper', label: 'Party' },
            { name: 'balloon', label: 'Balloon' },
            { name: 'cake', label: 'Birthday' },
            { name: 'popcorn', label: 'Movies' },
            { name: 'ticket', label: 'Ticket' },
            { name: 'magic-wand', label: 'Magic' },
            { name: 'star', label: 'Star' },
            { name: 'heart', label: 'Love' },
            { name: 'smiley', label: 'Happy' },
            // Row 17 - Navigation & Direction
            { name: 'arrow-up', label: 'Up' },
            { name: 'arrow-down', label: 'Down' },
            { name: 'arrow-left', label: 'Left' },
            { name: 'arrow-right', label: 'Right' },
            { name: 'arrows-clockwise', label: 'Refresh' },
            { name: 'map-trifold', label: 'Map' },
            { name: 'navigation-arrow', label: 'Navigate' },
            { name: 'signpost', label: 'Direction' },
            { name: 'path', label: 'Path' },
            { name: 'crosshair', label: 'Target' },
            // Row 18 - Media Controls
            { name: 'play', label: 'Play' },
            { name: 'pause', label: 'Pause' },
            { name: 'stop', label: 'Stop' },
            { name: 'fast-forward', label: 'Forward' },
            { name: 'rewind', label: 'Rewind' },
            { name: 'skip-forward', label: 'Next' },
            { name: 'skip-back', label: 'Previous' },
            { name: 'shuffle', label: 'Shuffle' },
            { name: 'repeat', label: 'Repeat' },
            { name: 'speaker-high', label: 'Volume' },
            // Row 19 - Data & Analytics
            { name: 'chart-bar', label: 'Bar Chart' },
            { name: 'chart-line', label: 'Line Chart' },
            { name: 'chart-donut', label: 'Donut Chart' },
            { name: 'graph', label: 'Graph' },
            { name: 'trend-up', label: 'Growth' },
            { name: 'trend-down', label: 'Decline' },
            { name: 'database', label: 'Database' },
            { name: 'table', label: 'Table' },
            { name: 'funnel', label: 'Filter' },
            { name: 'pulse', label: 'Activity' },
            // Row 20 - Misc & General
            { name: 'flag', label: 'Flag' },
            { name: 'bookmark', label: 'Bookmark' },
            { name: 'puzzle-piece', label: 'Puzzle' },
            { name: 'lightbulb', label: 'Idea' },
            { name: 'target', label: 'Goal' },
            { name: 'crown', label: 'Premium' },
            { name: 'diamond', label: 'Luxury' },
            { name: 'coin', label: 'Coin' },
            { name: 'hand-coins', label: 'Earning' },
            { name: 'piggy-bank', label: 'Savings' }
        ]
    }">
        {{-- Page Header --}}
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                <a href="{{ url('/categories') }}" class="transition-colors hover:text-foreground">
                    <i class="ph-bold ph-folders"></i>
                    Categories
                </a>
                <i class="ph-bold ph-caret-right text-xs"></i>
                <span class="text-foreground">Create</span>
            </div>
            <h1 class="mt-2 text-xl font-bold text-foreground sm:text-2xl">Create Category</h1>
            <p class="mt-1 text-sm text-muted-foreground">Add a new category to organize your content.</p>
        </div>

        {{-- Form --}}
        <form action="{{ url('/categories') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">
                {{-- Main Content --}}
                <div class="space-y-4 sm:space-y-6 lg:col-span-2">
                    {{-- Basic Information --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary/10">
                                <i class="ph-bold ph-info text-lg text-primary"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Basic Information</h3>
                                <p class="text-xs text-muted-foreground">Enter the main details for your category</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            {{-- Category Name --}}
                            <div>
                                <label for="name" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-text-aa text-muted-foreground"></i>
                                    Category Name <span class="text-destructive">*</span>
                                </label>
                                <input type="text" id="name" name="name" required
                                    placeholder="e.g., Technology, Sports, Business"
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                                <p class="mt-1.5 text-xs text-muted-foreground">
                                    <i class="ph-bold ph-lightbulb text-warning"></i>
                                    The name will be displayed on the frontend navigation.
                                </p>
                            </div>

                            {{-- Slug --}}
                            <div>
                                <label for="slug" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-link text-muted-foreground"></i>
                                    URL Slug
                                </label>
                                <div class="flex items-center overflow-hidden rounded-lg border border-border bg-background focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all">
                                    <span class="flex h-full items-center bg-muted px-3 py-3 text-sm text-muted-foreground border-r border-border">
                                        /category/
                                    </span>
                                    <input type="text" id="slug" name="slug"
                                        placeholder="auto-generated-from-name"
                                        class="flex-1 bg-transparent px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:outline-none">
                                </div>
                                <p class="mt-1.5 text-xs text-muted-foreground">
                                    <i class="ph-bold ph-magic-wand text-info"></i>
                                    Leave empty to auto-generate from name.
                                </p>
                            </div>

                            {{-- Description --}}
                            <div>
                                <label for="description" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-article text-muted-foreground"></i>
                                    Description
                                </label>
                                <textarea id="description" name="description" rows="4"
                                    placeholder="Brief description of this category. This will be shown on the category page and used for SEO purposes..."
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all resize-none"></textarea>
                                <div class="mt-1.5 flex items-center justify-between">
                                    <p class="text-xs text-muted-foreground">
                                        <i class="ph-bold ph-note text-muted-foreground"></i>
                                        Optional. Used for SEO and category pages.
                                    </p>
                                    <span class="text-xs text-muted-foreground">0/500</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Category Icon & Color --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-accent/10">
                                <i class="ph-bold ph-palette text-lg text-accent"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Appearance</h3>
                                <p class="text-xs text-muted-foreground">Choose an icon and color for your category</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            {{-- Live Preview --}}
                            <div class="flex items-center justify-center rounded-lg border border-dashed border-border bg-muted/30 p-6">
                                <div class="flex flex-col items-center gap-3">
                                    <p class="text-xs font-medium text-muted-foreground uppercase tracking-wider">Preview</p>
                                    <div class="flex items-center gap-3 rounded-xl bg-card border border-border p-4 shadow-sm">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-xl transition-colors"
                                            :style="'background-color: ' + selectedColor + '15; color: ' + selectedColor">
                                            <i class="ph-bold text-2xl" :class="'ph-' + selectedIcon"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-foreground">Category Name</p>
                                            <p class="text-xs text-muted-foreground">12 articles</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Icon Selection --}}
                            <div>
                                <label class="mb-3 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-shapes text-muted-foreground"></i>
                                    Select Icon
                                    <span class="ml-auto text-xs text-muted-foreground">200 icons available</span>
                                </label>
                                <div class="max-h-80 overflow-y-auto rounded-xl border border-border bg-muted/30 p-3">
                                    <div class="flex flex-wrap gap-2">
                                        <template x-for="icon in icons" :key="icon.name">
                                            <button type="button"
                                                @click="selectedIcon = icon.name"
                                                :title="icon.label"
                                                class="group relative flex size-10 shrink-0 items-center justify-center rounded-lg border-2 transition-all duration-200"
                                                :class="selectedIcon === icon.name
                                                    ? 'border-primary bg-primary/10 text-primary scale-105 shadow-md'
                                                    : 'border-transparent bg-card text-muted-foreground hover:border-primary/50 hover:text-foreground hover:bg-card'">
                                                <i class="ph-bold text-lg" :class="'ph-' + icon.name"></i>
                                                <span x-show="selectedIcon === icon.name"
                                                    class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] text-primary-foreground">
                                                    <i class="ph-bold ph-check"></i>
                                                </span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                                <input type="hidden" name="icon" :value="selectedIcon">
                            </div>

                            {{-- Icon Color --}}
                            <div>
                                <label class="mb-3 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-paint-bucket text-muted-foreground"></i>
                                    Icon Color
                                </label>

                                {{-- Color Display & Picker --}}
                                <div class="space-y-4">
                                    {{-- Selected Color Display --}}
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <button type="button"
                                                @click="showColorPicker = !showColorPicker"
                                                class="flex h-14 w-14 items-center justify-center rounded-xl border-2 border-border shadow-sm transition-all hover:scale-105 hover:shadow-md"
                                                :style="'background-color: ' + selectedColor">
                                                <i class="ph-bold ph-eyedropper text-white text-xl drop-shadow"></i>
                                            </button>
                                            <span class="absolute -bottom-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-card border border-border shadow-sm">
                                                <i class="ph-bold ph-caret-down text-xs text-muted-foreground"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-foreground">Selected Color</p>
                                            <div class="mt-1 flex items-center gap-2">
                                                <input type="text"
                                                    x-model="selectedColor"
                                                    class="w-24 rounded-lg border border-border bg-background px-3 py-1.5 text-sm font-mono text-foreground uppercase focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                                <input type="color"
                                                    x-model="selectedColor"
                                                    class="h-8 w-8 cursor-pointer rounded-lg border border-border">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Preset Colors Grid - Always visible --}}
                                    <div>
                                        <p class="mb-2 text-xs font-medium text-muted-foreground uppercase tracking-wider">Quick Select</p>
                                        <div class="flex flex-wrap gap-2 rounded-xl border border-border bg-muted/30 p-3">
                                            {{-- Row 1: Blues & Purples --}}
                                            <button type="button" @click="selectedColor = '#6366f1'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #6366f1" :class="selectedColor === '#6366f1' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#6366f1'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#8b5cf6'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #8b5cf6" :class="selectedColor === '#8b5cf6' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#8b5cf6'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#a855f7'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #a855f7" :class="selectedColor === '#a855f7' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#a855f7'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#d946ef'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #d946ef" :class="selectedColor === '#d946ef' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#d946ef'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#ec4899'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #ec4899" :class="selectedColor === '#ec4899' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#ec4899'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#f43f5e'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #f43f5e" :class="selectedColor === '#f43f5e' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#f43f5e'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            {{-- Row 2: Reds & Oranges --}}
                                            <button type="button" @click="selectedColor = '#ef4444'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #ef4444" :class="selectedColor === '#ef4444' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#ef4444'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#f97316'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #f97316" :class="selectedColor === '#f97316' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#f97316'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#f59e0b'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #f59e0b" :class="selectedColor === '#f59e0b' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#f59e0b'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#eab308'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #eab308" :class="selectedColor === '#eab308' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#eab308'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#84cc16'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #84cc16" :class="selectedColor === '#84cc16' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#84cc16'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#22c55e'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #22c55e" :class="selectedColor === '#22c55e' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#22c55e'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            {{-- Row 3: Greens & Teals --}}
                                            <button type="button" @click="selectedColor = '#10b981'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #10b981" :class="selectedColor === '#10b981' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#10b981'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#14b8a6'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #14b8a6" :class="selectedColor === '#14b8a6' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#14b8a6'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#06b6d4'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #06b6d4" :class="selectedColor === '#06b6d4' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#06b6d4'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#0ea5e9'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #0ea5e9" :class="selectedColor === '#0ea5e9' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#0ea5e9'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#3b82f6'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #3b82f6" :class="selectedColor === '#3b82f6' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#3b82f6'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#1d4ed8'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #1d4ed8" :class="selectedColor === '#1d4ed8' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#1d4ed8'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            {{-- Row 4: Neutrals & Darks --}}
                                            <button type="button" @click="selectedColor = '#64748b'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #64748b" :class="selectedColor === '#64748b' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#64748b'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#475569'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #475569" :class="selectedColor === '#475569' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#475569'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#334155'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #334155" :class="selectedColor === '#334155' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#334155'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#1e293b'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #1e293b" :class="selectedColor === '#1e293b' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#1e293b'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#0f172a'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #0f172a" :class="selectedColor === '#0f172a' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#0f172a'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                            <button type="button" @click="selectedColor = '#000000'" class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md" style="background-color: #000000" :class="selectedColor === '#000000' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                <span x-show="selectedColor === '#000000'" class="absolute inset-0 flex items-center justify-center text-white"><i class="ph-bold ph-check text-sm drop-shadow"></i></span>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Custom Color Picker - Expandable --}}
                                    <div x-show="showColorPicker" x-collapse>
                                        <div class="flex items-center gap-3 rounded-xl border border-border bg-card p-3">
                                            <i class="ph-bold ph-palette text-muted-foreground"></i>
                                            <span class="text-sm text-muted-foreground">Custom:</span>
                                            <input type="color"
                                                x-model="selectedColor"
                                                class="h-10 w-full cursor-pointer rounded-lg border-0 bg-transparent">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="color" :value="selectedColor">
                            </div>
                        </div>
                    </div>

                    {{-- SEO Settings --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-info/10">
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
                                <label for="meta_title" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-text-h-one text-muted-foreground"></i>
                                    Meta Title
                                </label>
                                <input type="text" id="meta_title" name="meta_title"
                                    placeholder="SEO title for this category"
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                                <div class="mt-1.5 flex items-center justify-between">
                                    <p class="text-xs text-muted-foreground">Leave empty to use category name.</p>
                                    <span class="text-xs text-muted-foreground">0/60</span>
                                </div>
                            </div>

                            {{-- Meta Description --}}
                            <div>
                                <label for="meta_description" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-text-align-left text-muted-foreground"></i>
                                    Meta Description
                                </label>
                                <textarea id="meta_description" name="meta_description" rows="3"
                                    placeholder="SEO description for search engines..."
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all resize-none"></textarea>
                                <div class="mt-1.5 flex items-center justify-between">
                                    <p class="text-xs text-muted-foreground">Recommended: 150-160 characters.</p>
                                    <span class="text-xs text-muted-foreground">0/160</span>
                                </div>
                            </div>

                            {{-- SEO Preview --}}
                            <div class="rounded-lg border border-border bg-muted/30 p-4">
                                <p class="mb-3 flex items-center gap-1 text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                    <i class="ph-bold ph-eye"></i>
                                    Search Preview
                                </p>
                                <div class="space-y-1">
                                    <p class="text-base font-medium text-primary truncate">Category Name | Your Site</p>
                                    <p class="text-xs text-success truncate">https://yoursite.com/category/category-name</p>
                                    <p class="text-sm text-muted-foreground line-clamp-2">Brief description of this category will appear here. This is what users see in search results.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:sticky lg:top-4 lg:self-start space-y-4 sm:space-y-6">
                    {{-- Publish Settings --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-success/10">
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
                                <label for="status" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-toggle-left text-muted-foreground"></i>
                                    Status
                                </label>
                                <select id="status" name="status"
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                                    <option value="active">✅ Active</option>
                                    <option value="inactive">⏸️ Inactive</option>
                                </select>
                            </div>

                            {{-- Parent Category --}}
                            <div>
                                <label for="parent_id" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-tree-structure text-muted-foreground"></i>
                                    Parent Category
                                </label>
                                <select id="parent_id" name="parent_id"
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                                    <option value="">📁 None (Top Level)</option>
                                    <option value="1">└─ Technology</option>
                                    <option value="2">└─ Sports</option>
                                    <option value="3">└─ Business</option>
                                    <option value="4">└─ Entertainment</option>
                                    <option value="5">└─ World News</option>
                                </select>
                                <p class="mt-1.5 text-xs text-muted-foreground">
                                    <i class="ph-bold ph-info text-info"></i>
                                    Select to create a sub-category.
                                </p>
                            </div>

                            {{-- Display Order --}}
                            <div>
                                <label for="order" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-sort-ascending text-muted-foreground"></i>
                                    Display Order
                                </label>
                                <input type="number" id="order" name="order" value="0" min="0"
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                                <p class="mt-1.5 text-xs text-muted-foreground">
                                    <i class="ph-bold ph-arrow-up text-success"></i>
                                    Lower number = higher priority.
                                </p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-6 space-y-3">
                            <button type="submit"
                                class="group w-full rounded-lg bg-primary px-4 py-3 text-sm font-medium text-primary-foreground transition-all hover:bg-primary/90 hover:shadow-lg hover:shadow-primary/25 active:scale-[0.98]">
                                <i class="ph-bold ph-check mr-2 transition-transform group-hover:scale-110"></i>
                                Create Category
                            </button>
                            <a href="{{ url('/categories') }}"
                                class="flex w-full items-center justify-center rounded-lg border border-border bg-card px-4 py-3 text-sm font-medium text-foreground transition-all hover:bg-muted active:scale-[0.98]">
                                <i class="ph-bold ph-x mr-2"></i>
                                Cancel
                            </a>
                        </div>
                    </div>

                    {{-- Featured Image --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-warning/10">
                                <i class="ph-bold ph-image text-lg text-warning"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Featured Image</h3>
                                <p class="text-xs text-muted-foreground">Category cover image</p>
                            </div>
                        </div>

                        <label for="featured_image"
                            class="group flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-border bg-muted/30 p-8 transition-all hover:border-primary/50 hover:bg-muted/50">
                            <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-muted transition-transform group-hover:scale-110">
                                <i class="ph-bold ph-cloud-arrow-up text-2xl text-muted-foreground group-hover:text-primary transition-colors"></i>
                            </div>
                            <p class="mt-3 text-sm font-medium text-foreground">Click to upload</p>
                            <p class="mt-1 text-xs text-muted-foreground">or drag and drop</p>
                            <p class="mt-2 rounded-full bg-muted px-3 py-1 text-xs text-muted-foreground">
                                PNG, JPG up to 2MB
                            </p>
                            <input type="file" id="featured_image" name="featured_image" class="hidden" accept="image/*">
                        </label>
                    </div>

                    {{-- Tips Card --}}
                    <div class="rounded-xl border border-info/30 bg-info/5 p-4">
                        <div class="flex items-start gap-3">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-info/10">
                                <i class="ph-bold ph-lightbulb text-info"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground">Quick Tips</p>
                                <ul class="mt-2 space-y-1.5 text-xs text-muted-foreground">
                                    <li class="flex items-start gap-1">
                                        <i class="ph-bold ph-check-circle text-success mt-0.5"></i>
                                        Use clear, descriptive names
                                    </li>
                                    <li class="flex items-start gap-1">
                                        <i class="ph-bold ph-check-circle text-success mt-0.5"></i>
                                        Choose icons that represent content
                                    </li>
                                    <li class="flex items-start gap-1">
                                        <i class="ph-bold ph-check-circle text-success mt-0.5"></i>
                                        Keep hierarchy simple (max 2 levels)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
