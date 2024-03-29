const { colors } = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    colors: {
      black: colors.black,
      white: colors.white,

      gray: colors.gray,

      primary: '#E71D36',
    //   black2: '#011627',
    //   white2: '#FDFFFC',
    //   green: '#2EC4B6',
    //   orange: '#FF9F1C',
    },
    boxShadow: {
      xs: '0 0 0 1px rgba(0, 0, 0, 0.05)',
      sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
      default: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
      md: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
      lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
      xl: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
      '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
      inner: 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
    //   outline: '0 0 0 3px rgba(231, 29, 54, 0.5)',
      outline: '0 0 0 3px rgba(0, 0, 0, 0.05)',
      none: 'none',
    },
  },
  variants: {},
  plugins: [
    // require('@tailwindcss/custom-forms')
  ]
}
