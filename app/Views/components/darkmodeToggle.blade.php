<style>
    /* Transition styles */
    .theme-transition {
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    /* Dark mode styles */
    .dark {
        background-color: #2c2f2e;
        color: #f3f4f6;
        --background: 0 0% 18%;
        /* tương ứng #2c2f2e */
        --foreground: 0 0% 90%;
        /* màu chữ gần trắng */
    }

    /* Toggle transition */
    .toggle-circle {
        transition: transform 0.3s ease;
    }

    .dark .toggle-circle {
        transform: translateX(1.4rem);
    }

    .logo-white:is(.dark *) {
        filter: brightness(0) saturate(100%) invert(100%) sepia(50%) saturate(258%) hue-rotate(319deg) brightness(126%) contrast(96%);
    }
</style>
<button id="theme-toggle"
    class="relative h-8 w-14 rounded-full border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 theme-transition"
    aria-label="Toggle theme">
    <div
        class="toggle-circle absolute top-[3px] left-1 flex h-6 w-6 items-center justify-center rounded-full bg-white dark:bg-black shadow-sm">
        <!-- Sun icon for light mode -->
        <i id="sun-icon" data-lucide="sun" class="h-3.5 w-3.5 text-yellow-500"></i>
        <!-- Moon icon for dark mode (hidden initially) -->
        <i id="moon-icon" data-lucide="moon" class="h-3.5 w-3.5 text-yellow-400 hidden"></i>
    </div>
    <span class="sr-only">Toggle theme</span>
</button>
<script>
    tailwind.config = {
        darkMode: 'class',
    };
</script>