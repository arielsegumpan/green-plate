<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<!-- Hero -->
<div
    class="relative overflow-hidden before:absolute before:top-0 before:inset-s-1/2 before:bg-[url('https://preline.co/assets/svg/examples/squared-bg-element.svg')] dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/squared-bg-element.svg')] before:bg-no-repeat before:bg-top before:size-full before:-z-1 before:transform before:-translate-x-1/2">
    <div class="max-w-340 mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
        <!-- Announcement Banner -->
        <div class="flex justify-center">
            <a class="inline-flex items-center gap-x-2 bg-layer border border-layer-line text-xs text-layer-foreground p-2 px-3 rounded-full transition hover:border-line-3 focus:outline-hidden focus:border-line-3"
                href="#">
                Explore the Capital Product
                <span class="flex items-center gap-x-1">
                    <span class="border-s border-line-2 text-primary ps-2">Explore</span>
                    <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </span>
            </a>
        </div>
        <!-- End Announcement Banner -->

        <!-- Title -->
        <div class="mt-5 max-w-xl text-center mx-auto">
            <h1 class="block font-bold text-foreground text-4xl md:text-5xl lg:text-6xl">
                Supercharged Preline Experience
            </h1>
        </div>
        <!-- End Title -->

        <div class="mt-5 max-w-3xl text-center mx-auto">
            <p class="text-lg text-muted-foreground-2">Preline is a large open-source project, crafted with Tailwind CSS
                framework by Hmlstream.</p>
        </div>

        <!-- Buttons -->
        <div class="mt-7 grid gap-3 w-full sm:inline-flex mx-auto">
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
</div>
<!-- End Hero -->

{{--
<!-- Grid -->
<div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
    <div>
        <h1
            class="block text-3xl font-bold text-foreground dark:text-foreground-inverse/90 sm:text-4xl lg:text-6xl lg:leading-tight">
            Rescue Surplus
            Food. <span class="text-primary">Feed Communities.</span></h1>
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
