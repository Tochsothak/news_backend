<div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
    {{-- Widget Header --}}
    <div class="mb-4 flex items-center gap-3">
        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-success/10">
            <i class="ph-bold ph-paper-plane-tilt text-lg text-success"></i>
        </div>
        <div>
            <h3 class="text-base font-semibold text-foreground sm:text-lg">Publish</h3>
            <p class="text-xs text-muted-foreground">Configure visibility and timing</p>
        </div>
    </div>

    <div class="space-y-5">
        {{-- Status --}}
        <div>
            <label class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                <i class="ph-bold ph-toggle-left text-muted-foreground"></i>
                Status
            </label>
            <select name="status" class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all appearance-none cursor-pointer">
                <option value="published">🟢 Published</option>
                <option value="draft" selected>📝 Draft</option>
                <option value="scheduled">📅 Scheduled</option>
            </select>
        </div>

        {{-- Publish Date --}}
        <div>
            <label class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                <i class="ph-bold ph-calendar-blank text-muted-foreground"></i>
                Publish Date
            </label>
            <input type="datetime-local" name="published_at" class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
        </div>

        {{-- Author --}}
        <div>
            <label class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                <i class="ph-bold ph-user text-muted-foreground"></i>
                Author
            </label>
            <select name="author_id" class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all appearance-none cursor-pointer">
                <option value="1" selected>Haru Malik</option>
                <option value="2">Jane Doe</option>
            </select>
        </div>
    </div>
</div>
