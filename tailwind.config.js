const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");

module.exports = {
    future: {},
    content: [
        "./resources/**/*.js",
        "./resources/**/*.blade.php",
        "./vendor/marshmallow/components/resources/views/components/*.blade.php",
    ],
    presets: [require("./marshmallow-preset.js")],
    theme: {
        extend: {
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        h1: {
                            color: theme("colors.gold.500"),
                            "font-weight": 700,
                        },
                        h2: {
                            color: theme("colors.gray.700"),
                            "font-weight": 600,
                        },
                        heading: {
                            color: theme("colors.gray.700"),
                        },
                        h3: {
                            color: theme("colors.blue.500"),
                        },
                        color: theme("colors.blue.400"),
                        a: {
                            color: theme("colors.gold.500"),
                            "&:hover": {
                                "text-decoration": "underline",
                                color: theme("colors.gold.800"),
                            },
                        },
                        strong: {
                            color: theme("colors.gold.500"),
                        },
                        ul: {
                            "> li": {
                                "&::before": {
                                    color: theme("colors.gold.400"),
                                    background: theme("colors.gold.400"),
                                },
                                "margin-top": "0.25em",
                                "margin-bottom": "0.25em",
                            },
                        },
                        ol: {
                            "> li": {
                                "&::before": {
                                    color: theme("colors.gold.400"),
                                },
                            },
                        },
                    },
                },
            }),
        },
        extend: {
            fontFamily: {
                merriweather: ["Merriweather", "serif"],
                montserrat: ["Montserrat", "sans-serif"],
                sans: ["Montserrat", "sans-serif"],
                serif: ["Merriweather", "serif"],
                heading: ["Montserrat", "sans-serif"],
            },
            colors: {
                gold: {
                    50: "#fef8ed",
                    100: "#f8edd2",
                    150: "#f5e3c2",
                    200: "#f0dba6",
                    300: "#e9c979",
                    400: "#e1b74d",
                    500: "#daa520",
                    DEFAULT: "#daa520",
                    600: "#ae841a",
                    700: "#836313",
                    800: "#57420d",
                    900: "#2c2106",
                },
                dark: "#333333",
                background: "#f6f7fb",
                red: {
                    100: "#f1d0cc",
                    200: "#e3a099",
                    300: "#d67166",
                    400: "#c84133",
                    500: "#ba1200",
                    600: "#950e00",
                    700: "#700b00",
                    800: "#4a0700",
                    900: "#250400",
                },
                primary: {
                    50: "#fef8ed",
                    100: "#f8edd2",
                    150: "#f5e3c2",
                    200: "#f0dba6",
                    300: "#e9c979",
                    400: "#e1b74d",
                    500: "#daa520",
                    DEFAULT: "#daa520",
                    600: "#ae841a",
                    700: "#836313",
                    800: "#57420d",
                    900: "#2c2106",
                },
            },
        },
    },
};
