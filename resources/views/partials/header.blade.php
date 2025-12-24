{{-- Header Navigation --}}
<header class="sticky top-0 z-40 flex h-16 items-center border-b border-border bg-card px-6">
    <div class="flex flex-1 items-center justify-between">
        {{-- Left Section: Mobile Menu & Search --}}
        <div class="flex items-center gap-4">
            {{-- Mobile Menu Button --}}
            <button type="button"
                @click="sidebarOpen = true"
                class="inline-flex items-center justify-center rounded-lg p-2 text-muted-foreground hover:bg-muted hover:text-foreground lg:hidden"
                aria-label="Open sidebar">
                <i class="ph-bold ph-list text-xl"></i>
            </button>

            {{-- Breadcrumb --}}
            <nav class="hidden items-center gap-2 text-sm md:flex">
                <a href="{{ url('/') }}" class="text-muted-foreground hover:text-foreground">
                    <i class="ph-bold ph-house"></i>
                </a>
                <i class="ph-bold ph-caret-right text-xs text-muted-foreground"></i>
                <span class="font-medium text-foreground">@yield('breadcrumb', 'Dashboard')</span>
            </nav>
        </div>

        {{-- Right Section: Actions --}}
        <div class="flex items-center gap-2">
            {{-- Search Button --}}
            <button type="button"
                class="inline-flex items-center justify-center rounded-lg p-2 text-muted-foreground hover:bg-muted hover:text-foreground"
                aria-label="Search">
                <i class="ph-bold ph-magnifying-glass text-xl"></i>
            </button>

            {{-- Notifications --}}
            <div class="relative" x-data="{ open: false }">
                <button type="button"
                    @click="open = !open"
                    class="relative inline-flex items-center justify-center rounded-lg p-2 text-muted-foreground hover:bg-muted hover:text-foreground"
                    aria-label="Notifications">
                    <i class="ph-bold ph-bell text-xl"></i>
                    {{-- Notification Badge --}}
                    <span class="absolute right-1 top-1 flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-accent opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-accent"></span>
                    </span>
                </button>

                {{-- Notifications Dropdown --}}
                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="fixed right-4 left-4 top-16 z-50 origin-top rounded-lg border border-border bg-card shadow-lg sm:absolute sm:left-auto sm:top-auto sm:right-0 sm:mt-2 sm:w-80">
                    <div class="flex items-center justify-between border-b border-border px-4 py-3">
                        <h3 class="text-sm font-semibold text-foreground">Notifications</h3>
                        <span class="rounded-full bg-accent px-2 py-0.5 text-xs font-medium text-accent-foreground">3 New</span>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        <a href="#" class="flex gap-3 px-4 py-3 hover:bg-muted">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-primary/10">
                                <i class="ph-bold ph-article text-primary"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-foreground">New article published</p>
                                <p class="text-xs text-muted-foreground">2 minutes ago</p>
                            </div>
                        </a>
                        <a href="#" class="flex gap-3 px-4 py-3 hover:bg-muted">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-accent/10">
                                <i class="ph-bold ph-chat-circle text-accent"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-foreground">New comment awaiting approval</p>
                                <p class="text-xs text-muted-foreground">15 minutes ago</p>
                            </div>
                        </a>
                        <a href="#" class="flex gap-3 px-4 py-3 hover:bg-muted">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-success/10">
                                <i class="ph-bold ph-user-plus text-success"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-foreground">New user registered</p>
                                <p class="text-xs text-muted-foreground">1 hour ago</p>
                            </div>
                        </a>
                    </div>
                    <div class="border-t border-border p-2">
                        <a href="{{ url('/notifications') }}" class="block rounded-lg px-3 py-2 text-center text-sm font-medium text-primary hover:bg-muted">
                            View all notifications
                        </a>
                    </div>
                </div>
            </div>

            {{-- Theme Toggle --}}
            <button type="button"
                class="inline-flex items-center justify-center rounded-lg p-2 text-muted-foreground hover:bg-muted hover:text-foreground"
                aria-label="Toggle theme"
                onclick="document.documentElement.classList.toggle('dark')">
                <i class="ph-bold ph-sun text-xl dark:hidden"></i>
                <i class="ph-bold ph-moon hidden text-xl dark:inline"></i>
            </button>

            {{-- Divider --}}
            <div class="mx-2 h-6 w-px bg-border"></div>

            {{-- User Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button type="button"
                    @click="open = !open"
                    class="flex items-center gap-3 rounded-lg p-1.5 hover:bg-muted"
                    aria-label="User menu">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary">
                        <span class="text-sm font-medium text-primary-foreground">AU</span>
                    </div>
                    <div class="hidden text-left md:block">
                        <p class="text-sm font-medium text-foreground">Admin User</p>
                        <p class="text-xs text-muted-foreground">Administrator</p>
                    </div>
                    <i class="ph-bold ph-caret-down hidden text-sm text-muted-foreground transition-transform duration-200 md:block"
                        :class="open ? 'rotate-180' : ''"></i>
                </button>

                {{-- User Dropdown Menu --}}
                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-64 origin-top-right rounded-lg border border-border bg-card shadow-lg">

                    {{-- User Info Header --}}
                    <div class="border-b border-border px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary">
                                <span class="text-sm font-bold text-primary-foreground">AU</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-foreground">Admin User</p>
                                <p class="text-xs text-muted-foreground">admin@example.com</p>
                            </div>
                        </div>
                        <div class="mt-2 flex items-center gap-2">
                            <span class="inline-flex items-center rounded-full bg-primary/10 px-2 py-0.5 text-xs font-medium text-primary">
                                <i class="ph-bold ph-crown mr-1"></i>
                                Administrator
                            </span>
                            <span class="inline-flex items-center rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">
                                <i class="ph-bold ph-circle-fill mr-1 text-[8px]"></i>
                                Online
                            </span>
                        </div>
                    </div>

                    {{-- Menu Items --}}
                    <div class="py-1">
                        <a href="{{ url('/profile') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-foreground hover:bg-muted">
                            <i class="ph-bold ph-user text-lg text-muted-foreground"></i>
                            My Profile
                        </a>
                        <a href="{{ url('/profile/edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-foreground hover:bg-muted">
                            <i class="ph-bold ph-pencil-simple text-lg text-muted-foreground"></i>
                            Edit Profile
                        </a>
                        <a href="{{ url('/settings/account') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-foreground hover:bg-muted">
                            <i class="ph-bold ph-gear text-lg text-muted-foreground"></i>
                            Account Settings
                        </a>
                        <a href="{{ url('/settings/security') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-foreground hover:bg-muted">
                            <i class="ph-bold ph-lock text-lg text-muted-foreground"></i>
                            Security
                        </a>
                        <a href="{{ url('/settings/notifications') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-foreground hover:bg-muted">
                            <i class="ph-bold ph-bell-ringing text-lg text-muted-foreground"></i>
                            Notification Preferences
                        </a>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="border-t border-border py-1">
                        <a href="{{ url('/articles/create') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-foreground hover:bg-muted">
                            <i class="ph-bold ph-plus-circle text-lg text-muted-foreground"></i>
                            New Article
                        </a>
                        <a href="{{ url('/logs/user-activity') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-foreground hover:bg-muted">
                            <i class="ph-bold ph-clock-counter-clockwise text-lg text-muted-foreground"></i>
                            My Activity
                        </a>
                    </div>

                    {{-- Help & Support --}}
                    <div class="border-t border-border py-1">
                        <a href="{{ url('/help') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-foreground hover:bg-muted">
                            <i class="ph-bold ph-question text-lg text-muted-foreground"></i>
                            Help & Support
                        </a>
                        <a href="{{ url('/docs') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-foreground hover:bg-muted">
                            <i class="ph-bold ph-book-open text-lg text-muted-foreground"></i>
                            Documentation
                        </a>
                        <a href="{{ url('/keyboard-shortcuts') }}" class="flex items-center justify-between px-4 py-2 text-sm text-foreground hover:bg-muted">
                            <div class="flex items-center gap-3">
                                <i class="ph-bold ph-keyboard text-lg text-muted-foreground"></i>
                                Keyboard Shortcuts
                            </div>
                            <kbd class="rounded bg-muted px-1.5 py-0.5 text-xs text-muted-foreground">⌘K</kbd>
                        </a>
                    </div>

                    {{-- Logout --}}
                    <div class="border-t border-border py-1">
                        <a href="{{ url('/logout') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-destructive hover:bg-destructive/10">
                            <i class="ph-bold ph-sign-out text-lg"></i>
                            Sign out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
