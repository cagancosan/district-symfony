/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");

export const content = ["./assets/**/*.js", "./templates/**/*.html.twig"];
export const theme = {
  extend: {},
};
export const plugins = [
  require("tailwindcss-themer")({
    defaultTheme: {
      extend: {
        colors: {
          primary: colors.red,
        },
      },
    },
    themes: [
      {
        name: "orange",
        extend: {
          colors: {
            primary: colors.orange,
          },
        },
        name: "amber",
        extend: {
          colors: {
            primary: colors.amber,
          },
        },
        name: "yellow",
        extend: {
          colors: {
            primary: colors.yellow,
          },
        },
        name: "lime",
        extend: {
          colors: {
            primary: colors.lime,
          },
        },
        name: "green",
        extend: {
          colors: {
            primary: colors.green,
          },
        },
        name: "emerald",
        extend: {
          colors: {
            primary: colors.emerald,
          },
        },
        name: "teal",
        extend: {
          colors: {
            primary: colors.teal,
          },
        },
        name: "cyan",
        extend: {
          colors: {
            primary: colors.cyan,
          },
        },
        name: "sky",
        extend: {
          colors: {
            primary: colors.sky,
          },
        },
        name: "blue",
        extend: {
          colors: {
            primary: colors.blue,
          },
        },
        name: "indigo",
        extend: {
          colors: {
            primary: colors.indigo,
          },
        },
        name: "violet",
        extend: {
          colors: {
            primary: colors.violet,
          },
        },
        name: "purple",
        extend: {
          colors: {
            primary: colors.purple,
          },
        },
        name: "fuchsia",
        extend: {
          colors: {
            primary: colors.fuchsia,
          },
        },
        name: "pink",
        extend: {
          colors: {
            primary: colors.pink,
          },
        },
        name: "rose",
        extend: {
          colors: {
            primary: colors.rose,
          },
        },
        name: "slate",
        extend: {
          colors: {
            primary: colors.slate,
          },
        },
      },
    ],
  }),
];
