@extends('layouts.app')

@section('title', 'Edit Category')
@section('breadcrumb', 'Categories / Edit')

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
        selectedIcon: '{{ old('icon', $category->icon ?? 'folder') }}',
        selectedColor: '{{ old('color', $category->color ?? '#6366f1') }}',
        showColorPicker: false,
        categoryName: '{{ old('name', $category->name ?? 'Category Name') }}'
    }">
        {{-- Page Header --}}
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                <a href="{{ url('/categories') }}" class="hover:text-foreground transition-colors">Categories</a>
                <i class="ph-bold ph-caret-right text-xs"></i>
                <span class="text-foreground">Edit</span>
            </div>
            <div class="mt-2 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold text-foreground sm:text-2xl">Edit Category</h1>
                    <p class="mt-1 text-sm text-muted-foreground">Update category information and settings.</p>
                </div>
                <a href="{{ url('/categories/' . ($category->id ?? 1)) }}" target="_blank"
                    class="inline-flex items-center gap-2 text-sm font-medium text-primary hover:underline">
                    <i class="ph-bold ph-eye"></i>
                    View on Site
                </a>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ url('/categories/' . ($category->id ?? 1)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">
                {{-- Main Content --}}
                <div class="space-y-4 sm:space-y-6 lg:col-span-2">
                    {{-- Basic Information --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10">
                                <i class="ph-bold ph-text-aa text-lg text-primary"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Basic Information</h3>
                                <p class="text-xs text-muted-foreground">Category name, URL and description</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            {{-- Category Name --}}
                            <div>
                                <label for="name" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-text-t text-muted-foreground"></i>
                                    Category Name <span class="text-destructive">*</span>
                                </label>
                                <input type="text" id="name" name="name" required
                                    x-model="categoryName"
                                    value="{{ old('name', $category->name ?? '') }}"
                                    placeholder="e.g., Technology, Sports, Business"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                            </div>

                            {{-- URL Slug --}}
                            <div>
                                <label for="slug" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-link text-muted-foreground"></i>
                                    URL Slug
                                </label>
                                <div class="flex items-stretch">
                                    <span class="inline-flex items-center rounded-l-xl border border-r-0 border-border bg-muted px-4 text-sm text-muted-foreground">
                                        /category/
                                    </span>
                                    <input type="text" id="slug" name="slug"
                                        value="{{ old('slug', $category->slug ?? '') }}"
                                        placeholder="auto-generated-from-name"
                                        class="flex-1 rounded-r-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                </div>
                            </div>

                            {{-- Description --}}
                            <div>
                                <label for="description" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-align-left text-muted-foreground"></i>
                                    Description
                                </label>
                                <textarea id="description" name="description" rows="3"
                                    placeholder="Brief description of this category..."
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none">{{ old('description', $category->description ?? '') }}</textarea>
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
                                            <p class="font-semibold text-foreground" x-text="categoryName || 'Category Name'"></p>
                                            <p class="text-xs text-muted-foreground">342 articles</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Icon Selection (Reusable Component) --}}
                            <x-icon-picker :selected-icon="old('icon', $category->icon ?? 'folder')" name="icon" />

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

                    {{-- SEO Settings --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10">
                                <i class="ph-bold ph-magnifying-glass text-lg text-info"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">SEO Settings</h3>
                                <p class="text-xs text-muted-foreground">Optimize for search engines</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            {{-- Meta Title --}}
                            <div>
                                <label for="meta_title" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-text-h-one text-muted-foreground"></i>
                                    Meta Title
                                </label>
                                <input type="text" id="meta_title" name="meta_title"
                                    value="{{ old('meta_title', $category->meta_title ?? '') }}"
                                    placeholder="SEO title for this category"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                            </div>

                            {{-- Meta Description --}}
                            <div>
                                <label for="meta_description" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-article text-muted-foreground"></i>
                                    Meta Description
                                </label>
                                <textarea id="meta_description" name="meta_description" rows="3"
                                    placeholder="SEO description for search engines..."
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
                            </div>

                            {{-- SEO Preview --}}
                            <div class="rounded-xl border border-border bg-background p-4">
                                <p class="mb-3 flex items-center gap-1 text-xs font-medium text-muted-foreground">
                                    <i class="ph-bold ph-google-logo"></i>
                                    Search Preview
                                </p>
                                <div class="space-y-1">
                                    <p class="text-base font-medium text-primary hover:underline cursor-pointer">{{ old('meta_title', $category->meta_title ?? 'Category Title') }}</p>
                                    <p class="text-xs text-success">https://yourdomain.com/category/{{ old('slug', $category->slug ?? 'category-slug') }}</p>
                                    <p class="text-sm text-muted-foreground line-clamp-2">{{ old('meta_description', $category->meta_description ?? 'Meta description preview...') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sub-Categories --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-warning/10">
                                    <i class="ph-bold ph-folder-open text-lg text-warning"></i>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-foreground sm:text-lg">Sub-Categories</h3>
                                    <p class="text-xs text-muted-foreground">8 sub-categories in this parent</p>
                                </div>
                            </div>
                            <a href="{{ url('/categories/sub-categories/create?parent=' . ($category->id ?? 1)) }}"
                                class="inline-flex items-center gap-1 rounded-lg bg-primary/10 px-3 py-1.5 text-xs font-medium text-primary transition-colors hover:bg-primary/20">
                                <i class="ph-bold ph-plus"></i>
                                Add New
                            </a>
                        </div>

                        {{-- Example sub-categories list (replace with your dynamic data as needed) --}}
                        <div class="space-y-2">
                            <div class="flex items-center justify-between rounded-xl bg-muted/30 p-3 transition-colors hover:bg-muted/50">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10">
                                        <i class="ph-bold ph-device-mobile text-sm text-primary"></i>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-foreground">Mobile</span>
                                        <span class="ml-2 text-xs text-muted-foreground">45 articles</span>
                                    </div>
                                </div>
                                <a href="{{ url('/categories/sub-categories/1/edit') }}" class="rounded-lg p-1.5 text-muted-foreground hover:bg-muted hover:text-foreground">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                            </div>
                            <!-- Add more sub-categories as needed -->
                        </div>

                        <a href="{{ url('/categories?parent=' . ($category->id ?? 1)) }}"
                            class="mt-4 flex items-center justify-center gap-1 text-xs font-medium text-primary hover:underline">
                            View all sub-categories
                            <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-4 sm:space-y-6 lg:sticky lg:top-4 lg:self-start">
                    {{-- Publish Settings --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-success/10">
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
                                <label for="status" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-toggle-left text-muted-foreground"></i>
                                    Status
                                </label>
                                <select id="status" name="status"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                    <option value="active" {{ old('status', $category->status ?? '') === 'active' ? 'selected' : '' }}>✅ Active</option>
                                    <option value="inactive" {{ old('status', $category->status ?? '') === 'inactive' ? 'selected' : '' }}>⏸️ Inactive</option>
                                </select>
                            </div>

                            {{-- Display Order --}}
                            <div>
                                <label for="order" class="mb-1.5 flex items-center gap-1 text-sm font-medium text-foreground">
                                    <i class="ph-bold ph-sort-ascending text-muted-foreground"></i>
                                    Display Order
                                </label>
                                <input type="number" id="order" name="order" value="{{ old('order', $category->order ?? 0) }}" min="0"
                                    class="w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-6 flex flex-col gap-2">
                            <button type="submit"
                                class="group w-full rounded-xl bg-primary px-4 py-3 text-sm font-medium text-primary-foreground transition-all duration-200 hover:bg-primary/90 hover:shadow-lg hover:shadow-primary/25 active:scale-[0.98]">
                                <i class="ph-bold ph-check mr-2 transition-transform group-hover:scale-110"></i>
                                Update Category
                            </button>
                            <a href="{{ url('/categories') }}"
                                class="group w-full rounded-xl border border-border bg-card px-4 py-3 text-center text-sm font-medium text-foreground transition-all duration-200 hover:bg-muted active:scale-[0.98]">
                                <i class="ph-bold ph-x mr-2"></i>
                                Cancel
                            </a>
                        </div>
                    </div>

                    {{-- Category Stats --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-info/10">
                                <i class="ph-bold ph-chart-bar text-lg text-info"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Statistics</h3>
                                <p class="text-xs text-muted-foreground">Category performance</p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <i class="ph-bold ph-article text-primary"></i>
                                    Total Articles
                                </span>
                                <span class="text-sm font-bold text-foreground">342</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <i class="ph-bold ph-folder-open text-accent"></i>
                                    Sub-Categories
                                </span>
                                <span class="text-sm font-bold text-foreground">8</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <i class="ph-bold ph-eye text-info"></i>
                                    Total Views
                                </span>
                                <span class="text-sm font-bold text-foreground">45.2K</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-muted/30 p-3">
                                <span class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <i class="ph-bold ph-calendar-plus text-success"></i>
                                    Created
                                </span>
                                <span class="text-sm font-bold text-foreground">Jan 15, 2025</span>
                            </div>
                        </div>
                    </div>

                    {{-- Featured Image --}}
                    <div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10">
                                <i class="ph-bold ph-image text-lg text-accent"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-foreground sm:text-lg">Featured Image</h3>
                                <p class="text-xs text-muted-foreground">Category cover image</p>
                            </div>
                        </div>

                        <div class="mb-4 overflow-hidden rounded-xl border border-border">
                            <img src="{{ $category->featured_image ?? 'https://placehold.co/400x200/6366f1/FFFFFF?text=Category' }}"
                                alt="{{ $category->name ?? 'Category' }}"
                                class="h-32 w-full object-cover transition-transform duration-300 hover:scale-105">
                        </div>

                        <label class="group flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-border p-4 transition-all duration-200 hover:border-primary/50 hover:bg-muted/30">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-muted transition-transform duration-200 group-hover:scale-110">
                                <i class="ph-bold ph-swap text-xl text-muted-foreground group-hover:text-primary"></i>
                            </div>
                            <p class="mt-2 text-sm font-medium text-foreground">Replace Image</p>
                            <p class="mt-1 text-xs text-muted-foreground">or drag and drop</p>
                            <span class="mt-2 rounded-full bg-muted px-3 py-1 text-xs text-muted-foreground">
                                PNG, JPG up to 2MB
                            </span>
                            <input type="file" name="featured_image" class="hidden" accept="image/*">
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
