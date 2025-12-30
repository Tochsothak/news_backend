@extends('layouts.app')

@section('title', 'Edit Sub-Category')
@section('breadcrumb', 'Categories / Sub-Categories / Edit')

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
        selectedIcon: '{{ old('icon', 'device-mobile') }}',
        selectedColor: '{{ old('color', '#6366f1') }}',
        showColorPicker: false,
        subCategoryName: '{{ old('name', 'Mobile') }}',
        parentCategory: '{{ old('parent_id', '1') }}'
    }">
        {{-- Page Header --}}
        <div class="mb-4 flex flex-col gap-4 sm:mb-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-muted-foreground">
                    <a href="{{ url('/categories') }}" class="hover:text-foreground transition-colors">
                        <i class="ph-bold ph-folders"></i>
                        Categories
                    </a>
                    <i class="ph-bold ph-caret-right text-xs"></i>
                    <span class="text-foreground">Edit Sub-Category</span>
                </div>
                <h1 class="mt-2 text-xl font-bold text-foreground sm:text-2xl">Edit Sub-Category</h1>
                <p class="mt-1 text-sm text-muted-foreground">Update sub-category information and settings.</p>
            </div>

            <a href="{{ url('/categories/sub-categories/' . ($id ?? 1)) }}" target="_blank"
                class="inline-flex items-center gap-2 text-sm font-medium text-primary hover:underline">
                <i class="ph-bold ph-eye"></i>
                View on Site
            </a>
        </div>

        {{-- Form --}}
        <form action="{{ url('/categories/sub-categories/' . ($id ?? 1)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">
                {{-- Main Content --}}
                <div class="space-y-4 sm:space-y-6 lg:col-span-2">

                    {{-- Parent Category Section --}}
                    <div class="rounded-xl border-2 border-primary/20 bg-primary/5 p-4 sm:p-6">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10">
                                <i class="ph-bold ph-tree-structure text-lg text-primary"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <h2 class="text-base font-semibold text-foreground sm:text-lg">Parent Category</h2>
                                    <span class="rounded-full bg-primary/10 px-2 py-0.5 text-xs font-medium text-primary">Required</span>
                                </div>
                                <p class="text-xs text-muted-foreground">This sub-category belongs to</p>
                            </div>
                        </div>

                        {{-- Current Parent Display (UI only) --}}
                        <div class="mb-4 flex items-center gap-3 rounded-lg border border-border bg-card p-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                <i class="ph-bold ph-cpu text-lg text-primary"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-foreground">Technology</p>
                                <p class="text-xs text-muted-foreground">Current parent category</p>
                            </div>
                            <span class="rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">Active</span>
                        </div>

                        {{-- Parent Category Select (UI only - no $parentCategories) --}}
                        <div>
                            <label class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                <i class="ph-bold ph-folders text-muted-foreground"></i>
                                Change Parent Category
                            </label>
                            <select name="parent_id" x-model="parentCategory"
                                class="w-full rounded-lg border border-primary/30 bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                                <option value="1">📁 Technology</option>
                                <option value="2">📁 Sports</option>
                                <option value="3">📁 Business</option>
                                <option value="4">📁 Entertainment</option>
                                <option value="5">📁 World News</option>
                                <option value="6">📁 Health</option>
                                <option value="7">📁 Education</option>
                                <option value="8">📁 Lifestyle</option>
                            </select>
                        </div>
                    </div>

                    {{-- Sub-Category Details --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10">
                                <i class="ph-bold ph-info text-lg text-info"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-semibold text-foreground sm:text-lg">Sub-Category Details</h2>
                                <p class="text-xs text-muted-foreground">Basic information about this sub-category</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            {{-- Sub-Category Name --}}
                            <div>
                                <label class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-text-aa text-muted-foreground"></i>
                                    Sub-Category Name <span class="text-destructive">*</span>
                                </label>
                                <input type="text" name="name" x-model="subCategoryName" required
                                    value="{{ old('name', 'Mobile') }}"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all"
                                    placeholder="e.g., Mobile, AI & ML, Football">
                            </div>

                            {{-- URL Slug --}}
                            <div>
                                <label class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-link text-muted-foreground"></i>
                                    URL Slug
                                </label>
                                <div class="flex items-stretch">
                                    <span class="inline-flex items-center rounded-l-xl border border-r-0 border-border bg-muted px-4 text-sm text-muted-foreground">
                                        /category/technology/
                                    </span>
                                    <input type="text" name="slug" value="{{ old('slug', 'mobile') }}"
                                        class="flex-1 rounded-r-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all"
                                        placeholder="auto-generated-from-name">
                                </div>
                                <p class="mt-1.5 text-xs text-muted-foreground">
                                    <i class="ph-bold ph-magic-wand text-accent"></i>
                                    Leave empty to auto-generate from name.
                                </p>
                            </div>

                            {{-- Description --}}
                            <div>
                                <label class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-align-left text-muted-foreground"></i>
                                    Description
                                </label>
                                <textarea name="description" rows="3"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all resize-none"
                                    placeholder="Brief description of this sub-category...">{{ old('description', 'Latest mobile technology news, smartphone reviews, and app updates.') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Appearance Section --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-accent/10">
                                <i class="ph-bold ph-palette text-lg text-accent"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Appearance</h3>
                                <p class="text-xs text-muted-foreground">Choose icon and color for this sub-category</p>
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
                                            <p class="font-semibold text-foreground" x-text="subCategoryName || 'Sub-Category Name'"></p>
                                            <p class="text-xs text-muted-foreground">45 articles</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ✅ Icon Selection (Reusable Component) --}}
                            <x-icon-picker :selected-icon="old('icon', 'device-mobile')" name="icon" />

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

                    {{-- Statistics Card (UI only) --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-success/10">
                                <i class="ph-bold ph-chart-bar text-lg text-success"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-semibold text-foreground sm:text-lg">Statistics</h2>
                                <p class="text-xs text-muted-foreground">Sub-category performance data</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                            <div class="rounded-lg border border-border bg-muted/30 p-3 text-center">
                                <p class="text-2xl font-bold text-foreground">45</p>
                                <p class="text-xs text-muted-foreground">Articles</p>
                            </div>
                            <div class="rounded-lg border border-border bg-muted/30 p-3 text-center">
                                <p class="text-2xl font-bold text-foreground">12.5K</p>
                                <p class="text-xs text-muted-foreground">Views</p>
                            </div>
                            <div class="rounded-lg border border-border bg-muted/30 p-3 text-center">
                                <p class="text-2xl font-bold text-foreground">89</p>
                                <p class="text-xs text-muted-foreground">Comments</p>
                            </div>
                            <div class="rounded-lg border border-border bg-muted/30 p-3 text-center">
                                <p class="text-2xl font-bold text-foreground">4.2</p>
                                <p class="text-xs text-muted-foreground">Avg. Rating</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-4 sm:space-y-6 lg:sticky lg:top-4 lg:self-start">
                    {{-- Publish Card --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-success/10">
                                <i class="ph-bold ph-paper-plane-tilt text-lg text-success"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-semibold text-foreground sm:text-lg">Publish</h2>
                                <p class="text-xs text-muted-foreground">Configure visibility</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            {{-- Status --}}
                            <div>
                                <label class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-eye text-muted-foreground"></i>
                                    Status
                                </label>
                                <select name="status"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>✅ Active</option>
                                    <option value="inactive" {{ old('status', '') === 'inactive' ? 'selected' : '' }}>⏸️ Inactive</option>
                                </select>
                            </div>

                            {{-- Display Order --}}
                            <div>
                                <label class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-sort-ascending text-muted-foreground"></i>
                                    Display Order
                                </label>
                                <input type="number" name="order" value="{{ old('order', 1) }}" min="0"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                            </div>

                            {{-- Action Buttons --}}
                            <div class="mt-6 space-y-3">
                                <button type="submit"
                                    class="group w-full rounded-xl bg-primary px-4 py-3 text-sm font-medium text-primary-foreground transition-all hover:bg-primary/90 hover:shadow-lg hover:shadow-primary/25 active:scale-[0.98]">
                                    <i class="ph-bold ph-check mr-2 transition-transform group-hover:scale-110"></i>
                                    Update Sub-Category
                                </button>
                                <a href="{{ url('/categories') }}"
                                    class="flex w-full items-center justify-center rounded-xl border border-border bg-card px-4 py-3 text-sm font-medium text-foreground transition-all hover:bg-muted active:scale-[0.98]">
                                    <i class="ph-bold ph-x mr-2"></i>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Metadata Card (UI only) --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-muted">
                                <i class="ph-bold ph-clock text-lg text-muted-foreground"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-semibold text-foreground sm:text-lg">Metadata</h2>
                                <p class="text-xs text-muted-foreground">Sub-category information</p>
                            </div>
                        </div>

                        <div class="space-y-3 text-sm">
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="text-muted-foreground">Created</span>
                                <span class="font-medium text-foreground">Dec 10, 2025</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="text-muted-foreground">Last Updated</span>
                                <span class="font-medium text-foreground">Dec 28, 2025</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="text-muted-foreground">Created By</span>
                                <span class="font-medium text-foreground">Admin User</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="text-muted-foreground">ID</span>
                                <span class="font-mono text-xs text-muted-foreground">#{{ $id ?? 1 }}</span>
                            </div>
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
                            <a href="{{ url('/categories/create') }}"
                                class="flex items-center gap-2 text-xs text-muted-foreground hover:text-foreground transition-colors">
                                <i class="ph-bold ph-plus-circle"></i>
                                Create Parent Category
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
