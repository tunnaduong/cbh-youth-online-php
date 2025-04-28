<style>
    /* Transition styles */
    .theme-transition {
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    /* Dark mode styles */
    .dark {
        background-color: #2c2f2e;
        color: #f3f4f6;
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

    .theme-toggle {
        zoom: 0.75;
    }
</style>
<button
    class="theme-toggle relative {{ $mobile ?? false ? 'block xl:hidden' : 'hidden xl:block' }} h-8 w-14 rounded-full border !border-neutral-500 dark:border-neutral-500 bg-gray-100 dark:bg-neutral-700 hover:!border-green-600 theme-transition"
    aria-label="Toggle theme">
    <div
        class="toggle-circle absolute top-[3px] left-1 flex h-6 w-6 items-center justify-center rounded-full bg-white dark:!bg-black shadow-sm">
        <!-- Sun icon for light mode -->
        <i data-lucide="sun" class="sun-icon h-3.5 w-3.5 text-black"></i>
        <!-- Moon icon for dark mode (hidden initially) -->
        <i data-lucide="moon" class="moon-icon h-3.5 w-3.5 text-black dark:!text-white hidden"></i>
    </div>
    <span class="sr-only">Toggle theme</span>
</button>
