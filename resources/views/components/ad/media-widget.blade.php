<div class="rounded-xl border border-border bg-card shadow-sm overflow-hidden p-6" x-data="{
    desktopPreview: null,
    desktopType: null,
    mobilePreview: null,
    mobileType: null,

    handleFile(event, type) {
        const file = event.target.files[0];
        if (!file) return;

        const isVideo = file.type.startsWith('video/');

        if (type === 'desktop') {
            this.desktopType = isVideo ? 'video' : 'image';
        } else {
            this.mobileType = isVideo ? 'video' : 'image';
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            if (type === 'desktop') {
                this.desktopPreview = e.target.result;
            } else {
                this.mobilePreview = e.target.result;
            }
        };
        reader.readAsDataURL(file);
    },

    removeMedia(type) {
        if (type === 'desktop') {
            this.desktopPreview = null;
            this.desktopType = null;
            this.$refs.desktopInput.value = '';
        } else {
            this.mobilePreview = null;
            this.mobileType = null;
            this.$refs.mobileInput.value = '';
        }
    }
}">
    <div class="flex items-center justify-between mb-4 border-b border-border pb-4">
        <div>
            <h2 class="text-lg font-semibold text-foreground">Ad Media Creatives</h2>
            <p class="text-sm text-muted-foreground mt-1">Upload separate creatives for desktop and mobile devices.</p>
        </div>
        <div class="flex flex-col items-end gap-1.5 mt-1">
            <span class="text-xs font-medium bg-muted px-2 py-1 rounded text-muted-foreground">JPG, PNG, Webp, GIF, MP4</span>
            <span class="text-[10px] font-medium text-primary flex items-center gap-1">
                <i class="ph-bold ph-star text-primary"></i>
                JPG & Webp recommended
            </span>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- ========================================== --}}
        {{-- DESKTOP MEDIA UPLOAD --}}
        {{-- ========================================== --}}
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <label class="block text-sm font-semibold text-foreground">Desktop / Tablet</label>
                <span class="text-xs text-muted-foreground font-medium">970x250 px or 728x90 px</span>
            </div>

            {{-- Upload Area (Hidden when media is selected) --}}
            <div x-show="!desktopPreview" class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-border bg-background/50 py-10 transition-colors hover:bg-muted/50 h-[220px]">
                <input type="file" name="media_desktop" x-ref="desktopInput" @change="handleFile($event, 'desktop')" accept="image/*,video/mp4" class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0" required>
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary mb-3">
                    <i class="ph-bold ph-desktop text-2xl"></i>
                </div>
                <h3 class="text-sm font-semibold text-foreground">Upload Desktop Ad</h3>
                <p class="mt-1 text-xs text-muted-foreground">Max: 5MB (Img) / 20MB (Vid)</p>
            </div>

            {{-- Preview Area (Visible when media is selected) --}}
            <div x-show="desktopPreview" x-cloak class="relative rounded-xl border border-border bg-background p-2 flex items-center justify-center overflow-hidden group h-[220px]">

                <template x-if="desktopType === 'image'">
                    <img :src="desktopPreview" alt="Desktop Ad Preview" class="max-w-full max-h-full object-contain rounded-lg">
                </template>

                <template x-if="desktopType === 'video'">
                    <video :src="desktopPreview" controls class="max-w-full max-h-full rounded-lg"></video>
                </template>

                <button type="button" @click="removeMedia('desktop')" class="absolute top-2 right-2 flex h-8 w-8 items-center justify-center rounded-full bg-destructive text-destructive-foreground opacity-0 group-hover:opacity-100 transition-opacity shadow-md hover:scale-105" title="Remove Desktop Media">
                    <i class="ph-bold ph-trash"></i>
                </button>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- MOBILE MEDIA UPLOAD --}}
        {{-- ========================================== --}}
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <label class="block text-sm font-semibold text-foreground">Smartphone</label>
                <span class="text-xs text-muted-foreground font-medium">300x250 px or 320x50 px</span>
            </div>

            {{-- Upload Area (Hidden when media is selected) --}}
            <div x-show="!mobilePreview" class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-border bg-background/50 py-10 transition-colors hover:bg-muted/50 h-[220px]">
                <input type="file" name="media_mobile" x-ref="mobileInput" @change="handleFile($event, 'mobile')" accept="image/*,video/mp4" class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0" required>
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-accent/10 text-accent mb-3">
                    <i class="ph-bold ph-device-mobile text-2xl"></i>
                </div>
                <h3 class="text-sm font-semibold text-foreground">Upload Mobile Ad</h3>
                <p class="mt-1 text-xs text-muted-foreground">Max: 5MB (Img) / 20MB (Vid)</p>
            </div>

            {{-- Preview Area (Visible when media is selected) --}}
            <div x-show="mobilePreview" x-cloak class="relative rounded-xl border border-border bg-background p-2 flex items-center justify-center overflow-hidden group h-[220px]">

                <template x-if="mobileType === 'image'">
                    <img :src="mobilePreview" alt="Mobile Ad Preview" class="max-w-full max-h-full object-contain rounded-lg">
                </template>

                <template x-if="mobileType === 'video'">
                    <video :src="mobilePreview" controls class="max-w-full max-h-full rounded-lg"></video>
                </template>

                <button type="button" @click="removeMedia('mobile')" class="absolute top-2 right-2 flex h-8 w-8 items-center justify-center rounded-full bg-destructive text-destructive-foreground opacity-0 group-hover:opacity-100 transition-opacity shadow-md hover:scale-105" title="Remove Mobile Media">
                    <i class="ph-bold ph-trash"></i>
                </button>
            </div>
        </div>

    </div>
</div>
