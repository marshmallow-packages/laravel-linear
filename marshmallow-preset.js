const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");

module.exports = {
    theme: {
        extend: {
            fontSize: {
                xs: "0.75rem",
                sm: "0.875rem",
                base: "1rem",
                md: "1.1rem",
                lg: "1.125rem",
                xl: "1.25rem",
                "2xl": "1.5rem",
                "3xl": "1.875rem",
                "4xl": "2.25rem",
                "5xl": "3rem",
                "6xl": "4rem",
            },
            container: {
                center: true,
            },
            maxHeight: {
                0: "0",
                "1/5": "20%",
                "1/4": "25%",
                "1/3": "33%",
                "2/5": "40%",
                "1/2": "50%",
                "3/5": "60%",
                "2/3": "66%",
                "3/4": "75%",
                "4/5": "80%",
                xl: "36rem",
            },
            width: {
                "1/7": "14.2857143%",
                "2/7": "28.5714286%",
                "3/7": "42.8571429%",
                "4/7": "57.1428571%",
                "5/7": "71.4285714%",
                "6/7": "85.7142857%",
                0: "0",
                "1/5": "20%",
                "1/4": "25%",
                "1/3": "33.3333333%",
                "2/5": "40%",
                "1/2": "50%",
                "3/5": "60%",
                "2/3": "66.6666666%",
                "3/4": "75%",
                "4/5": "80%",
                full: "100%",
            },
            maxWidth: {
                0: "0",
                "1/5": "20%",
                "1/4": "25%",
                "1/3": "33%",
                "2/5": "40%",
                "1/2": "50%",
                "3/5": "60%",
                "2/3": "66%",
                "3/4": "75%",
                "4/5": "80%",
                full: "100%",
            },
            minWidth: {
                0: "0",
                "1/5": "20%",
                "1/4": "25%",
                "1/3": "33%",
                "2/5": "40%",
                "1/2": "50%",
                "3/5": "60%",
                "2/3": "66%",
                "3/4": "75%",
                "4/5": "80%",
                full: "100%",
            },
            minHeight: {
                0: "0",
                "1/5": "20%",
                "1/4": "25%",
                "1/3": "33%",
                "2/5": "40%",
                "1/2": "50%",
                "3/5": "60%",
                "2/3": "66%",
                "3/4": "75%",
                "4/5": "80%",
                full: "100%",
            },
            screens: {
                sm: "639px",
                md: "767px",
                lg: "1023px",
                xl: "1279px",
                xxl: "1720px",
            },
            backgroundImage: {
                conic: "conic-gradient(var(--tw-gradient-stops))",
                "conic-to-t":
                    "conic-gradient(at top, var(--tw-gradient-stops))",
                "conic-to-b":
                    "conic-gradient(at bottom, var(--tw-gradient-stops))",
                "conic-to-l":
                    "conic-gradient(at left, var(--tw-gradient-stops))",
                "conic-to-r":
                    "conic-gradient(at right, var(--tw-gradient-stops))",
                "conic-to-tl":
                    "conic-gradient(at top left, var(--tw-gradient-stops))",
                "conic-to-tr":
                    "conic-gradient(at top right, var(--tw-gradient-stops))",
                "conic-to-bl":
                    "conic-gradient(at bottom left, var(--tw-gradient-stops))",
                "conic-to-br":
                    "conic-gradient(at bottom right, var(--tw-gradient-stops))",
                radial: "radial-gradient(ellipse at center, var(--tw-gradient-stops))",
                "radial-at-t":
                    "radial-gradient(ellipse at top, var(--tw-gradient-stops))",
                "radial-at-b":
                    "radial-gradient(ellipse at bottom, var(--tw-gradient-stops))",
                "radial-at-l":
                    "radial-gradient(ellipse at left, var(--tw-gradient-stops))",
                "radial-at-r":
                    "radial-gradient(ellipse at right, var(--tw-gradient-stops))",
                "radial-at-tl":
                    "radial-gradient(ellipse at top left, var(--tw-gradient-stops))",
                "radial-at-tr":
                    "radial-gradient(ellipse at top right, var(--tw-gradient-stops))",
                "radial-at-bl":
                    "radial-gradient(ellipse at bottom left, var(--tw-gradient-stops))",
                "radial-at-br":
                    "radial-gradient(ellipse at bottom right, var(--tw-gradient-stops))",
            },
            linearGradientColors: (theme) => theme("colors"),
            radialGradientColors: (theme) => theme("colors"),
            conicGradientColors: (theme) => theme("colors"),

            colors: {
                marshmallow: {
                    100: "#ffd0d8",
                    200: "#ffa0b1",
                    300: "#ff7189",
                    400: "#ff4162",
                    500: "#ff123b",
                    600: "#cc0e2f",
                    700: "#990b23",
                    800: "#660718",
                    900: "#33040c",
                },
            },
            keyframes: {
                tilt: {
                    "0%, 50%, 100%": { transform: "rotate(0deg)" },
                    "25%": { transform: "rotate(0.5deg)" },
                    "75%": { transform: "rotate(-0.5deg)" },
                },
                flash: {
                    "0%": { opacity: "0.2" },
                    "20%": { opacity: "1" },
                    "100%": { opacity: "0.2" },
                },
                shimmer: {
                    from: { backgroundPosition: "200% 0" },
                    to: { backgroundPosition: "-200% 0" },
                },
                swing: {
                    "15%": { transform: "translateX(5px)" },
                    "30%": { transform: "translateX(-5px)" },
                    "50%": { transform: "translateX(3px)" },
                    "80%": { transform: "translateX(2px)" },
                    "100%": { transform: "translateX(0)" },
                },
                "fade-in": {
                    from: { opacity: 0, transform: "scale(0.9)" },
                    to: { opacity: 1, transform: "scale(1.0)" },
                },
                "fade-out": {
                    from: { opacity: 1 },
                    to: { opacity: 0 },
                },
                "slide-in": {
                    "0%": { opacity: 0, transform: "translateY(16px)" },
                    "100%": { opacity: 1, transform: "translateY(0)" },
                },
                "slide-out": {
                    "0%": { opacity: 1, transform: "translateY(0px)" },
                    "100%": { opacity: 0, transform: "translateY(16px)" },
                },
            },
            animation: {
                tilt: "tilt 10s infinite linear",
                flash: "flash 1.4s infinite linear",
                shimmer: "shimmer 8s ease-in-out infinite",
                swing: "swing 1s ease 1",
                "fade-in": "fade-in 0.1s ease-out",
                "fade-out": "fade-out 0.1s ease-in",
                "slide-in": "slide-in 0.2s ease-out",
                "slide-out": "slide-out 0.2s ease-in",
            },
        },
    },
    plugins: [
        require("@tailwindcss/line-clamp"),
        require("tailwindcss-debug-screens"),
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("@tailwindcss/aspect-ratio"),
    ],
};
