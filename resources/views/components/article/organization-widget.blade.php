<div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
    {{-- Widget Header --}}
    <div class="mb-4 flex items-center gap-3">
        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-accent/10">
            <i class="ph-bold ph-folders text-lg text-accent"></i>
        </div>
        <div>
            <h3 class="text-base font-semibold text-foreground sm:text-lg">Organization</h3>
            <p class="text-xs text-muted-foreground">Categorize and position content</p>
        </div>
    </div>

    <div class="space-y-6">
        {{-- Category --}}
        <div>
            <label class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                <i class="ph-bold ph-folder-open text-muted-foreground"></i>
                Category <span class="text-destructive">*</span>
            </label>
            <select name="category_id" class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all appearance-none cursor-pointer" required>
                <option value="" disabled selected>Select a category</option>
                <optgroup label="Technology">
                    <option value="1">Technology (Parent)</option>
                    <option value="2">-- Web Development</option>
                    <option value="3">-- Artificial Intelligence</option>
                </optgroup>
                <optgroup label="Finance">
                    <option value="4">Finance (Parent)</option>
                    <option value="5">-- Markets</option>
                    <option value="6">-- Personal Finance</option>
                </optgroup>
            </select>
        </div>

        <hr class="border-border/60">

        {{-- Homepage Placements (Toggles) --}}
        <div>
            <label class="mb-4 flex items-center gap-1 text-sm font-medium text-foreground">
                <i class="ph-bold ph-layout text-muted-foreground"></i>
                Homepage Placements
            </label>
            <div class="space-y-5">

                {{-- 1. Breaking News Banner --}}
                <label class="flex items-center justify-between cursor-pointer group" x-data="{ checked: false }">
                    <div class="flex flex-col">
                        <span class="flex items-center gap-2 text-sm text-foreground font-medium group-hover:text-primary transition-colors">
                            <i class="ph-fill ph-lightning text-destructive"></i>
                            Breaking News Banner
                        </span>
                        <span class="text-xs text-muted-foreground ml-6 mt-0.5">Pins to the top scrolling ticker</span>
                    </div>
                    <div class="relative inline-flex h-5 w-9 shrink-0 items-center rounded-full transition-colors duration-200" :class="checked ? 'bg-primary' : 'bg-muted/80 border border-border'">
                        <input type="checkbox" name="is_breaking" class="sr-only" x-model="checked" value="1">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-sm transition-transform duration-200" :class="checked ? 'translate-x-4' : 'translate-x-0.5'"></span>
                    </div>
                </label>

                {{-- 2. Hero Featured Grid --}}
                <label class="flex items-center justify-between cursor-pointer group" x-data="{ checked: false }">
                    <div class="flex flex-col">
                        <span class="flex items-center gap-2 text-sm text-foreground font-medium group-hover:text-primary transition-colors">
                            <i class="ph-fill ph-star text-warning"></i>
                            Hero Featured Grid
                        </span>
                        <span class="text-xs text-muted-foreground ml-6 mt-0.5">Displays in the main bento box</span>
                    </div>
                    <div class="relative inline-flex h-5 w-9 shrink-0 items-center rounded-full transition-colors duration-200" :class="checked ? 'bg-primary' : 'bg-muted/80 border border-border'">
                        <input type="checkbox" name="is_featured" class="sr-only" x-model="checked" value="1">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-sm transition-transform duration-200" :class="checked ? 'translate-x-4' : 'translate-x-0.5'"></span>
                    </div>
                </label>

                {{-- 3. Editor's Picks --}}
                <label class="flex items-center justify-between cursor-pointer group" x-data="{ checked: false }">
                    <div class="flex flex-col">
                        <span class="flex items-center gap-2 text-sm text-foreground font-medium group-hover:text-primary transition-colors">
                            <i class="ph-fill ph-push-pin text-blue-500"></i>
                            Editor's Picks
                        </span>
                        <span class="text-xs text-muted-foreground ml-6 mt-0.5">Adds to the curated sidebar</span>
                    </div>
                    <div class="relative inline-flex h-5 w-9 shrink-0 items-center rounded-full transition-colors duration-200" :class="checked ? 'bg-primary' : 'bg-muted/80 border border-border'">
                        <input type="checkbox" name="is_editors_pick" class="sr-only" x-model="checked" value="1">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-sm transition-transform duration-200" :class="checked ? 'translate-x-4' : 'translate-x-0.5'"></span>
                    </div>
                </label>

                {{-- 4. PR / Sponsored Content --}}
                <label class="flex items-center justify-between cursor-pointer group" x-data="{ checked: false }">
                    <div class="flex flex-col">
                        <span class="flex items-center gap-2 text-sm text-foreground font-medium group-hover:text-primary transition-colors">
                            <i class="ph-fill ph-megaphone text-emerald-500"></i>
                            PR / Sponsored
                        </span>
                        <span class="text-xs text-muted-foreground ml-6 mt-0.5">Flags as paid promotional content</span>
                    </div>
                    <div class="relative inline-flex h-5 w-9 shrink-0 items-center rounded-full transition-colors duration-200" :class="checked ? 'bg-primary' : 'bg-muted/80 border border-border'">
                        <input type="checkbox" name="is_pr" class="sr-only" x-model="checked" value="1">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-sm transition-transform duration-200" :class="checked ? 'translate-x-4' : 'translate-x-0.5'"></span>
                    </div>
                </label>

            </div>
        </div>
    </div>
</div>
