{{-- filepath: /Users/HaruMalik/Desktop/News-Portal-2026/news_backend/resources/views/partials/sidebar.blade.php --}}
{{-- Sidebar Navigation - Responsive --}}
<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-64 transform border-r border-border bg-card transition-transform duration-300 ease-in-out lg:relative lg:z-auto lg:translate-x-0"
    @keydown.escape.window="sidebarOpen = false"
>
    <div class="flex h-screen flex-col">
        {{-- Logo Section --}}
        <div class="flex h-16 items-center border-b border-border px-6">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary">
                    <span class="text-sm font-bold text-primary-foreground">NP</span>
                </div>
                <span class="text-lg font-semibold text-foreground">News Portal</span>
            </a>
        </div>

        {{-- Navigation Menu --}}
        <nav class="flex-1 overflow-y-auto overscroll-contain p-4" x-data="{
            openMenus: {
                articles: {{ request()->is('articles*') ? 'true' : 'false' }},
                categories: {{ request()->is('categories*') ? 'true' : 'false' }},
                tags: {{ request()->is('tags*') ? 'true' : 'false' }},
                media: {{ request()->is('media*') ? 'true' : 'false' }},
                pages: {{ request()->is('pages*') ? 'true' : 'false' }},
                comments: {{ request()->is('comments*') ? 'true' : 'false' }},
                ads: {{ request()->is('ads*') ? 'true' : 'false' }},
                newsletter: {{ request()->is('newsletter*') ? 'true' : 'false' }},
                users: {{ request()->is('users*') ? 'true' : 'false' }},
                roles: {{ request()->is('roles*') ? 'true' : 'false' }},
                appearance: {{ request()->is('appearance*') ? 'true' : 'false' }},
                analytics: {{ request()->is('analytics*') ? 'true' : 'false' }},
                reports: {{ request()->is('reports*') ? 'true' : 'false' }},
                settings: {{ request()->is('settings*') ? 'true' : 'false' }},
                integrations: {{ request()->is('integrations*') ? 'true' : 'false' }},
                logs: {{ request()->is('logs*') ? 'true' : 'false' }},
                backup: {{ request()->is('backup*') ? 'true' : 'false' }}
            }
        }">
            {{-- ========================================
                MAIN MENU
            ======================================== --}}
            <div class="mb-6">
                <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-muted-foreground">
                    Main Menu
                </p>

                {{-- Dashboard (No submenu) --}}
                <a href="{{ url('/') }}"
                    class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition-colors
                    {{ request()->is('/') ? 'bg-primary text-primary-foreground' : 'text-foreground hover:bg-muted' }}">
                    <i class="ph-bold ph-house text-lg"></i>
                    <span>Dashboard</span>
                </a>

                {{-- Articles --}}
                <div class="mt-1">
                    <button @click="openMenus.articles = !openMenus.articles"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('articles*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-article text-lg"></i>
                            <span>Articles</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.articles ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.articles" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/articles') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('articles') && !request()->is('articles/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                All Articles
                            </a>
                            <a href="{{ url('/articles/create') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('articles/create') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Create Article
                            </a>
                            <a href="{{ url('/articles/drafts') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('articles/drafts') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Drafts
                            </a>
                            <a href="{{ url('/articles/published') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('articles/published') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Published
                            </a>
                            <a href="{{ url('/articles/scheduled') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('articles/scheduled') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Scheduled
                            </a>
                            <a href="{{ url('/articles/trash') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('articles/trash') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Trash
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Categories --}}
                <div class="mt-1">
                    <button @click="openMenus.categories = !openMenus.categories"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('categories*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-folders text-lg"></i>
                            <span>Categories</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.categories ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.categories" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/categories') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('categories') && !request()->is('categories/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                All Categories
                            </a>
                            <a href="{{ url('/categories/create') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('categories/create') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Create Category
                            </a>
                            <a href="{{ url('/categories/sub-categories') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('categories/sub-categories*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Sub-Categories
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Tags --}}
                <div class="mt-1">
                    <button @click="openMenus.tags = !openMenus.tags"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('tags*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-tag text-lg"></i>
                            <span>Tags</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.tags ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.tags" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/tags') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('tags') && !request()->is('tags/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                All Tags
                            </a>
                            <a href="{{ url('/tags/create') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('tags/create') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Create Tag
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Media Library --}}
                <div class="mt-1">
                    <button @click="openMenus.media = !openMenus.media"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('media*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-image text-lg"></i>
                            <span>Media Library</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.media ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.media" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/media') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('media') && !request()->is('media/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                All Media
                            </a>
                            <a href="{{ url('/media/upload') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('media/upload') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Upload Media
                            </a>
                            <a href="{{ url('/media/images') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('media/images') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Images
                            </a>
                            <a href="{{ url('/media/videos') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('media/videos') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Videos
                            </a>
                            <a href="{{ url('/media/documents') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('media/documents') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Documents
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Pages --}}
                <div class="mt-1">
                    <button @click="openMenus.pages = !openMenus.pages"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('pages*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-file-text text-lg"></i>
                            <span>Pages</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.pages ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.pages" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/pages') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('pages') && !request()->is('pages/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                All Pages
                            </a>
                            <a href="{{ url('/pages/create') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('pages/create') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Create Page
                            </a>
                            <a href="{{ url('/pages/trash') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('pages/trash') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Trash
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================
                CONTENT MANAGEMENT
            ======================================== --}}
            <div class="mb-6">
                <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-muted-foreground">
                    Content Management
                </p>

                {{-- Comments --}}
                <div class="mt-1">
                    <button @click="openMenus.comments = !openMenus.comments"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('comments*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-chat-circle text-lg"></i>
                            <span>Comments</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.comments ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.comments" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/comments') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('comments') && !request()->is('comments/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                All Comments
                            </a>
                            <a href="{{ url('/comments/pending') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('comments/pending') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Pending
                            </a>
                            <a href="{{ url('/comments/approved') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('comments/approved') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Approved
                            </a>
                            <a href="{{ url('/comments/spam') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('comments/spam') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Spam
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Advertisements --}}
                <div class="mt-1">
                    <button @click="openMenus.ads = !openMenus.ads"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('ads*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-megaphone text-lg"></i>
                            <span>Advertisements</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.ads ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.ads" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/ads') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('ads') && !request()->is('ads/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                All Ads
                            </a>
                            <a href="{{ url('/ads/create') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('ads/create') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Create Ad
                            </a>
                            <a href="{{ url('/ads/zones') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('ads/zones') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Ad Zones
                            </a>
                            <a href="{{ url('/ads/reports') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('ads/reports') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Ad Reports
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Newsletter --}}
                <div class="mt-1">
                    <button @click="openMenus.newsletter = !openMenus.newsletter"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('newsletter*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-envelope text-lg"></i>
                            <span>Newsletter</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.newsletter ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.newsletter" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/newsletter/subscribers') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('newsletter/subscribers') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Subscribers
                            </a>
                            <a href="{{ url('/newsletter/campaigns') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('newsletter/campaigns') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Campaigns
                            </a>
                            <a href="{{ url('/newsletter/campaigns/create') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('newsletter/campaigns/create') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Create Campaign
                            </a>
                            <a href="{{ url('/newsletter/templates') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('newsletter/templates') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Templates
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================
                USERS & PERMISSIONS
            ======================================== --}}
            <div class="mb-6">
                <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-muted-foreground">
                    Users & Permissions
                </p>

                {{-- Users --}}
                <div class="mt-1">
                    <button @click="openMenus.users = !openMenus.users"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('users*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-users text-lg"></i>
                            <span>Users</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.users ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.users" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/users') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('users') && !request()->is('users/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                All Users
                            </a>
                            <a href="{{ url('/users/create') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('users/create') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Create User
                            </a>
                            <a href="{{ url('/users/authors') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('users/authors') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Authors
                            </a>
                            <a href="{{ url('/users/editors') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('users/editors') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Editors
                            </a>
                            <a href="{{ url('/users/subscribers') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('users/subscribers') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Subscribers
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Roles & Permissions --}}
                <div class="mt-1">
                    <button @click="openMenus.roles = !openMenus.roles"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('roles*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-shield-check text-lg"></i>
                            <span>Roles & Permissions</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.roles ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.roles" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/roles') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('roles') && !request()->is('roles/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                All Roles
                            </a>
                            <a href="{{ url('/roles/create') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('roles/create') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Create Role
                            </a>
                            <a href="{{ url('/roles/permissions') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('roles/permissions') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Permissions
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================
                APPEARANCE
            ======================================== --}}
            <div class="mb-6">
                <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-muted-foreground">
                    Appearance
                </p>

                {{-- Appearance --}}
                <div class="mt-1">
                    <button @click="openMenus.appearance = !openMenus.appearance"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('appearance*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-paint-brush text-lg"></i>
                            <span>Appearance</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.appearance ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.appearance" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/appearance/themes') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('appearance/themes') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Themes
                            </a>
                            <a href="{{ url('/appearance/menus') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('appearance/menus') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Menus
                            </a>
                            <a href="{{ url('/appearance/widgets') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('appearance/widgets') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Widgets
                            </a>
                            <a href="{{ url('/appearance/customize') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('appearance/customize') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Customize
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================
                ANALYTICS & REPORTS
            ======================================== --}}
            <div class="mb-6">
                <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-muted-foreground">
                    Analytics & Reports
                </p>

                {{-- Analytics --}}
                <div class="mt-1">
                    <button @click="openMenus.analytics = !openMenus.analytics"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('analytics*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-chart-line text-lg"></i>
                            <span>Analytics</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.analytics ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.analytics" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/analytics') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('analytics') && !request()->is('analytics/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Overview
                            </a>
                            <a href="{{ url('/analytics/page-views') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('analytics/page-views') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Page Views
                            </a>
                            <a href="{{ url('/analytics/popular-articles') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('analytics/popular-articles') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Popular Articles
                            </a>
                            <a href="{{ url('/analytics/user-statistics') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('analytics/user-statistics') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                User Statistics
                            </a>
                            <a href="{{ url('/analytics/traffic-sources') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('analytics/traffic-sources') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Traffic Sources
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Reports --}}
                <div class="mt-1">
                    <button @click="openMenus.reports = !openMenus.reports"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('reports*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-chart-bar text-lg"></i>
                            <span>Reports</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.reports ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.reports" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/reports/content') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('reports/content') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Content Reports
                            </a>
                            <a href="{{ url('/reports/users') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('reports/users') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                User Reports
                            </a>
                            <a href="{{ url('/reports/revenue') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('reports/revenue') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Revenue Reports
                            </a>
                            <a href="{{ url('/reports/export') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('reports/export') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Export Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================
                SYSTEM
            ======================================== --}}
            <div class="mb-6">
                <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-muted-foreground">
                    System
                </p>

                {{-- Settings --}}
                <div class="mt-1">
                    <button @click="openMenus.settings = !openMenus.settings"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('settings*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-gear text-lg"></i>
                            <span>Settings</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.settings ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.settings" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/settings/general') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('settings/general') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                General
                            </a>
                            <a href="{{ url('/settings/reading') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('settings/reading') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Reading
                            </a>
                            <a href="{{ url('/settings/writing') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('settings/writing') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Writing
                            </a>
                            <a href="{{ url('/settings/seo') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('settings/seo') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                SEO
                            </a>
                            <a href="{{ url('/settings/social-media') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('settings/social-media') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Social Media
                            </a>
                            <a href="{{ url('/settings/email') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('settings/email') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Email
                            </a>
                            <a href="{{ url('/settings/cache') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('settings/cache') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Cache
                            </a>
                            <a href="{{ url('/settings/api-keys') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('settings/api-keys') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                API Keys
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Integrations --}}
                <div class="mt-1">
                    <button @click="openMenus.integrations = !openMenus.integrations"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('integrations*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-plugs text-lg"></i>
                            <span>Integrations</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.integrations ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.integrations" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/integrations/social-login') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('integrations/social-login') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Social Login
                            </a>
                            <a href="{{ url('/integrations/payment-gateways') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('integrations/payment-gateways') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Payment Gateways
                            </a>
                            <a href="{{ url('/integrations/third-party-apis') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('integrations/third-party-apis') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Third-party APIs
                            </a>
                            <a href="{{ url('/integrations/webhooks') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('integrations/webhooks') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Webhooks
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Activity Logs --}}
                <div class="mt-1">
                    <button @click="openMenus.logs = !openMenus.logs"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('logs*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-clock-counter-clockwise text-lg"></i>
                            <span>Activity Logs</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.logs ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.logs" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/logs') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('logs') && !request()->is('logs/*') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                All Logs
                            </a>
                            <a href="{{ url('/logs/user-activity') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('logs/user-activity') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                User Activity
                            </a>
                            <a href="{{ url('/logs/system') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('logs/system') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                System Logs
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Backup --}}
                <div class="mt-1">
                    <button @click="openMenus.backup = !openMenus.backup"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->is('backup*') ? 'bg-muted text-foreground' : 'text-foreground hover:bg-muted' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-database text-lg"></i>
                            <span>Backup</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="openMenus.backup ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openMenus.backup" x-collapse>
                        <div class="ml-6 mt-1 space-y-1 border-l border-border pl-3">
                            <a href="{{ url('/backup/create') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('backup/create') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Create Backup
                            </a>
                            <a href="{{ url('/backup/restore') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm transition-colors
                                {{ request()->is('backup/restore') ? 'text-primary font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                                Restore
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</aside>
