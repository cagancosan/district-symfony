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
                    logo: '#E93637',
                    body: '#EEF2E6',
                    primary: '#D6CDA4',
                    accent: '#FFFFFF',
                    visible: '#000000',
                },
            },
        },
        themes: [
            {
                name: "dark",
                extend: {
                    colors: {
                        logo: '#E93637',
                        body: '#132B41',
                        primary: '#0A1821',
                        accent: '#000000',
                        visible: '#FFFFFF',
                    },
                },
            },
        ],
    }),
];
