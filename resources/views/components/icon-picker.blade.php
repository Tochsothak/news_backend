<div x-data="{
    iconSearch: '',
    iconCategory: 'all',
    icons: {{ Js::from($icons) }},
    categories: {{ Js::from($categories) }},
    get filteredIcons() {
        return this.icons.filter(icon => {
            const matchesSearch = this.iconSearch === '' ||
                icon.name.toLowerCase().includes(this.iconSearch.toLowerCase()) ||
                icon.label.toLowerCase().includes(this.iconSearch.toLowerCase());
            const matchesCategory = this.iconCategory === 'all' || icon.category === this.iconCategory;
            return matchesSearch && matchesCategory;
        });
    }
}">
    <label class="mb-3 flex items-center gap-1 text-sm font-medium text-foreground">
        <i class="ph-bold ph-shapes text-muted-foreground"></i>
        Select Icon
        <span class="ml-auto text-xs text-muted-foreground">
            <span x-text="filteredIcons.length"></span> icons
        </span>
    </label>

    {{-- Search Bar --}}
    <div class="mb-3">
        <div class="relative">
            <i class="ph-bold ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"></i>
            <input type="text"
                x-model="iconSearch"
                placeholder="Search icons..."
                class="w-full rounded-lg border border-border bg-background py-2.5 pl-10 pr-4 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
            <button type="button"
                x-show="iconSearch.length > 0"
                @click="iconSearch = ''"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground">
                <i class="ph-bold ph-x text-sm"></i>
            </button>
        </div>
    </div>

    {{-- Category Filter --}}
    <div class="mb-3 flex flex-wrap gap-1.5">
        <template x-for="(label, key) in categories" :key="key">
            <button type="button"
                @click="iconCategory = key"
                :class="iconCategory === key
                    ? 'bg-primary text-primary-foreground'
                    : 'bg-muted text-muted-foreground hover:bg-muted/80 hover:text-foreground'"
                class="rounded-full px-2.5 py-1 text-xs font-medium transition-colors"
                x-text="label">
            </button>
        </template>
    </div>

    {{-- Icons Grid --}}
    <div class="max-h-80 overflow-y-auto rounded-xl border border-border bg-muted/30 p-3">
        <div class="flex flex-wrap gap-2">
            <template x-for="icon in filteredIcons" :key="icon.name">
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

        {{-- No Results --}}
        <div x-show="filteredIcons.length === 0" class="py-8 text-center">
            <i class="ph-bold ph-magnifying-glass text-3xl text-muted-foreground"></i>
            <p class="mt-2 text-sm text-muted-foreground">No icons found</p>
            <button type="button" @click="iconSearch = ''; iconCategory = 'all'"
                class="mt-2 text-xs text-primary hover:underline">
                Clear filters
            </button>
        </div>
    </div>

    <input type="hidden" name="{{ $name }}" :value="selectedIcon">
</div>
