<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>
<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<!-- Hero -->
<section class="relative overflow-hidden w-full">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img
            src="{{ asset('imgs/hero_img2.jpg') }}"
            alt="GreenPlate Hero"
            class="w-full h-full object-cover">

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/65"></div>

        <!-- Optional Gradient -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="min-h-screen flex items-center text-center">

            <div class="max-w-3xl mx-auto">

                <!-- Badge -->
                <div
                    class="inline-flex items-center gap-x-2 rounded-full border border-white/20 bg-white/10 backdrop-blur-md px-4 py-2 mb-8">
                    <span class="flex h-2 w-2 rounded-full bg-primary"></span>
                    <span class="text-sm text-white">
                        Sustainable Food Recovery Platform
                    </span>
                </div>

                <!-- Heading -->
                <h1
                    class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-7xl leading-tight">
                    Rescue
                    <span class="text-primary ">
                        Surplus Food
                    </span>
                    <br>
                    Feed Communities.
                </h1>

                <!-- Description -->
                <p class="mt-6 text-lg lg:text-xl text-gray-200 max-w-2xl leading-8">
                    GreenPlate empowers restaurants, supermarkets, and organizations to donate
                    surplus food through intelligent matching, volunteer-powered deliveries,
                    dynamic route optimization, and sustainability analytics.
                </p>

                <!-- Buttons -->
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">

                    <a href="#"
                        class="inline-flex justify-center items-center gap-x-2 rounded-lg bg-primary px-6 py-4 text-sm font-semibold text-white shadow-lg hover:scale-105 transition duration-300">

                        <svg class="size-6 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M48,208H16a8,8,0,0,1-8-8V160a8,8,0,0,1,8-8H48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><path d="M112,160h32l67-15.41a16.61,16.61,0,0,1,21,16h0a16.59,16.59,0,0,1-9.18,14.85L184,192l-64,16H48V152l25-25a24,24,0,0,1,17-7H140a20,20,0,0,1,20,20h0a20,20,0,0,1-20,20Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><path d="M96.73,120C87,107.72,80,94.56,80,80c0-21.69,17.67-40,39.46-40A39.12,39.12,0,0,1,156,64a39.12,39.12,0,0,1,36.54-24C214.33,40,232,58.31,232,80c0,29.23-28.18,55.07-50.22,71.32" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/></svg>
                        Start Donating

                        <svg class="size-4"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#"
                        class="inline-flex justify-center items-center rounded-lg border border-white/30 bg-white/10 backdrop-blur-md px-6 py-4 text-sm font-semibold text-white hover:bg-white hover:text-gray-900 transition duration-300">
                        <svg class="size-6 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><circle cx="128" cy="136" r="32" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><path d="M80,192a60,60,0,0,1,96,0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><rect x="32" y="48" width="192" height="160" rx="8" transform="translate(256) rotate(90)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><line x1="96" y1="64" x2="160" y2="64" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/></svg>
                        Become a Volunteer
                    </a>

                </div>

                <!-- Statistics -->
                <div class="mt-16 grid grid-cols-3 gap-8 max-w-2xl">

                    <div>
                        <h3 class="text-3xl font-bold dark:text-white text-neutral-900">
                            10K+
                        </h3>
                        <p class="dark:text-gray-400 text-neutral-700  text-sm">
                            Meals Rescued
                        </p>
                    </div>

                    <div>
                        <h3 class="text-3xl font-bold dark:text-white text-neutral-900">
                            250+
                        </h3>
                        <p class="dark:text-gray-400 text-neutral-700  text-sm">
                            Food Donors
                        </p>
                    </div>

                    <div>
                        <h3 class="text-3xl font-bold dark:text-white text-neutral-900">
                            100+
                        </h3>
                        <p class="dark:text-gray-400 text-neutral-700 text-sm ">
                            Volunteers
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Bottom Fade -->
    <div
        class="absolute bottom-0 left-0 right-0 h-3/4 [ bg-linear-to-t from-white dark:from-neutral-900 to-transparent">
    </div>
</section>
{{-- <!-- Grid -->
<div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
    <div>
        <h2
            class="block text-3xl font-bold text-foreground dark:text-foreground-inverse/90 sm:text-4xl lg:text-5xl lg:leading-tight">
            Rescue Surplus Food. <span class="text-primary">Feed Communities.</span></h2>
        <p class="mt-3 text-lg text-foreground dark:text-foreground-inverse/70">
            GreenPlate connects food donors with community organizations through smart matching, volunteer-driven
            deliveries, and optimized routes to reduce food waste and fight hunger.
        </p>

        <!-- Buttons -->
        <div class="mt-7 grid gap-3 w-full sm:inline-flex">
            <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none"
                href="#">
                Start Donating
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </a>
            <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground dark:text-primary-foreground  shadow-2xs hover:bg-layer-hover hover:dark:text-layer-foreground focus:outline-hidden focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none"
                href="#">
                Become a Volunteer
            </a>
        </div>
        <!-- End Buttons -->
    </div>
    <!-- End Col -->

    <div class="relative ms-4">
        <img class="w-full rounded-lg object-cover w-auto h-[500px]" src="{{ asset('imgs/hero_img1.jpg') }}"
            alt="Hero Image">

    </div>
    <!-- End Col -->
</div>
<!-- End Grid --> --}}
