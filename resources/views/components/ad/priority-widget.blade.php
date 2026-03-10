<div class="rounded-xl border border-border bg-card shadow-sm overflow-hidden"
     x-data="{
        priority: 5,
        // Dummy data representing ads currently active in the database
        activeAds: [
            { name: 'Smart 5G Unlimited', zone: 'home_top', weight: 8 },
            { name: 'ABA Bank Update', zone: 'home_top', weight: 6 },
            { name: 'Hanuman Summer Promo', zone: 'article_middle', weight: 9 },
            { name: 'Condo Launch - Urbanland', zone: 'home_footer', weight: 4 },
            { name: 'Special Event Popup', zone: 'home_popup', weight: 10 }
        ],
        // Dynamically filter ads based on what is checked in the Zones widget
        get competingAds() {
            if (this.selectedZones.length === 0) return [];
            return this.activeAds
                .filter(ad => this.selectedZones.includes(ad.zone))
                .sort((a, b) => b.weight - a.weight); // Sort highest priority first
        }
     }">

    <div class="border-b border-border p-4 flex items-center justify-between">
        <h3 class="font-semibold text-foreground">Priority (Stacking)</h3>
        <i class="ph-bold ph-info text-muted-foreground" title="Higher numbers show first when multiple ads are in the same zone"></i>
    </div>

    <div class="p-4">
        {{-- The Slider --}}
        <div class="flex items-center gap-3">
            <input type="range" name="priority" x-model="priority" min="1" max="10" class="w-full h-2 bg-background rounded-lg appearance-none cursor-pointer accent-primary border border-border">
            <span class="text-sm font-bold text-foreground w-6 text-center" x-text="priority"></span>
        </div>
        <div class="flex justify-between mt-2 text-[10px] text-muted-foreground font-medium uppercase">
            <span>Low (Bottom)</span>
            <span>High (Top)</span>
        </div>

        {{-- Dynamic Competing Ads List --}}
        <div x-show="selectedZones.length > 0" x-collapse class="mt-5 pt-4 border-t border-border">
            <p class="text-xs font-bold text-muted-foreground uppercase mb-3 flex items-center gap-1">
                <i class="ph-bold ph-warning-circle text-warning"></i> Competing Ads in Zones
            </p>

            <div class="space-y-2 max-h-[150px] overflow-y-auto pr-1">
                {{-- Loop through filtered ads --}}
                <template x-for="ad in competingAds" :key="ad.name">
                    <div class="flex items-center justify-between bg-background p-2.5 rounded-lg border border-border">
                        <div class="flex flex-col min-w-0 pr-2">
                            <span class="text-xs font-medium text-foreground truncate" x-text="ad.name"></span>
                            <span class="text-[10px] text-muted-foreground" x-text="ad.zone.replace('_', ' ').toUpperCase()"></span>
                        </div>
                        <div class="flex flex-col items-center justify-center bg-muted rounded px-2 py-1 min-w-[36px]">
                            <span class="text-[9px] text-muted-foreground uppercase font-bold leading-none mb-0.5">Pri</span>
                            <span class="text-xs font-bold text-foreground leading-none" x-text="ad.weight"></span>
                        </div>
                    </div>
                </template>

                {{-- Show if zones are selected but no ads compete --}}
                <div x-show="competingAds.length === 0" class="text-xs text-muted-foreground text-center italic py-2 bg-background/50 rounded-lg border border-dashed border-border">
                    Clear path! No other ads are running in these selected zones.
                </div>
            </div>
        </div>

    </div>
</div>
