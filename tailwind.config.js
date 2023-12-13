module.exports = {
    content: [
        "./resources/**/*.{js,jsx,ts,tsx,vue}", // Analisis file di direktori resources
        "./app/**/*.php",                        // Analisis file PHP di direktori app
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js"
    ],
    darkMode: false,
    theme: {
        extend: {},
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ]
}
