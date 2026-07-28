<div
    class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-8 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-neutral-700">

    <a href="{{ route('home.page') }}" wire:current.exact="text-green-700 hover:text-green-500 focus:outline-hidden focus:text-green-500 dark:text-green-400 dark:hover:text-green-500 dark:focus:text-green-500" class="py-3 md:py-6 font-medium text-gray-600 hover:text-gray-500 focus:outline-hidden focus:text-gray-500 dark:text-neutral-400 dark:hover:text-neutral-500 dark:focus:text-neutral-500">
        {{ __('Home') }}
    </a>

    <a class="py-3 md:py-6 font-medium text-gray-600 hover:text-gray-500 focus:outline-hidden focus:text-gray-500 dark:text-neutral-400 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
        href="{{ route('about.page') }}">
        {{ __('About') }}
    </a>

    <a class="py-3 md:py-6 font-medium text-gray-600 hover:text-gray-500 focus:outline-hidden focus:text-gray-500 dark:text-neutral-400 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
        href="{{ route('contact.page') }}">
        {{ __('Contact') }}
    </a>

    {{-- DARK MODE --}}
    <button type="button"
        class="hs-dark-mode-active:hidden block hs-dark-mode font-medium text-gray-800 rounded-full hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
        data-hs-theme-click-value="dark">
        <span class="group inline-flex shrink-0 justify-center items-center size-9">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
            </svg>
        </span>
    </button>
    <button type="button"
        class="hs-dark-mode-active:block hidden hs-dark-mode font-medium text-gray-800 rounded-full hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
        data-hs-theme-click-value="light">
        <span class="group inline-flex shrink-0 justify-center items-center size-9">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="4"></circle>
                <path d="M12 2v2"></path>
                <path d="M12 20v2"></path>
                <path d="m4.93 4.93 1.41 1.41"></path>
                <path d="m17.66 17.66 1.41 1.41"></path>
                <path d="M2 12h2"></path>
                <path d="M20 12h2"></path>
                <path d="m6.34 17.66-1.41 1.41"></path>
                <path d="m19.07 4.93-1.41 1.41"></path>
            </svg>
        </span>
    </button>
    {{-- END OF DARK MODE --}}

    @guest
    <a class="py-3 md:py-6 font-medium text-gray-600 hover:text-gray-500 focus:outline-hidden focus:text-gray-500 dark:text-neutral-400 dark:hover:text-neutral-500 dark:focus:text-neutral-500 flex flex-row items-center gap-x-1"
        href="{{ route('filament.auth.auth.login') }}">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
        </svg>
        {{ __('Login') }}
    </a>

    <div class="pt-3 md:pt-0">
        <a class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none"
            href="{{ route('filament.auth.auth.register') }}">
            {{ __('Apply Now') }}
        </a>
    </div>

    @endguest

</div>
