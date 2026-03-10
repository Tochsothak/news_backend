<div class="rounded-xl border border-border bg-card shadow-sm overflow-hidden">
    <div class="border-b border-border p-4">
        <h3 class="font-semibold text-foreground">Status & Schedule</h3>
    </div>
    <div class="p-4 space-y-4">
        <div>
            <select name="status" x-model="status" class="w-full rounded-lg border border-border bg-background px-3 py-2 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                <option value="active">Active (Run Immediately)</option>
                <option value="scheduled">Scheduled (Set Dates)</option>
                <option value="inactive">Inactive (Paused)</option>
            </select>
        </div>

        {{-- Date Pickers (Only visible if scheduled) --}}
        <div x-show="status === 'scheduled'" x-collapse class="space-y-3 pt-2">
            <div>
                <label class="block text-xs font-medium text-muted-foreground mb-1">Start Date & Time</label>
                <input type="datetime-local" name="start_date" class="w-full rounded-lg border border-border bg-background px-3 py-2 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div>
                <label class="block text-xs font-medium text-muted-foreground mb-1">End Date & Time</label>
                <input type="datetime-local" name="end_date" class="w-full rounded-lg border border-border bg-background px-3 py-2 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
        </div>
    </div>
</div>
