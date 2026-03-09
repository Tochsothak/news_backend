// filepath: /resources/js/tiptap/tiptap.js
import { Editor } from "@tiptap/core";
import StarterKit from "@tiptap/starter-kit";
import { Underline } from "@tiptap/extension-underline";
import { Link } from "@tiptap/extension-link";
import { Image } from "@tiptap/extension-image";
import { TextAlign } from "@tiptap/extension-text-align";
import { TaskItem } from "@tiptap/extension-task-item";
import { TaskList } from "@tiptap/extension-task-list";
import { TextStyle } from "@tiptap/extension-text-style";
import { Color } from "@tiptap/extension-color";
import { Highlight } from "@tiptap/extension-highlight";
import { Subscript } from "@tiptap/extension-subscript";
import { Superscript } from "@tiptap/extension-superscript";
import { CodeBlockLowlight } from "@tiptap/extension-code-block-lowlight";
import { common, createLowlight } from "lowlight";
import { BubbleMenu } from "@tiptap/extension-bubble-menu";

const lowlight = createLowlight(common);

window.setupEditor = function (initialContent = "") {
    return {
        editor: null,
        content: initialContent,
        init(element, bubbleMenuElement) {
            this.editor = new Editor({
                element: element,
                extensions: [
                    StarterKit.configure({ codeBlock: false }),
                    Underline,
                    Link.configure({
                        openOnClick: false,
                        HTMLAttributes: {
                            class: "text-primary underline cursor-pointer",
                        },
                    }),
                    Image.configure({
                        inline: true,
                        HTMLAttributes: {
                            class: "rounded-xl border border-border shadow-sm mt-6 mb-6 max-w-full h-auto cursor-pointer transition-all hover:ring-2 hover:ring-primary/50",
                        },
                    }),
                    TaskList,
                    TaskItem.configure({ nested: true }),
                    TextAlign.configure({
                        types: ["heading", "paragraph", "image"],
                    }),
                    TextStyle,
                    Color,
                    Highlight.configure({ multicolor: true }),
                    Subscript,
                    Superscript,
                    CodeBlockLowlight.configure({ lowlight }),
                    BubbleMenu.configure({
                        element: bubbleMenuElement,
                        tippyOptions: { duration: 150, placement: "bottom" },
                        shouldShow: ({ editor }) => editor.isActive("image"),
                    }),
                ],
                content: this.content,
                editorProps: {
                    attributes: {
                        class: "prose prose-sm sm:prose-base dark:prose-invert max-w-none focus:outline-none min-h-full outline-none",
                    },
                },
                onUpdate: ({ editor }) => {
                    this.content = editor.getHTML();
                },
            });
        },
        isActive(type, options = {}) {
            return this.editor ? this.editor.isActive(type, options) : false;
        },

        // Formatting utils
        toggleBold() {
            this.editor.chain().focus().toggleBold().run();
        },
        toggleItalic() {
            this.editor.chain().focus().toggleItalic().run();
        },
        toggleStrike() {
            this.editor.chain().focus().toggleStrike().run();
        },
        toggleUnderline() {
            this.editor.chain().focus().toggleUnderline().run();
        },
        toggleCode() {
            this.editor.chain().focus().toggleCode().run();
        },
        toggleSubscript() {
            this.editor.chain().focus().toggleSubscript().run();
        },
        toggleSuperscript() {
            this.editor.chain().focus().toggleSuperscript().run();
        },

        // Colors
        setColor(color) {
            this.editor.chain().focus().setColor(color).run();
        },
        setHighlight(color) {
            this.editor.chain().focus().toggleHighlight({ color: color }).run();
        },
        unsetHighlight() {
            this.editor.chain().focus().unsetHighlight().run();
        },

        // Nodes utils
        toggleHeading(level) {
            this.editor.chain().focus().toggleHeading({ level: level }).run();
        },
        toggleBulletList() {
            this.editor.chain().focus().toggleBulletList().run();
        },
        toggleOrderedList() {
            this.editor.chain().focus().toggleOrderedList().run();
        },
        toggleTaskList() {
            this.editor.chain().focus().toggleTaskList().run();
        },
        toggleBlockquote() {
            this.editor.chain().focus().toggleBlockquote().run();
        },
        toggleCodeBlock() {
            this.editor.chain().focus().toggleCodeBlock().run();
        },
        setHorizontalRule() {
            this.editor.chain().focus().setHorizontalRule().run();
        },

        // Alignment utils
        setTextAlign(align) {
            this.editor.chain().focus().setTextAlign(align).run();
        },

        // Links
        getLinkUrl() {
            return this.editor
                ? this.editor.getAttributes("link").href || ""
                : "";
        },
        setLink(url) {
            if (url === "") {
                this.editor
                    .chain()
                    .focus()
                    .extendMarkRange("link")
                    .unsetLink()
                    .run();
                return;
            }
            this.editor
                .chain()
                .focus()
                .extendMarkRange("link")
                .setLink({ href: url })
                .run();
        },

        // NEW: Real Image Upload Handling
        handleImageUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Read the file as a Base64 string for instant preview
            const reader = new FileReader();
            reader.onload = (e) => {
                this.editor
                    .chain()
                    .focus()
                    .setImage({ src: e.target.result })
                    .run();
            };
            reader.readAsDataURL(file);

            // Reset input so the same file can be uploaded again if needed
            event.target.value = "";
        },

        // Image Captions
        getImageCaption() {
            return this.editor
                ? this.editor.getAttributes("image").alt || ""
                : "";
        },
        setImageCaption(caption) {
            if (this.editor.isActive("image")) {
                this.editor
                    .chain()
                    .focus()
                    .updateAttributes("image", { alt: caption, title: caption })
                    .run();
            }
        },
    };
};
