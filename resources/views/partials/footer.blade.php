{{-- Footer --}}
<footer
    x-show="showFooter"
    x-transition:enter="transition-transform duration-300 ease-out"
    x-transition:enter-start="translate-y-full"
    x-transition:enter-end="translate-y-0"
    x-transition:leave="transition-transform duration-300 ease-in"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="translate-y-full"
    x-cloak
    class="fixed bottom-0 left-0 right-0 z-30 border-t border-border bg-card px-4 py-3 shadow-lg sm:px-6 sm:py-4 lg:left-64"
>
    <div class="flex flex-col items-center justify-between gap-2 sm:flex-row sm:gap-4">
        {{-- Copyright --}}
        <p class="text-xs text-muted-foreground sm:text-sm">
            &copy; {{ date('Y') }} <span class="font-medium text-foreground">News Portal</span>. All rights reserved.
        </p>
        {{-- Version Info --}}
        <p class="text-[10px] text-muted-foreground sm:text-xs">
            Version 1.0.0
        </p>
    </div>
</footer>
