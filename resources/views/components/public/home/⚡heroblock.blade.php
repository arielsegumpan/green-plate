<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>
<!-- Grid -->
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
<!-- End Grid -->
