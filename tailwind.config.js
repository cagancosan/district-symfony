/** @type {import('tailwindcss').Config} */

export const content = ["./assets/**/*.js", "./templates/**/*.twig"];
export const theme = {
    extend: {},
};
export const plugins = [
    require("@tailwindcss/forms"),
    require("tailwindcss-themer")({
        defaultTheme: {
            extend: {
                colors: {
                    body: '#d9cfc1',
                    primary: '#a77e58',
                    secondary: '#daa49a',
                    tertiary: '#edcbb1',
                    visible: '#02040f',
                    accent: '#fefefe',
                    dark: '#02040f',
                    light: '#fefefe',
                },
            },
        },
        themes: [
            {
                name: "dark",
                extend: {
                    colors: {
                        body: '#171123',
                        primary: '#372248',
                        secondary: '#5b85aa',
                        tertiary: '#c2dfe3',
                        visible: '#fefefe',
                        accent: '#02040f',
                        dark: '#02040f',
                        light: '#fefefe',
                    },
                },
            },
        ],
    }),
];
