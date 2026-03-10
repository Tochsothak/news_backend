<div class="rounded-xl border border-border bg-card shadow-sm overflow-hidden">
    <div class="border-b border-border p-4">
        <h3 class="font-semibold text-foreground">Display Zones</h3>
    </div>
    <div class="p-4 space-y-5">

        {{-- Homepage Group --}}
        <div>
            <p class="text-xs font-bold text-muted-foreground uppercase tracking-wider mb-2">Homepage</p>
            <div class="space-y-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="zones[]" value="home_top" x-model="selectedZones" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background">
                    <span class="text-sm text-foreground">Top Banner (Below Category)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="zones[]" value="home_middle" x-model="selectedZones" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background">
                    <span class="text-sm text-foreground">Middle Banner</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="zones[]" value="home_bottom" x-model="selectedZones" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background">
                    <span class="text-sm text-foreground">Bottom Banner (End Article)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="zones[]" value="home_popup" x-model="selectedZones" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background">
                    <span class="text-sm text-foreground">Pop Up (Modal)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="zones[]" value="home_footer" x-model="selectedZones" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background">
                    <span class="text-sm text-foreground  font-medium">Sticky Footer </span>
                </label>
            </div>
        </div>

        {{-- Article Page Group --}}
        <div>
            <p class="text-xs font-bold text-muted-foreground uppercase tracking-wider mb-2">Article Pages</p>
            <div class="space-y-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="zones[]" value="article_top" x-model="selectedZones" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background">
                    <span class="text-sm text-foreground">Top Banner (Above Title)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="zones[]" value="article_middle" x-model="selectedZones" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background">
                    <span class="text-sm text-foreground">In-Article (Middle)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="zones[]" value="article_bottom" x-model="selectedZones" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background">
                    <span class="text-sm text-foreground">Bottom Banner (End Article)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="zones[]" value="article_popup" x-model="selectedZones" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background">
                    <span class="text-sm text-foreground">Pop Up (Modal)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="zones[]" value="article_footer" x-model="selectedZones" class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary focus:ring-offset-background">
                    <span class="text-sm text-foreground font-medium">Sticky Footer </span>
                </label>
            </div>
        </div>

    </div>
</div>
