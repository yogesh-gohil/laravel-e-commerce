export default {
  root: ({ props, context, parent }) => ({
    class: [
      // Font
      'font-sans leading-none font-base',

      // Flex
      { 'flex-1 w-[1%]': parent.instance.$name == 'InputGroup' },

      // Spacing
      'm-0',
      {
        'px-4 py-4': props.size == 'large',
        'px-2 py-2': props.size == 'small',
        'p-2.5': props.size == null,
      },
      // Shape
      { 'rounded-md': parent.instance.$name !== 'InputGroup' },
      {
        'first:rounded-l-md rounded-none last:rounded-r-md':
                    parent.instance.$name == 'InputGroup',
      },
      {
        'border-0 border-y border-l last:border-r':
                    parent.instance.$name == 'InputGroup',
      },
      {
        'first:ml-0 ml-[-1px]':
                    parent.instance.$name == 'InputGroup' && !props.showButtons,
      },

      // Colors
      'text-surface-600 dark:text-surface-200',
      'placeholder:text-surface-400 dark:placeholder:text-surface-500',
      'bg-surface-0 dark:bg-surface-700',
      { 'border-surface-300 dark:border-surface-600': !props.invalid },
      // Invalid State
      { 'border-red-500 dark:border-red-400': props.invalid },

      // States
      {
        'hover:border-primary-500 dark:hover:border-surface-500':
                    !context.disabled,
        'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-primary-500/50 dark:focus:ring-primary-400/50 focus:z-10':
                    !context.disabled,
        'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-red-500/50 dark:focus:ring-red-400/50 focus:z-10':
                    props.invalid,
        'opacity-60 select-none pointer-events-none cursor-default !bg-gray-100 !text-gray-400':
                    context.disabled,
      },

      // Misc
      'appearance-none',
      'transition-colors duration-100',
    ],
  }),
}
