import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primaryBrown: "#6F3917",
                lightPrimaryBrown: "#fff7ed",
                semiPrimaryBrown: "#B38867",
                grayTheme: "#626D71",
                lightGrayTheme: "#D9D9D9",
            },
        },
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: ["light"], // Hanya gunakan tema light
    },
};
