<div class="rounded-xl border border-border bg-card shadow-sm p-5 flex flex-col h-full" x-data="{ activeTab: 'device' }">

    {{-- Header & Tabs --}}
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-base font-semibold text-foreground">Clicks Breakdown</h2>

        {{-- Tab Toggle --}}
        <div class="flex rounded-lg bg-muted/50 p-1 border border-border/50">
            <button @click="activeTab = 'device'"
                    :class="activeTab === 'device' ? 'bg-background text-foreground shadow-sm border border-border/50' : 'text-muted-foreground hover:text-foreground'"
                    class="px-3 py-1 text-xs font-medium rounded-md transition-all">
                Device
            </button>
            <button @click="activeTab = 'os'"
                    :class="activeTab === 'os' ? 'bg-background text-foreground shadow-sm border border-border/50' : 'text-muted-foreground hover:text-foreground'"
                    class="px-3 py-1 text-xs font-medium rounded-md transition-all">
                OS
            </button>
        </div>
    </div>

    <div class="flex-1 flex flex-col justify-center relative">

        {{-- ========================================== --}}
        {{-- TAB 1: DEVICE TYPE --}}
        {{-- ========================================== --}}
        <div x-show="activeTab === 'device'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">

            {{-- Mobile Stats --}}
            <div>
                <div class="flex items-center justify-between text-sm mb-2">
                    <div class="flex items-center gap-2 font-medium text-foreground">
                        <i class="ph-bold ph-device-mobile text-accent text-lg"></i>
                        Mobile
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-foreground">68%</span>
                        <span class="text-xs text-muted-foreground ml-1">(3,991 clicks)</span>
                    </div>
                </div>
                <div class="w-full bg-muted rounded-full h-2.5 overflow-hidden">
                    <div class="bg-accent h-2.5 rounded-full" style="width: 68%"></div>
                </div>
            </div>

            {{-- Desktop Stats --}}
            <div>
                <div class="flex items-center justify-between text-sm mb-2">
                    <div class="flex items-center gap-2 font-medium text-foreground">
                        <i class="ph-bold ph-desktop text-primary text-lg"></i>
                        Desktop
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-foreground">27%</span>
                        <span class="text-xs text-muted-foreground ml-1">(1,584 clicks)</span>
                    </div>
                </div>
                <div class="w-full bg-muted rounded-full h-2.5 overflow-hidden">
                    <div class="bg-primary h-2.5 rounded-full" style="width: 27%"></div>
                </div>
            </div>

            {{-- Tablet Stats --}}
            <div>
                <div class="flex items-center justify-between text-sm mb-2">
                    <div class="flex items-center gap-2 font-medium text-foreground">
                        <i class="ph-bold ph-device-tablet text-info text-lg"></i>
                        Tablet
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-foreground">5%</span>
                        <span class="text-xs text-muted-foreground ml-1">(295 clicks)</span>
                    </div>
                </div>
                <div class="w-full bg-muted rounded-full h-2.5 overflow-hidden">
                    <div class="bg-info h-2.5 rounded-full" style="width: 5%"></div>
                </div>
            </div>

        </div>

        {{-- ========================================== --}}
        {{-- TAB 2: OPERATING SYSTEM --}}
        {{-- ========================================== --}}
        <div x-show="activeTab === 'os'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-5">

            {{-- iOS / Apple --}}
            <div>
                <div class="flex items-center justify-between text-sm mb-2">
                    <div class="flex items-center gap-2 font-medium text-foreground">
                        <i class="ph-bold ph-apple-logo text-foreground text-lg"></i>
                        iOS / macOS
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-foreground">42%</span>
                    </div>
                </div>
                <div class="w-full bg-muted rounded-full h-2.5 overflow-hidden">
                    <div class="bg-foreground h-2.5 rounded-full" style="width: 42%"></div>
                </div>
            </div>

            {{-- Android --}}
            <div>
                <div class="flex items-center justify-between text-sm mb-2">
                    <div class="flex items-center gap-2 font-medium text-foreground">
                        <i class="ph-bold ph-android-logo text-success text-lg"></i>
                        Android
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-foreground">38%</span>
                    </div>
                </div>
                <div class="w-full bg-muted rounded-full h-2.5 overflow-hidden">
                    <div class="bg-success h-2.5 rounded-full" style="width: 38%"></div>
                </div>
            </div>

            {{-- Windows --}}
            <div>
                <div class="flex items-center justify-between text-sm mb-2">
                    <div class="flex items-center gap-2 font-medium text-foreground">
                        <i class="ph-bold ph-windows-logo text-info text-lg"></i>
                        Windows
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-foreground">17%</span>
                    </div>
                </div>
                <div class="w-full bg-muted rounded-full h-2.5 overflow-hidden">
                    <div class="bg-info h-2.5 rounded-full" style="width: 17%"></div>
                </div>
            </div>

            {{-- Other / Unknown --}}
            <div>
                <div class="flex items-center justify-between text-sm mb-2">
                    <div class="flex items-center gap-2 font-medium text-foreground">
                        <i class="ph-bold ph-question text-muted-foreground text-lg"></i>
                        Other
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-foreground">3%</span>
                    </div>
                </div>
                <div class="w-full bg-muted rounded-full h-2.5 overflow-hidden">
                    <div class="bg-muted-foreground h-2.5 rounded-full" style="width: 3%"></div>
                </div>
            </div>

        </div>

    </div>
</div>
