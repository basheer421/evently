/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                "plus-jakarta": ['"Plus Jakarta Sans"', "sans-serif"],
                // Or make it the default sans font:
                sans: [
                    '"Plus Jakarta Sans"',
                    "ui-sans-serif",
                    "system-ui",
                    "sans-serif",
                ],
            },
        },
    },
    plugins: [],
};
