<div class="flex flex-col relative resize-y overflow-hidden border-t border-border/40"
     style="min-height: 400px; height: 600px;"
     x-data="setupEditor($el.closest('form').querySelector('[name=old_content]')?.value || '')"
     x-init="init($refs.editorArea, $refs.bubbleMenu)">

    {{-- Toolbar: Cleaned up background to blend with the document card --}}
    <div class="border-b border-border/40 bg-transparent relative z-20 shrink-0">
        <div class="flex items-center gap-1 px-4 sm:px-8 py-3 overflow-x-auto flex-nowrap hide-scrollbar">

            {{-- History --}}
            <div class="flex shrink-0 gap-0.5">
                <button type="button" @click="editor.chain().focus().undo().run()" :disabled="!editor?.can().undo()" class="flex h-8 w-8 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground disabled:opacity-30"><i class="ph ph-arrow-u-up-left text-lg"></i></button>
                <button type="button" @click="editor.chain().focus().redo().run()" :disabled="!editor?.can().redo()" class="flex h-8 w-8 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground disabled:opacity-30"><i class="ph ph-arrow-u-up-right text-lg"></i></button>
            </div>

            <div class="mx-2 h-5 w-px shrink-0 bg-border/60"></div>

            {{-- Headings Dropdown (FIXED POS) --}}
            <div class="relative shrink-0" x-data="{ open: false, top: 0, left: 0 }">
                <button type="button"
                        @click="let rect = $event.currentTarget.getBoundingClientRect(); top = rect.bottom + 4; left = rect.left; open = !open;"
                        @click.away="open = false"
                        class="flex h-8 items-center gap-1 rounded px-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"
                        :class="{ 'bg-muted text-foreground': isActive('heading') || open }">
                    <span class="font-medium text-sm">H</span><i class="ph-bold ph-caret-down text-[10px] opacity-70"></i>
                </button>
                <div x-show="open" x-transition.opacity style="display: none;"
                     class="fixed z-[100] w-44 rounded-lg border border-border bg-card p-1.5 shadow-xl font-medium"
                     :style="`top: ${top}px; left: ${left}px;`">
                    <button type="button" @click="editor.chain().focus().setParagraph().run(); open = false" :class="{ 'bg-muted text-foreground': isActive('paragraph') }" class="flex w-full items-center rounded-md px-3 py-1.5 text-sm text-muted-foreground hover:bg-muted hover:text-foreground transition-colors">Paragraph</button>
                    <button type="button" @click="toggleHeading(1); open = false" :class="{ 'bg-muted text-foreground': isActive('heading', { level: 1 }) }" class="flex w-full items-center gap-3 rounded-md px-3 py-1.5 text-sm text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"><span class="font-bold text-foreground">H1</span> Heading 1</button>
                    <button type="button" @click="toggleHeading(2); open = false" :class="{ 'bg-muted text-foreground': isActive('heading', { level: 2 }) }" class="flex w-full items-center gap-3 rounded-md px-3 py-1.5 text-sm text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"><span class="font-bold text-foreground">H2</span> Heading 2</button>
                    <button type="button" @click="toggleHeading(3); open = false" :class="{ 'bg-muted text-foreground': isActive('heading', { level: 3 }) }" class="flex w-full items-center gap-3 rounded-md px-3 py-1.5 text-sm text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"><span class="font-bold text-foreground">H3</span> Heading 3</button>
                    <button type="button" @click="toggleHeading(4); open = false" :class="{ 'bg-muted text-foreground': isActive('heading', { level: 4 }) }" class="flex w-full items-center gap-3 rounded-md px-3 py-1.5 text-sm text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"><span class="font-bold text-foreground">H4</span> Heading 4</button>
                </div>
            </div>

            {{-- Lists Dropdown (FIXED POS) --}}
            <div class="relative shrink-0" x-data="{ open: false, top: 0, left: 0 }">
                <button type="button"
                        @click="let rect = $event.currentTarget.getBoundingClientRect(); top = rect.bottom + 4; left = rect.left; open = !open;"
                        @click.away="open = false"
                        class="flex h-8 items-center gap-1 rounded px-2 text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"
                        :class="{ 'bg-muted text-foreground': isActive('bulletList') || isActive('orderedList') || isActive('taskList') || open }">
                    <i class="ph ph-list-bullets text-lg"></i><i class="ph-bold ph-caret-down text-[10px] opacity-70"></i>
                </button>
                <div x-show="open" x-transition.opacity style="display: none;"
                     class="fixed z-[100] w-44 rounded-lg border border-border bg-card p-1.5 shadow-xl font-medium"
                     :style="`top: ${top}px; left: ${left}px;`">
                    <button type="button" @click="toggleBulletList(); open = false" :class="{ 'bg-muted text-foreground': isActive('bulletList') }" class="flex w-full items-center gap-3 rounded-md px-3 py-1.5 text-sm text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"><i class="ph ph-list-bullets text-lg"></i> Bullet List</button>
                    <button type="button" @click="toggleOrderedList(); open = false" :class="{ 'bg-muted text-foreground': isActive('orderedList') }" class="flex w-full items-center gap-3 rounded-md px-3 py-1.5 text-sm text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"><i class="ph ph-list-numbers text-lg"></i> Ordered List</button>
                    <button type="button" @click="toggleTaskList(); open = false" :class="{ 'bg-muted text-foreground': isActive('taskList') }" class="flex w-full items-center gap-3 rounded-md px-3 py-1.5 text-sm text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"><i class="ph ph-check-square-offset text-lg"></i> Task List</button>
                </div>
            </div>

            <button type="button" @click="toggleBlockquote()" :class="{ 'bg-muted text-foreground': isActive('blockquote') }" class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"><i class="ph ph-quotes text-lg"></i></button>
            <button type="button" @click="toggleCodeBlock()" :class="{ 'bg-muted text-foreground': isActive('codeBlock') }" class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"><i class="ph ph-code-block text-lg"></i></button>

            <div class="mx-2 h-5 w-px shrink-0 bg-border/60"></div>

            {{-- Text Formatting --}}
            <div class="flex shrink-0 gap-0.5">
                <button type="button" @click="toggleBold()" :class="{ 'bg-muted text-foreground': isActive('bold') }" class="flex h-8 w-8 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground font-serif font-bold">B</button>
                <button type="button" @click="toggleItalic()" :class="{ 'bg-muted text-foreground': isActive('italic') }" class="flex h-8 w-8 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground font-serif italic">I</button>
                <button type="button" @click="toggleUnderline()" :class="{ 'bg-muted text-foreground': isActive('underline') }" class="flex h-8 w-8 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground font-serif underline">U</button>
                <button type="button" @click="toggleStrike()" :class="{ 'bg-muted text-foreground': isActive('strike') }" class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground font-serif line-through">S</button>
                <button type="button" @click="toggleCode()" :class="{ 'bg-muted text-foreground': isActive('code') }" class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"><i class="ph ph-code text-lg"></i></button>
            </div>

            <div class="mx-2 h-5 w-px shrink-0 bg-border/60"></div>

            {{-- Text Color --}}
            <label class="relative flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground cursor-pointer" title="Text Color">
                <i class="ph-bold ph-palette text-lg" :style="'color: ' + (editor?.getAttributes('textStyle').color || 'currentColor')"></i>
                <input type="color" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" @input="setColor($event.target.value)" :value="editor?.getAttributes('textStyle').color || '#000000'">
            </label>

            {{-- Highlight Color Dropdown (FIXED POS) --}}
            <div class="relative shrink-0" x-data="{ open: false, top: 0, left: 0 }">
                <button type="button"
                        @click="let rect = $event.currentTarget.getBoundingClientRect(); top = rect.bottom + 4; left = rect.left; open = !open;"
                        @click.away="open = false"
                        class="flex h-8 w-8 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"
                        :class="{ 'bg-muted text-foreground': isActive('highlight') || open }" title="Highlight Color">
                    <i class="ph ph-highlighter text-lg"></i>
                </button>
                <div x-show="open" x-transition.opacity style="display: none;"
                     class="fixed z-[100] w-44 rounded-lg border border-border bg-card p-2 shadow-xl grid grid-cols-4 gap-1"
                     :style="`top: ${top}px; left: ${left}px;`">
                    <button type="button" @click="unsetHighlight(); open = false" class="h-8 w-8 rounded border border-border bg-background hover:bg-muted relative" title="No Color"><span class="absolute inset-0 m-auto h-0.5 w-full bg-red-500 rotate-45"></span></button>
                    @foreach(['#fef08a', '#fed7aa', '#fecaca', '#d9f99d', '#bbf7d0', '#a5f3fc', '#c7d2fe', '#e9d5ff'] as $color)
                        <button type="button" @click="setHighlight('{{ $color }}'); open = false" class="h-8 w-8 rounded border border-border/50 hover:scale-110 transition-transform" style="background-color: {{ $color }};"></button>
                    @endforeach
                </div>
            </div>

            <div class="mx-2 h-5 w-px shrink-0 bg-border/60"></div>

            {{-- Link Dropdown (FIXED POS) --}}
            <div class="relative shrink-0" x-data="{ open: false, url: '', top: 0, left: 0 }" x-init="$watch('open', value => { if(value) url = getLinkUrl() })">
                <button type="button"
                        @click="let rect = $event.currentTarget.getBoundingClientRect(); top = rect.bottom + 4; left = rect.left; open = !open;"
                        @click.away="open = false"
                        class="flex h-8 w-8 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"
                        :class="{ 'bg-muted text-foreground': isActive('link') || open }" title="Link">
                    <i class="ph ph-link text-lg"></i>
                </button>
                <div x-show="open" x-transition.opacity style="display: none;"
                     class="fixed z-[100] w-64 rounded-lg border border-border bg-card p-3 shadow-xl flex flex-col gap-2"
                     :style="`top: ${top}px; left: ${left}px;`">
                    <input type="text" x-model="url" placeholder="Paste a link..." class="w-full rounded-md border border-border bg-background px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50" @keydown.enter.prevent="setLink(url); open = false">
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="setLink(''); open = false" class="px-2 py-1.5 text-xs font-medium text-muted-foreground hover:text-destructive transition-colors">Unlink</button>
                        <button type="button" @click="setLink(url); open = false" class="rounded-md bg-primary px-3 py-1.5 text-xs font-medium text-primary-foreground hover:bg-primary/90 transition-colors">Save Link</button>
                    </div>
                </div>
            </div>

            <div class="mx-2 h-5 w-px shrink-0 bg-border/60"></div>

            {{-- Sub/Superscript --}}
            <button type="button" @click="toggleSuperscript()" :class="{ 'bg-muted text-foreground': isActive('superscript') }" class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground text-sm font-medium">x²</button>
            <button type="button" @click="toggleSubscript()" :class="{ 'bg-muted text-foreground': isActive('subscript') }" class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground text-sm font-medium">x₂</button>

            <div class="mx-2 h-5 w-px shrink-0 bg-border/60"></div>

            {{-- Alignment --}}
            <button type="button" @click="setTextAlign('left')" :class="{ 'bg-muted text-foreground': isActive({ textAlign: 'left' }) }" class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"><i class="ph ph-text-align-left text-lg"></i></button>
            <button type="button" @click="setTextAlign('center')" :class="{ 'bg-muted text-foreground': isActive({ textAlign: 'center' }) }" class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"><i class="ph ph-text-align-center text-lg"></i></button>
            <button type="button" @click="setTextAlign('right')" :class="{ 'bg-muted text-foreground': isActive({ textAlign: 'right' }) }" class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground"><i class="ph ph-text-align-right text-lg"></i></button>

            <div class="mx-2 h-5 w-px shrink-0 bg-border/60"></div>

            <button type="button" @click="setHorizontalRule()" class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground" title="Horizontal Line"><i class="ph ph-minus text-lg"></i></button>

            {{-- REAL Add Image Button & Hidden Input --}}
            <input type="file" x-ref="imageInput" class="hidden" accept="image/*" @change="handleImageUpload($event)">
            <button type="button" @click="$refs.imageInput.click()" class="ml-auto flex h-8 shrink-0 items-center gap-1.5 rounded-full bg-primary/10 px-4 text-sm font-medium text-primary transition-colors hover:bg-primary hover:text-primary-foreground">
                <i class="ph-bold ph-image"></i> Insert Image
            </button>
        </div>
    </div>

    {{-- Editor Area: Fills remaining height, fully clickable/scrollable --}}
    {{-- Removed bg-background so it inherits from the parent card --}}
    <div class="flex-1 overflow-y-auto bg-transparent p-6 sm:p-8 cursor-text" @click="$refs.editorArea.querySelector('.ProseMirror')?.focus()">
        <div x-ref="editorArea" class="h-full min-h-full w-full outline-none prose prose-invert max-w-none"></div>
    </div>

    {{-- Floating Bubble Menu for Image Captions --}}
    <div x-ref="bubbleMenu" class="hidden">
        <div class="flex items-center gap-2 rounded-xl border border-border bg-card p-2 shadow-2xl" x-data="{ caption: '' }" x-init="$watch('editor.isActive(\'image\')', value => { if(value) caption = getImageCaption() })">
            <i class="ph-bold ph-closed-captioning text-muted-foreground pl-1"></i>
            <input type="text" x-model="caption" placeholder="Add a caption or description..." class="w-56 border-none bg-transparent p-1 text-sm text-foreground focus:outline-none placeholder:text-muted-foreground" @keydown.enter.prevent="setImageCaption(caption)">
            <button type="button" @click="setImageCaption(caption)" class="rounded-lg bg-primary px-3 py-1.5 text-xs font-medium text-primary-foreground hover:bg-primary/90 transition-colors">Set Caption</button>
        </div>
    </div>

    <input type="hidden" name="content" x-model="content">
    <input type="hidden" name="old_content" value="{{ old('content') }}">
</div>
