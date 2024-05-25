<script lang="ts">
import { EditorContent, useEditor } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import {
  DotsVerticalIcon,
  MenuAlt2Icon,
  MenuAlt3Icon,
  MenuIcon,
} from '@heroicons/vue/outline'
import TextAlign from '@tiptap/extension-text-align'

import {
  BoldIcon,
  CodeBlockIcon,
  CodingIcon,
  ItalicIcon,
  ListIcon,
  ListUlIcon,
  MenuCenterIcon,
  ParagraphIcon,
  QuoteIcon,
  RedoIcon,
  StrikethroughIcon,
  UndoIcon,
} from './icons/index.js'

export default {
  components: {
    EditorContent,
    BoldIcon,
    CodingIcon,
    ItalicIcon,
    ListIcon,
    ListUlIcon,
    ParagraphIcon,
    QuoteIcon,
    StrikethroughIcon,
    UndoIcon,
    RedoIcon,
    CodeBlockIcon,
    DotsVerticalIcon,
    MenuCenterIcon,
    MenuAlt2Icon,
    MenuAlt3Icon,
    MenuIcon,
  },

  props: {
    modelValue: {
      type: String,
      default: '',
    },
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const editor = useEditor({
      content: props.modelValue,
      extensions: [
        StarterKit.configure({
          orderedList: false,
        }),
        TextAlign.configure({
          types: ['heading', 'paragraph'],
          alignments: ['left', 'right', 'center', 'justify'],
        }),
      ],

      onUpdate: () => {
        emit('update:modelValue', editor.value.getHTML())
      },
    })

    watch(
      () => props.modelValue,
      (value) => {
        const isSame = editor.value.getHTML() === value

        if (isSame)
          return

        editor.value.commands.setContent(props.modelValue, false)
      },
    )

    onUnmounted(() => {
      setTimeout(() => {
        editor.value.destroy()
      }, 500)
    })

    return {
      editor,
    }
  },
}
</script>

<template>
  <div
    class="
      box-border
      w-full
      text-sm
      leading-8
      text-left
      bg-white
      border border-gray-200
      dark:border-gray-600
      rounded-md
      min-h-[200px]
      overflow-hidden
      dark:bg-gray-700 dark:text-white
      group
    "
  >
    <div v-if="editor" class="editor-content">
      <div class="p-2 border-b border-gray-200 md:flex dark:border-gray-600">
        <div class="flex flex-wrap space-x-1 dark:text-white">
          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            title="Bold"
            :class="{ 'bg-gray-200 dark:bg-gray-900': editor.isActive('bold') }"
            @click="editor.chain().focus().toggleBold().run()"
          >
            <BoldIcon class="h-3 cursor-pointer fill-current" />
          </span>
          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive('italic'),
            }"
            title="Italic"
            @click="editor.chain().focus().toggleItalic().run()"
          >
            <ItalicIcon class="h-3 cursor-pointer fill-current" />
          </span>
          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            title="Strikethrough"
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive('strike'),
            }"
            @click="editor.chain().focus().toggleStrike().run()"
          >
            <StrikethroughIcon class="h-3 cursor-pointer fill-current" />
          </span>
          <!-- <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            title="Code"
            :class="{ 'bg-gray-200 dark:bg-gray-900': editor.isActive('code') }"
            @click="editor.chain().focus().toggleCode().run()"
          >
            <coding-icon class="h-3 cursor-pointer fill-current" />
          </span> -->
          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive('paragraph'),
            }"
            title="Paragraph"
            @click="editor.chain().focus().setParagraph().run()"
          >
            <ParagraphIcon class="h-3 cursor-pointer fill-current" />
          </span>
          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            title="Heading 1"
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive('heading', {
                level: 1,
              }),
            }"
            @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
          >
            H1
          </span>
          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive('heading', {
                level: 2,
              }),
            }"
            title="Heading 2"
            @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
          >
            H2
          </span>
          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive('heading', {
                level: 3,
              }),
            }"
            title="Heading 3"
            @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
          >
            H3
          </span>

          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            title="Bullet List"
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive('bulletList'),
            }"
            @click="editor.chain().focus().toggleBulletList().run()"
          >
            <ListUlIcon class="h-3 cursor-pointer fill-current" />
          </span>
          <!-- <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive('orderedList'),
            }"
            title="Ordered List"
            @click="editor.chain().focus().toggleOrderedList().run()"
          >
            <list-icon class="h-3 cursor-pointer fill-current" />
          </span> -->
          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            title="Blockquote"
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive('blockquote'),
            }"
            @click="editor.chain().focus().toggleBlockquote().run()"
          >
            <QuoteIcon class="h-3 cursor-pointer fill-current" />
          </span>
          <!-- <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive('codeBlock'),
            }"
            title="Code Block"
            @click="editor.chain().focus().toggleCodeBlock().run()"
          >
            <code-block-icon class="h-3 cursor-pointer fill-current" />
          </span> -->
          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            :class="{ 'bg-gray-200 dark:bg-gray-900': editor.isActive('undo') }"
            title="Undo"
            @click="editor.chain().focus().undo().run()"
          >
            <UndoIcon class="h-3 cursor-pointer fill-current" />
          </span>
          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            title="Redo"
            :class="{ 'bg-gray-200 dark:bg-gray-900': editor.isActive('redo') }"
            @click="editor.chain().focus().redo().run()"
          >
            <RedoIcon class="h-3 cursor-pointer fill-current" />
          </span>

          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive({
                textAlign: 'left',
              }),
            }"
            title="Align Left"
            @click="editor.chain().focus().setTextAlign('left').run()"
          >
            <MenuAlt2Icon class="h-5 cursor-pointer fill-current" />
          </span>

          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive({
                textAlign: 'center',
              }),
            }"
            title="Align Center"
            @click="editor.chain().focus().setTextAlign('center').run()"
          >
            <MenuCenterIcon class="h-5 cursor-pointer fill-current" />
          </span>

          <span
            class="
              flex
              items-center
              justify-center
              w-6
              h-6
              rounded-sm
              cursor-pointer
              hover:bg-gray-100
              dark:hover:bg-gray-800
            "
            :class="{
              'bg-gray-200 dark:bg-gray-900': editor.isActive({
                textAlign: 'right',
              }),
            }"
            title="Align Right"
            @click="editor.chain().focus().setTextAlign('right').run()"
          >
            <MenuAlt3Icon class="h-5 cursor-pointer fill-current" />
          </span>
        </div>
      </div>
      <EditorContent
        :editor="editor"
        class="
          box-border
          relative
          w-full
          text-sm
          leading-8
          text-left
          editor__content
        "
      />
    </div>
  </div>
</template>

<style lang="scss">
.ProseMirror {
  min-height: 200px;
  padding: 8px 12px;
  outline: none;
  @apply rounded-md rounded-tl-none rounded-tr-none border border-transparent;

  h1 {
    font-size: 22px;
    font-weight: bold;
  }

  h2 {
    font-size: 18px;
    font-weight: bold;
  }

  h3 {
    font-size: 16px;
    font-weight: bold;
  }

  ul {
    padding: 0 1rem;
    list-style: disc !important;
  }

  ol {
    padding: 0 1rem;
    list-style: auto !important;
  }

  blockquote {
    padding-left: 1rem;
    border-left: 2px solid rgba(#0d0d0d, 0.1);
  }

  code {
    background-color: rgba(97, 97, 97, 0.1);
    color: #616161;
    border-radius: 0.4rem;
    font-size: 0.9rem;
    padding: 0.1rem 0.3rem;
  }

  pre {
    background: #0d0d0d;
    color: #fff;
    font-family: 'JetBrainsMono', monospace;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;

    code {
      color: inherit;
      padding: 0;
      background: none;
      font-size: 0.8rem;
    }
  }
}

// .ProseMirror {
//   @apply group-focus:border group-focus:border-primary-400 group-focus:ring-primary-400;
// }

.ProseMirror:focus {
  @apply md:border md:border-primary-400 ring-primary-400;
}
</style>
