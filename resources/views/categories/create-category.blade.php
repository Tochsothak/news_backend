@extends('layouts.app')

@section('title', 'Create Category')
@section('breadcrumb', 'Categories / Create')

@section('content')
    @php
        $colorPalette = [
            '#6366f1', '#8b5cf6', '#a855f7', '#d946ef', '#ec4899', '#f43f5e',
            '#ef4444', '#f97316', '#f59e0b', '#eab308', '#84cc16', '#22c55e',
            '#10b981', '#14b8a6', '#06b6d4', '#0ea5e9', '#3b82f6', '#1d4ed8',
            '#64748b', '#475569', '#334155', '#1e293b', '#0f172a', '#000000',
        ];
    @endphp

    <div x-data="{
        selectedIcon: 'cpu',
        selectedColor: '#6366f1',
        showColorPicker: false
    }">
        {{-- Page Header --}}
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                <a href="{{ url('/categories') }}" class="transition-colors hover:text-foreground">
                    <i class="ph-bold ph-folders"></i>
                    Categories
                </a>
                <i class="ph-bold ph-caret-right text-xs"></i>
                <span class="text-foreground">Create</span>
            </div>
            <div class="mt-2 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold text-foreground sm:text-2xl">Create Category</h1>
                    <p class="mt-1 text-sm text-muted-foreground">Add a new parent category to organize your content.</p>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ url('/categories') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">
                {{-- Main Content --}}
                <div class="space-y-4 sm:space-y-6 lg:col-span-2">
                    {{-- Basic Information --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary/10">
                                <i class="ph-bold ph-info text-lg text-primary"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Basic Information</h3>
                                <p class="text-xs text-muted-foreground">Enter the category details</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            {{-- Category Name --}}
                            <div>
                                <label for="name" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-text-aa text-muted-foreground"></i>
                                    Category Name
                                    <span class="text-destructive">*</span>
                                </label>
                                <input type="text" id="name" name="name" required
                                    placeholder="e.g., Technology, Sports, Business"
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                            </div>

                            {{-- Slug --}}
                            <div>
                                <label for="slug" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-link text-muted-foreground"></i>
                                    URL Slug
                                </label>
                                <div class="flex overflow-hidden rounded-lg border border-border focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all">
                                    <span class="flex items-center bg-muted px-3 text-sm text-muted-foreground border-r border-border">
                                        /category/
                                    </span>
                                    <input type="text" id="slug" name="slug"
                                        placeholder="auto-generated-from-name"
                                        class="flex-1 bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:outline-none">
                                </div>
                                <p class="mt-1.5 text-xs text-muted-foreground">
                                    <i class="ph-bold ph-magic-wand text-accent"></i>
                                    Leave empty to auto-generate from name.
                                </p>
                            </div>

                            {{-- Description --}}
                            <div>
                                <label for="description" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-align-left text-muted-foreground"></i>
                                    Description
                                </label>
                                <textarea id="description" name="description" rows="3"
                                    placeholder="Brief description of this category..."
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Appearance --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-accent/10">
                                <i class="ph-bold ph-palette text-lg text-accent"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Appearance</h3>
                                <p class="text-xs text-muted-foreground">Choose icon and color for this category</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            {{-- Live Preview --}}
                            <div class="flex items-center justify-center rounded-lg border border-dashed border-border bg-muted/30 p-6">
                                <div class="flex flex-col items-center gap-3">
                                    <p class="text-xs font-medium text-muted-foreground uppercase tracking-wider">Preview</p>
                                    <div class="flex items-center gap-3 rounded-xl bg-card border border-border p-4 shadow-sm">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-xl transition-colors"
                                            :style="'background-color: ' + selectedColor + '15; color: ' + selectedColor">
                                            <i class="ph-bold text-2xl" :class="'ph-' + selectedIcon"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-foreground">Category Name</p>
                                            <p class="text-xs text-muted-foreground">12 sub-categories</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Icon Selection (Reusable Component) --}}
                            <x-icon-picker selected-icon="cpu" name="icon" />

                            {{-- Color Selection --}}
                            <div>
                                <label class="mb-3 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-paint-bucket text-muted-foreground"></i>
                                    Icon Color
                                </label>

                                <div class="space-y-4">
                                    {{-- Selected Color Display --}}
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <button type="button"
                                                @click="showColorPicker = !showColorPicker"
                                                class="flex h-14 w-14 items-center justify-center rounded-xl border-2 border-border shadow-sm transition-all hover:scale-105 hover:shadow-md"
                                                :style="'background-color: ' + selectedColor">
                                                <i class="ph-bold ph-eyedropper text-white text-xl drop-shadow"></i>
                                            </button>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-foreground">Selected Color</p>
                                            <div class="mt-1 flex items-center gap-2">
                                                <input type="text"
                                                    x-model="selectedColor"
                                                    class="w-24 rounded-lg border border-border bg-background px-3 py-1.5 text-sm font-mono text-foreground uppercase focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                                <input type="color"
                                                    x-model="selectedColor"
                                                    class="h-8 w-8 cursor-pointer rounded-lg border border-border">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Quick Select Colors --}}
                                    <div>
                                        <p class="mb-2 text-xs font-medium text-muted-foreground uppercase tracking-wider">Quick Select</p>
                                        <div class="flex flex-wrap gap-2 rounded-xl border border-border bg-muted/30 p-3">
                                            @foreach($colorPalette as $color)
                                                <button type="button" @click="selectedColor = '{{ $color }}'"
                                                    class="relative size-8 shrink-0 rounded-lg transition-all duration-200 hover:scale-110 hover:shadow-md"
                                                    style="background-color: {{ $color }}"
                                                    :class="selectedColor === '{{ $color }}' ? 'ring-2 ring-offset-2 ring-offset-card ring-foreground scale-110' : ''">
                                                    <span x-show="selectedColor === '{{ $color }}'" class="absolute inset-0 flex items-center justify-center text-white">
                                                        <i class="ph-bold ph-check text-sm drop-shadow"></i>
                                                    </span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Custom Color Picker --}}
                                    <div x-show="showColorPicker" x-collapse>
                                        <div class="flex items-center gap-3 rounded-xl border border-border bg-card p-3">
                                            <i class="ph-bold ph-palette text-muted-foreground"></i>
                                            <span class="text-sm text-muted-foreground">Custom:</span>
                                            <input type="color"
                                                x-model="selectedColor"
                                                class="h-10 w-full cursor-pointer rounded-lg border-0 bg-transparent">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="color" :value="selectedColor">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:sticky lg:top-4 lg:self-start space-y-4 sm:space-y-6">
                    {{-- Publish Settings --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-success/10">
                                <i class="ph-bold ph-paper-plane-tilt text-lg text-success"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Publish</h3>
                                <p class="text-xs text-muted-foreground">Configure visibility</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            {{-- Status --}}
                            <div>
                                <label for="status" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-eye text-muted-foreground"></i>
                                    Status
                                </label>
                                <select id="status" name="status"
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                                    <option value="active">✅ Active</option>
                                    <option value="inactive">⏸️ Inactive</option>
                                </select>
                            </div>

                            {{-- Display Order --}}
                            <div>
                                <label for="order" class="mb-2 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-sort-ascending text-muted-foreground"></i>
                                    Display Order
                                </label>
                                <input type="number" id="order" name="order" value="0" min="0"
                                    class="w-full rounded-lg border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-6 space-y-3">
                            <button type="submit"
                                class="group w-full rounded-lg bg-primary px-4 py-3 text-sm font-medium text-primary-foreground transition-all hover:bg-primary/90 hover:shadow-lg hover:shadow-primary/25 active:scale-[0.98]">
                                <i class="ph-bold ph-check mr-2 transition-transform group-hover:scale-110"></i>
                                Create Category
                            </button>
                            <a href="{{ url('/categories') }}"
                                class="flex w-full items-center justify-center rounded-lg border border-border bg-card px-4 py-3 text-sm font-medium text-foreground transition-all hover:bg-muted active:scale-[0.98]">
                                <i class="ph-bold ph-x mr-2"></i>
                                Cancel
                            </a>
                        </div>
                    </div>

                    {{-- Quick Links --}}
                    <div class="rounded-xl border border-accent/30 bg-accent/5 p-4">
                        <p class="mb-3 text-sm font-medium text-foreground">Quick Links</p>
                        <div class="space-y-2">
                            <a href="{{ url('/categories') }}"
                                class="flex items-center gap-2 text-xs text-muted-foreground hover:text-foreground transition-colors">
                                <i class="ph-bold ph-folders"></i>
                                View All Categories
                            </a>
                            <a href="{{ url('/categories/sub-categories/create') }}"
                                class="flex items-center gap-2 text-xs text-muted-foreground hover:text-foreground transition-colors">
                                <i class="ph-bold ph-folder-plus"></i>
                                Create Sub-Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
