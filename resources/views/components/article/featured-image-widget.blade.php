<div class="rounded-xl border border-border bg-card p-4 sm:p-6 shadow-sm"
     x-data="{
        imagePreview: null,
        fileChosen(event) {
            const file = event.target.files[0];
            if (file) {
                this.imagePreview = URL.createObjectURL(file);
            }
        },
        removeImage() {
            this.imagePreview = null;
            this.$refs.fileInput.value = '';
        }
     }">

    {{-- Widget Header --}}
    <div class="mb-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-primary/10">
                <i class="ph-bold ph-image text-lg text-primary"></i>
            </div>
            <div>
                <h3 class="text-base font-semibold text-foreground sm:text-lg">Featured Image</h3>
                <p class="text-xs text-muted-foreground">Upload the article cover photo</p>
            </div>
        </div>

        {{-- Clear Image Button (Shows only when image is selected) --}}
        <button type="button" x-show="imagePreview" @click="removeImage" class="text-xs text-destructive hover:underline font-medium transition-all" style="display: none;">
            Remove
        </button>
    </div>

    {{-- Upload Area / Preview Area --}}
    <div class="mt-4 relative w-full overflow-hidden rounded-xl border-2 border-dashed border-border/60 bg-muted/20 transition-all group"
         :class="imagePreview ? 'border-transparent p-0' : 'hover:border-primary/50 hover:bg-muted/40 p-6 py-8'">

        {{-- State 1: Empty (Upload Prompt) --}}
        <label for="file-upload" x-show="!imagePreview" class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-background border border-border shadow-sm group-hover:scale-110 transition-transform duration-200">
                <i class="ph-bold ph-upload-simple text-2xl text-muted-foreground group-hover:text-primary transition-colors"></i>
            </div>
            <div class="mt-4 flex flex-col sm:flex-row items-center justify-center gap-1 text-sm leading-6 text-muted-foreground">
                <span class="relative font-semibold text-primary focus-within:outline-none hover:text-primary/80 transition-colors">
                    Click to upload
                </span>
                <p>or drag and drop</p>
            </div>
            <p class="text-xs leading-5 text-muted-foreground mt-2">PNG, JPG or WEBP up to 5MB</p>
        </label>

        {{-- State 2: Image Preview --}}
        <div x-show="imagePreview" class="relative w-full aspect-video bg-black/5 flex items-center justify-center" style="display: none;">
            <img :src="imagePreview" class="object-cover w-full h-full rounded-xl" alt="Preview" />

            {{-- Hover Overlay to Change Image --}}
            <label for="file-upload" class="absolute inset-0 bg-background/60 backdrop-blur-sm opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer rounded-xl">
                <span class="flex items-center gap-2 bg-card px-4 py-2 rounded-lg font-medium shadow-sm border border-border text-foreground hover:bg-muted transition-colors">
                    <i class="ph-bold ph-arrows-clockwise"></i> Change Image
                </span>
            </label>
        </div>

        {{-- Hidden File Input --}}
        <input id="file-upload" x-ref="fileInput" name="featured_image" @change="fileChosen" type="file" class="sr-only" accept="image/*">
    </div>
</div>
