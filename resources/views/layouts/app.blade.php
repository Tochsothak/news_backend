<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - News Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground antialiased">
    {{-- Main Layout Container --}}
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        {{-- Sidebar Overlay (Mobile) --}}
        <div
            x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/50 lg:hidden"
            x-cloak
        ></div>

        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Main Content Area --}}
        <div class="flex flex-1 flex-col overflow-hidden">
            {{-- Header --}}
            @include('partials.header')

            {{-- Page Content with scroll detection for footer --}}
            <main
                x-data="{
                    lastScrollTop: 0,
                    showFooter: false,
                    handleScroll(e) {
                        const st = e.target.scrollTop;
                        if (st > this.lastScrollTop && st > 100) {
                            this.showFooter = false;
                        } else if (st < this.lastScrollTop) {
                            this.showFooter = true;
                        }
                        this.lastScrollTop = st <= 0 ? 0 : st;
                    }
                }"
                @scroll="handleScroll($event)"
                class="relative flex-1 overflow-y-auto overflow-x-hidden bg-background p-4 sm:p-6"
            >
                @yield('content')

                {{-- Include Footer Partial --}}
                @include('partials.footer')
            </main>
        </div>
    </div>
</body>

</html>
