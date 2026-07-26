<div>
    <!-- Header -->
    <header class="flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full text-sm py-3 md:py-0">
        <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8">
            <div class="relative md:flex md:items-center md:justify-between">
                <div class="flex items-center justify-between">
                    <a class="flex-none focus:outline-hidden focus:opacity-80" href="{{ route('home.page') }}">
                        <img src="{{ asset('imgs/gp_logo.png') }}" alt="{{ config('app.name') }}" class="h-14 w-auto">
                    </a>

                    <div class="md:hidden">
                        <button type="button"
                            class="hs-collapse-toggle size-9 flex justify-center items-center text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            id="hs-navbar-page-demo-pricing-collapse" aria-expanded="false"
                            aria-controls="hs-navbar-page-demo-pricing" aria-label="Toggle navigation"
                            data-hs-collapse="#hs-navbar-page-demo-pricing">
                            <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" x2="21" y1="6" y2="6" />
                                <line x1="3" x2="21" y1="12" y2="12" />
                                <line x1="3" x2="21" y1="18" y2="18" />
                            </svg>
                            <svg class="hs-collapse-open:block hidden shrink-0 size-4"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="hs-navbar-page-demo-pricing"
                    class="hidden hs-collapse overflow-hidden transition-all duration-300 basis-full grow md:block"
                    aria-labelledby="hs-navbar-page-demo-pricing-collapse">
                    <div
                        class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                        @include('layouts.partials.nav-items')
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- End Header -->
</div>
