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
                    primary: '#9A0746',
                    secondary: '#FEF4E8',
                },
            },
        },
        themes: [
            {
                name: "dark",
                extend: {
                    colors: {
                        primary: '#27374D',
                        secondary: '#DDE6ED',
                    },
                },
            },
        ],
    }),
];
