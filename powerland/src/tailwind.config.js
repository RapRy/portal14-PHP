module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    fontFamily: {
      poppins: ["Poppins", "sans-serif"],
    },
    boxShadow: {
      effect1Shadow: "0 4px 20px 0 rgba(0, 0, 0, .25)",
      effect2Shadow: "0 4px 4px 0 rgba(0, 0, 0, .25)",
      breadcrumbsShadow: "0 2px 4px rgba(0, 0, 0, .10)",
    },
    extend: {
      colors: {
        main: "rgba(125, 53, 0, 1)",
        dark: "rgba(82, 15, 0, 1)",
        light: "rgba(254, 46, 0, 1)",
        contrastText: "rgba(47, 45, 44, 1)",
        white74: "rgba(255, 255, 255, .74)",
        white5: "rgba(255, 255, 255, .4)",
      },
      borderRadius: {
        radius15: "15px",
        radius5: "5px",
      },
      backdropBlur: {
        effectBlur: "30px",
      },
      backgroundImage: (theme) => ({
        "site-bg": "url('../assets/bg.svg')",
      }),
    },
  },
  variants: {
    extend: {
      margin: ["last"],
    },
  },
  plugins: [],
};
