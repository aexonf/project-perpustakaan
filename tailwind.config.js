/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: ["class"],
<<<<<<< HEAD
    content: ["./resources/**/*.jsx"],
=======
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/js/**/*.jsx",
    ],
    prefix: "",
>>>>>>> bcd07b6ca9fda5c8d7a22514643d24f49da87aa5
    theme: {
        container: {
            center: true,
            padding: "2rem",
            screens: {
                "2xl": "1400px",
            },
        },
        extend: {
            colors: {
                border: "hsl(var(--border))",
                input: "hsl(var(--input))",
                ring: "hsl(var(--ring))",
                background: "hsl(var(--background))",
                foreground: "hsl(var(--foreground))",
                primary: {
                    DEFAULT: "hsl(var(--primary))",
                    foreground: "hsl(var(--primary-foreground))",
                },
<<<<<<< HEAD
                success: {
                    DEFAULT: "#059669",
                    foreground: "#FFFFFF",
                },
=======
>>>>>>> bcd07b6ca9fda5c8d7a22514643d24f49da87aa5
                secondary: {
                    DEFAULT: "hsl(var(--secondary))",
                    foreground: "hsl(var(--secondary-foreground))",
                },
                destructive: {
                    DEFAULT: "hsl(var(--destructive))",
                    foreground: "hsl(var(--destructive-foreground))",
                },
                muted: {
                    DEFAULT: "hsl(var(--muted))",
                    foreground: "hsl(var(--muted-foreground))",
                },
                accent: {
                    DEFAULT: "hsl(var(--accent))",
                    foreground: "hsl(var(--accent-foreground))",
                },
                popover: {
                    DEFAULT: "hsl(var(--popover))",
                    foreground: "hsl(var(--popover-foreground))",
                },
                card: {
                    DEFAULT: "hsl(var(--card))",
                    foreground: "hsl(var(--card-foreground))",
                },
            },
<<<<<<< HEAD
            fontFamily: {
                'inter': ["Inter", "sans-serif"],
            },
=======
>>>>>>> bcd07b6ca9fda5c8d7a22514643d24f49da87aa5
            borderRadius: {
                lg: "var(--radius)",
                md: "calc(var(--radius) - 2px)",
                sm: "calc(var(--radius) - 4px)",
            },
            keyframes: {
                "accordion-down": {
<<<<<<< HEAD
                    from: { height: 0 },
=======
                    from: { height: "0" },
>>>>>>> bcd07b6ca9fda5c8d7a22514643d24f49da87aa5
                    to: { height: "var(--radix-accordion-content-height)" },
                },
                "accordion-up": {
                    from: { height: "var(--radix-accordion-content-height)" },
<<<<<<< HEAD
                    to: { height: 0 },
=======
                    to: { height: "0" },
>>>>>>> bcd07b6ca9fda5c8d7a22514643d24f49da87aa5
                },
            },
            animation: {
                "accordion-down": "accordion-down 0.2s ease-out",
                "accordion-up": "accordion-up 0.2s ease-out",
            },
<<<<<<< HEAD
        },
    },
    plugins: [require("tailwindcss-animate")],
};
=======
            fontFamily: {
                outfit: ["Outfit", "sans-serif"],
            },
        },
    },
    plugins: [require("tailwindcss-animate")],
};
>>>>>>> bcd07b6ca9fda5c8d7a22514643d24f49da87aa5
