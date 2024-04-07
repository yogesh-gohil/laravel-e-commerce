export default {
  root: {
    class: [
      // Shape
      'rounded-lg',
      'shadow',

      // Color
      'bg-white text-surface-700 dark:text-white',

      'dark:bg-surface-800',
      'dark:shadow-glass',
      'dark:border',
      'dark:border-white/10',
      'dark:bg-surface-800/90',
    ],
  },
  body: {
    class: 'p-5',
  },
  title: {
    class: 'text-2xl font-bold mb-2',
  },
  subtitle: {
    class: [
      // Font
      'font-normal',

      // Spacing
      'mb-2',

      // Color
      'text-surface-600 dark:text-surface-0/60',
    ],
  },
  content: {
    class: 'py-5', // Vertical padding.
  },
  footer: {
    class: 'pt-5', // Top padding.
  },
}
